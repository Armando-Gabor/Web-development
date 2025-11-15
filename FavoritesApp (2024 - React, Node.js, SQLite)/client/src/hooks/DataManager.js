import { useState, useEffect } from "react";
import axios from "axios";

const DataManager = (type) => {
  const [rows, setRows] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get(`http://localhost:3001/${type}`);

        // Check if response has data property and it's an array
        const items = response.data.data || [];

        if (items.length === 0) {
          const placeholders = [
            {
              name: `${type.charAt(0).toUpperCase() + type.slice(1, -1)} 1`,
              rank: 1,
            },
            {
              name: `${type.charAt(0).toUpperCase() + type.slice(1, -1)} 2`,
              rank: 2,
            },
            {
              name: `${type.charAt(0).toUpperCase() + type.slice(1, -1)} 3`,
              rank: 3,
            },
            {
              name: "Hover over the row and click + or - to add or delete rows",
              rank: 4,
            },
            { name: "The row is always added under the selected row", rank: 5 },
            {
              name: "Delete or change these rows into your favourites :)",
              rank: 6,
            },
          ];

          const createdPlaceholders = await Promise.all(
            placeholders.map((item) =>
              axios.post(`http://localhost:3001/${type}`, item)
            )
          );

          const sortedItems = createdPlaceholders
            .map((response) => response.data)
            .sort((a, b) => a.rank - b.rank);

          setRows(
            sortedItems.map((item) => ({
              id: item.id,
              value: item.name,
              rank: item.rank,
            }))
          );
        } else {
          const sortedItems = items.sort((a, b) => a.rank - b.rank);
          setRows(
            sortedItems.map((item) => ({
              id: item.id,
              value: item.name,
              rank: item.rank,
            }))
          );
        }
      } catch (error) {
        console.error(`Error fetching ${type}:`, error);
      }
    };

    fetchData();
  }, [type]);

  const handleAddRow = async (e, index) => {
    e.preventDefault();
    const newRows = [...rows];
    const newRank = index + 2;

    try {
      await Promise.all(
        rows.slice(index + 1).map((row, i) =>
          axios.put(`http://localhost:3001/${type}/${row.id}`, {
            name: row.value,
            rank: newRank + i + 1,
          })
        )
      );

      const response = await axios.post(`http://localhost:3001/${type}`, {
        name: "",
        rank: newRank,
      });

      newRows.splice(index + 1, 0, {
        id: response.data.id,
        value: "",
        rank: newRank,
      });
      setRows(newRows);
    } catch (error) {
      console.error("Error adding row:", error);
    }
  };

  const handleDeleteRow = async (e, index) => {
    e.preventDefault();
    try {
      await axios.delete(`http://localhost:3001/${type}/${rows[index].id}`);

      await Promise.all(
        rows.slice(index + 1).map((row, i) =>
          axios.put(`http://localhost:3001/${type}/${row.id}`, {
            name: row.value,
            rank: index + i + 1,
          })
        )
      );

      const newRows = rows.filter((_, i) => i !== index);
      setRows(newRows);
    } catch (error) {
      console.error("Error deleting row:", error);
    }
  };

  const handleInputChange = async (e, index) => {
    const newRows = [...rows];
    newRows[index].value = e.target.value;
    setRows(newRows);

    try {
      await axios.put(`http://localhost:3001/${type}/${rows[index].id}`, {
        name: e.target.value,
        rank: index + 1,
      });
    } catch (error) {
      console.error("Error updating name:", error);
    }
  };

  return { rows, setRows, handleAddRow, handleDeleteRow, handleInputChange };
};

export default DataManager;

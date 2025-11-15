import React from "react";
import "./Pages.css";
import DataTable from "../components/DataTable";
import Navigation from "../components/Navigation";
import DataManager from "../hooks/DataManager";

const Books = () => {
  const { rows, setRows, handleAddRow, handleDeleteRow, handleInputChange } =
    DataManager("books");

  return (
    <>
      <Navigation />
      <DataTable
        rows={rows}
        handleInputChange={handleInputChange}
        handleAddRow={handleAddRow}
        handleDeleteRow={handleDeleteRow}
        setRows={setRows}
        type="books"
      />
    </>
  );
};

export default Books;

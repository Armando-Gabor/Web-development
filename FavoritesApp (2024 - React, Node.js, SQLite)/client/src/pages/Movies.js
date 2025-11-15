import React from "react";
import "./Pages.css";
import DataTable from "../components/DataTable";
import Navigation from "../components/Navigation";
import DataManager from "../hooks/DataManager";

const Movies = () => {
  const { rows, setRows, handleAddRow, handleDeleteRow, handleInputChange } =
    DataManager("movies");

  return (
    <>
      <Navigation />
      <DataTable
        rows={rows}
        handleInputChange={handleInputChange}
        handleAddRow={handleAddRow}
        handleDeleteRow={handleDeleteRow}
        setRows={setRows}
        type="movies"
      />
    </>
  );
};

export default Movies;

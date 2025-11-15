import React from "react";
import axios from "axios";
import { SortableRow } from "./SortableRow";
import "./DataTable.css";
import {
  DndContext,
  closestCenter,
  KeyboardSensor,
  PointerSensor,
  useSensor,
  useSensors,
} from "@dnd-kit/core";
import {
  arrayMove,
  SortableContext,
  sortableKeyboardCoordinates,
  verticalListSortingStrategy,
} from "@dnd-kit/sortable";

const DataTable = ({
  rows,
  handleInputChange,
  handleAddRow,
  handleDeleteRow,
  setRows,
  type,
}) => {
  const sensors = useSensors(
    useSensor(PointerSensor),
    useSensor(KeyboardSensor, {
      coordinateGetter: sortableKeyboardCoordinates,
    })
  );

  const handleDragEnd = async (event) => {
    const { active, over } = event;

    if (active.id !== over.id) {
      const oldIndex = rows.findIndex((row) => row.id === active.id);
      const newIndex = rows.findIndex((row) => row.id === over.id);

      const newRows = arrayMove(rows, oldIndex, newIndex);

      // Update ranks for all affected rows
      const updatedRows = newRows.map((row, index) => ({
        ...row,
        rank: index + 1,
      }));

      try {
        // Wait for all database updates to complete
        await Promise.all(
          updatedRows.map((row) =>
            axios.put(`http://localhost:3001/${type}/${row.id}`, {
              name: row.value,
              rank: row.rank,
            })
          )
        );

        // Only update state after successful database update
        setRows(updatedRows);
      } catch (error) {
        console.error("Error updating ranks:", error);
        // Optionally revert to original order if update fails
        setRows(rows);
      }
    }
  };

  return (
    <div className="page-container">
      <div className="wrapper">
        <form onSubmit={(e) => e.preventDefault()}>
          <DndContext
            sensors={sensors}
            collisionDetection={closestCenter}
            onDragEnd={handleDragEnd}
          >
            <table>
              <tbody>
                <SortableContext
                  items={rows.map((row) => row.id)}
                  strategy={verticalListSortingStrategy}
                >
                  {rows.map((row, index) => (
                    <SortableRow
                      key={row.id}
                      id={row.id}
                      index={index}
                      row={row}
                      handleInputChange={handleInputChange}
                      handleAddRow={handleAddRow}
                      handleDeleteRow={handleDeleteRow}
                    />
                  ))}
                </SortableContext>
              </tbody>
            </table>
          </DndContext>
        </form>
      </div>
    </div>
  );
};

export default DataTable;

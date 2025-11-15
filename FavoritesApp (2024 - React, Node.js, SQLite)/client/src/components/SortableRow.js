import React from "react";
import { useSortable } from "@dnd-kit/sortable";
import { CSS } from "@dnd-kit/utilities";
import { FaGripVertical } from "react-icons/fa";
import { MdDelete } from "react-icons/md";
import { TbCodeVariablePlus } from "react-icons/tb";

export function SortableRow({
  id,
  index,
  row,
  handleInputChange,
  handleAddRow,
  handleDeleteRow,
}) {
  const { attributes, listeners, setNodeRef, transform, transition } =
    useSortable({ id });

  const style = {
    transform: CSS.Transform.toString(transform),
    transition,
  };

  // Add rank class based on index
  const getRankClass = (index) => {
    if (index === 0) return "rank gold";
    if (index === 1) return "rank silver";
    if (index === 2) return "rank bronze";
    return "rank";
  };

  // Add rank class based on index
  const getNameClass = (index) => {
    if (index === 0) return "gold";
    if (index === 1) return "silver";
    if (index === 2) return "bronze";
    return "";
  };

  return (
    <tr ref={setNodeRef} style={style}>
      <td className={getRankClass(index)}>{index + 1}.</td>
      <td>
        <textarea
          type="text"
          defaultValue={row.value}
          onChange={(e) => handleInputChange(e, index)}
          className={getNameClass(index)}
        />
        <button className="drag" type="button" {...attributes} {...listeners}>
          <FaGripVertical />
        </button>
        <button
          className="remove"
          type="button"
          onClick={(e) => handleDeleteRow(e, index)}
        >
          <MdDelete />
        </button>
        <button
          className="add"
          type="button"
          onClick={(e) => handleAddRow(e, index)}
        >
          <TbCodeVariablePlus />
        </button>
      </td>
    </tr>
  );
}

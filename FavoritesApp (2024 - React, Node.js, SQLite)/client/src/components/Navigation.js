import React from "react";
import { useNavigate } from "react-router-dom";
import "../pages/Pages.css";
import { useLocation } from "react-router-dom";

const Navigation = () => {
  const navigate = useNavigate();

  const handleNavigation = (path) => {
    navigate(path);
  };
  const location = useLocation();
  const currentPath = location.pathname;

  return (
    <div className="home-container nav-active">
      <button
        onClick={() => handleNavigation("/games")}
        className={`home-button ${currentPath === "/games" ? "active" : ""}`}
      >
        Games
      </button>
      <button
        onClick={() => handleNavigation("/movies")}
        className={`home-button ${currentPath === "/movies" ? "active" : ""}`}
      >
        Movies
      </button>
      <button
        onClick={() => handleNavigation("/tvshows")}
        className={`home-button ${currentPath === "/tvshows" ? "active" : ""}`}
      >
        TV Shows
      </button>
      <button
        onClick={() => handleNavigation("/anime")}
        className={`home-button ${currentPath === "/anime" ? "active" : ""}`}
      >
        Anime
      </button>
      <button
        onClick={() => handleNavigation("/books")}
        className={`home-button ${currentPath === "/books" ? "active" : ""}`}
      >
        Books
      </button>
    </div>
  );
};

export default Navigation;

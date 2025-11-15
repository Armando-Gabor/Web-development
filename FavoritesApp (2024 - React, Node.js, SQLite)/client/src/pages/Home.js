import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
import "./Pages.css";

const Home = () => {
  const [isNavigating, setIsNavigating] = useState(false);
  const navigate = useNavigate();

  const handleNavigation = (path) => {
    setIsNavigating(true);
    setTimeout(() => {
      navigate(path);
    }, 500); // Match this with CSS transition duration
  };

  return (
    <>
      <div className={`home-container ${isNavigating ? "nav-active" : ""}`}>
        <button
          onClick={() => handleNavigation("/games")}
          className="home-button"
        >
          Games
        </button>
        <button
          onClick={() => handleNavigation("/movies")}
          className="home-button"
        >
          Movies
        </button>
        <button
          onClick={() => handleNavigation("/tvshows")}
          className="home-button"
        >
          TV Shows
        </button>
        <button
          onClick={() => handleNavigation("/anime")}
          className="home-button"
        >
          Anime
        </button>
        <button
          onClick={() => handleNavigation("/books")}
          className="home-button"
        >
          Books
        </button>
      </div>
    </>
  );
};

export default Home;

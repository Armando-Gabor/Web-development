//Imports
const express = require("express");
const database = require("./models");
const path = require("path");
const fs = require("fs");

//Implementations of imports
const app = express();
const cors = require("cors");

//Uses
app.use(express.json());
app.use(cors());

process.removeAllListeners("warning");

// Serve static files first, before API routes
app.use(express.static("./build"));

app.use(
  express.static("static/js", {
    setHeaders: (res, path) => {
      if (path.endsWith(".js")) {
        res.setHeader("Content-Type", "application/javascript");
      }
    },
  })
);

app.use(
  express.static("static/css", {
    setHeaders: (res, path) => {
      if (path.endsWith(".css")) {
        res.setHeader("Content-Type", "text/css");
      }
    },
  })
);

// Serve other static files
app.use(
  express.static(path.join(__dirname, "static", "media"), {
    setHeaders: (res, path) => {
      if (path.endsWith(".jpg")) {
        res.setHeader("Content-Type", "image/jpeg");
      }
    },
  })
);

//Routers
const postRouter = require("./routes/games");
app.use("/games", postRouter);
const postRouter2 = require("./routes/anime");
app.use("/anime", postRouter2);
const postRouter3 = require("./routes/movies");
app.use("/movies", postRouter3);
const postRouter4 = require("./routes/tvshows");
app.use("/tvshows", postRouter4);
const postRouter5 = require("./routes/books");
app.use("/books", postRouter5);

// Database sync
database.sequelize.sync().then(() => {
  app.listen(3001, () => console.log("Listening on port 3001"));
});

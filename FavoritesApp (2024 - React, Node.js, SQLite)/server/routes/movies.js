const express = require("express");
const router = express.Router();
const { movies } = require("../models");

router.get("/", async (req, res) => {
  try {
    const movieList = await movies.findAll();
    res.json({ data: movieList }); // Wrap response in data property
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

router.post("/", async (req, res) => {
  const movie = req.body;
  const result = await movies.create(movie);
  res.json(result);
});

router.put("/:id", async (req, res) => {
  const id = req.params.id;
  await movies.update(req.body, {
    where: { id: id },
  });
  res.json({ success: true });
});

router.delete("/:id", async (req, res) => {
  const id = req.params.id;
  await movies.destroy({
    where: { id: id },
  });
  res.json({ success: true });
});

module.exports = router;

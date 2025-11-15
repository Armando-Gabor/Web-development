const express = require("express");
const router = express.Router();
const { anime } = require("../models");

router.get("/", async (req, res) => {
  try {
    const animeList = await anime.findAll();
    res.json({ data: animeList }); // Wrap response in data property
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

router.post("/", async (req, res) => {
  const anime_body = req.body;
  const result = await anime.create(anime_body);
  res.json(result);
});

router.put("/:id", async (req, res) => {
  const id = req.params.id;
  await anime.update(req.body, {
    where: { id: id },
  });
  res.json({ success: true });
});

router.delete("/:id", async (req, res) => {
  const id = req.params.id;
  await anime.destroy({
    where: { id: id },
  });
  res.json({ success: true });
});

module.exports = router;

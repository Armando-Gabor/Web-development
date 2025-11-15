const express = require("express");
const router = express.Router();
const { games } = require("../models");

router.get("/", async (req, res) => {
  try {
    const gameList = await games.findAll();
    res.json({ data: gameList }); // Wrap response in data property
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

router.post("/", async (req, res) => {
  const game = req.body;
  const result = await games.create(game);
  res.json(result);
});

router.put("/:id", async (req, res) => {
  const id = req.params.id;
  await games.update(req.body, {
    where: { id: id },
  });
  res.json({ success: true });
});

router.delete("/:id", async (req, res) => {
  const id = req.params.id;
  await games.destroy({
    where: { id: id },
  });
  res.json({ success: true });
});

module.exports = router;

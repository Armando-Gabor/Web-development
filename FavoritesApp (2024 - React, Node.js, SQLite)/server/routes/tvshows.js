const express = require("express");
const router = express.Router();
const { tvshows } = require("../models");

router.get("/", async (req, res) => {
  try {
    const tvshowList = await tvshows.findAll();
    res.json({ data: tvshowList }); // Wrap response in data property
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

router.post("/", async (req, res) => {
  const tvshow = req.body;
  const result = await tvshows.create(tvshow);
  res.json(result);
});

router.put("/:id", async (req, res) => {
  const id = req.params.id;
  await tvshows.update(req.body, {
    where: { id: id },
  });
  res.json({ success: true });
});

router.delete("/:id", async (req, res) => {
  const id = req.params.id;
  await tvshows.destroy({
    where: { id: id },
  });
  res.json({ success: true });
});

module.exports = router;

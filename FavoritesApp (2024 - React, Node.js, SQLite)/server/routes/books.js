const express = require("express");
const router = express.Router();
const { books } = require("../models");

router.get("/", async (req, res) => {
  try {
    const bookList = await books.findAll();
    res.json({ data: bookList }); // Wrap response in data property
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

router.post("/", async (req, res) => {
  const book = req.body;
  const result = await books.create(book);
  res.json(result);
});

router.put("/:id", async (req, res) => {
  const id = req.params.id;
  await books.update(req.body, {
    where: { id: id },
  });
  res.json({ success: true });
});

router.delete("/:id", async (req, res) => {
  const id = req.params.id;
  await books.destroy({
    where: { id: id },
  });
  res.json({ success: true });
});

module.exports = router;

module.exports = (sequelize, DataTypes) => {
  const books = sequelize.define("books", {
    name: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    rank: {
      type: DataTypes.INTEGER,
      allowNull: false,
    },
  });

  return books;
};

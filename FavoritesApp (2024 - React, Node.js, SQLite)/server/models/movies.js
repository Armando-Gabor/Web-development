module.exports = (sequelize, DataTypes) => {
  const movies = sequelize.define("movies", {
    name: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    rank: {
      type: DataTypes.INTEGER,
      allowNull: false,
    },
  });

  return movies;
};

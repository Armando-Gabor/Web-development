module.exports = (sequelize, DataTypes) => {
  const games = sequelize.define("games", {
    name: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    rank: {
      type: DataTypes.INTEGER,
      allowNull: false,
    },
  });

  return games;
};

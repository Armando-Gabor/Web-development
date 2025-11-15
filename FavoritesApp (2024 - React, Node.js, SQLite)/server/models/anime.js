module.exports = (sequelize, DataTypes) => {
  const anime = sequelize.define("anime", {
    name: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    rank: {
      type: DataTypes.INTEGER,
      allowNull: false,
    },
  });

  return anime;
};

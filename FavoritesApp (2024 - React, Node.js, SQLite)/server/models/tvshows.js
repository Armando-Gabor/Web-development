module.exports = (sequelize, DataTypes) => {
  const tvshows = sequelize.define("tvshows", {
    name: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    rank: {
      type: DataTypes.INTEGER,
      allowNull: false,
    },
  });

  return tvshows;
};

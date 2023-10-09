module.exports = (sequelize,DataTypes) => {
    const Neighborhood = sequelize.define('Neighborhood',{
          NeighbourhoodID: {
            type: DataTypes.INTEGER,
            allowNull: false,
            primaryKey: true,
            autoIncrement: true,
          },
          Name: {
            type: DataTypes.STRING,
            allowNull: false,
            validate: {
              notEmpty: true,
              len: [2, 50],
            },
          },
          CrimeRate: {
            type: DataTypes.FLOAT,
            allowNull: false,
            validate: {
              min: 0,
              max: 100,
            },
          },
          NearbySchools: {
            type: DataTypes.TEXT,
            allowNull: false,
            validate: {
              notEmpty: true,
            },
          },
        },
        {
          sequelize,
          timestamps: false,
          modelName: 'Neighborhood',
          tableName: 'Neighborhood',
        }
      );

    return Neighborhood;
}
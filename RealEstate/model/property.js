module.exports = (sequelize,DataTypes) => {

    const Property = sequelize.define('Property', {
        PropertyID: {
          type: DataTypes.INTEGER,
          primaryKey: true,
          autoIncrement: true,
          allowNull: false
        },
        BuildingType: {
          type: DataTypes.STRING(50),
          allowNull: false,
          validate: {
            notEmpty: true,
            len: [1, 50]
          }
        },
        Availability: {
          type: DataTypes.BOOLEAN,
          allowNull: false,
          defaultValue: true
        },
        No_of_rooms: {
          type: DataTypes.INTEGER,
          allowNull: false,
          validate: {
            notEmpty: true,
            isInt: true,
            min: 1,
            max: 100
          }
        },
        SquareFootage: {
          type: DataTypes.INTEGER,
          allowNull: false,
          validate: {
            notEmpty: true,
            isInt: true,
            min: 1,
            max: 1000000
          }
        },
        TypeOfBusiness: {
          type: DataTypes.STRING(50),
          allowNull: true,
          validate: {
            len: [0, 50]
          }
        },
        Description: {
          type: DataTypes.TEXT,
          allowNull: true
        },
        Price: {
          type: DataTypes.FLOAT,
          allowNull: false,
          validate: {
            notEmpty: true,
            isFloat: true,
            min: 0.01,
            max: 1000000.00
          }
        },
        NeighbourhoodID: {
          type: DataTypes.INTEGER,
          allowNull: false,
          references: {
            model: 'Neighborhood',
            key: 'NeighbourhoodID'
          }
        },
        City: {
          type: DataTypes.STRING(50),
          allowNull: false,
          validate: {
            notEmpty: true,
            len: [1, 50]
          }
        },
        State: {
          type: DataTypes.STRING(50),
          allowNull: false,
          validate: {
            notEmpty: true,
            len: [1, 50]
          }
        },
        StreetAddress: {
          type: DataTypes.STRING(100),
          allowNull: false,
          validate: {
            notEmpty: true,
            len: [1, 100]
          }
        },
        ZipCode: {
          type: DataTypes.STRING(10),
          allowNull: false,
          validate: {
            notEmpty: true,
            len: [1, 10]
          }
        }
      }, {
        sequelize,
        modelName: 'Property',
        tableName: 'Property',
        timestamps: false
      });

    return Property;
}
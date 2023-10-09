module.exports = (sequelize,DataTypes) => {

    const Agency = sequelize.define('Agency',{
          AgencyID: {
            type: DataTypes.INTEGER,
            primaryKey: true,
            autoIncrement: true,
          },
          AgencyName: {
            type: DataTypes.STRING,
            allowNull: false,
            validate: {
              notNull: {
                msg: 'Please enter an agency name',
              },
              len: {
                args: [3, 50],
                msg: 'Agency name must be between 3 and 50 characters',
              },
            },
          },
          Rating: {
            type: DataTypes.FLOAT,
            allowNull: false,
            validate: {
              notNull: {
                msg: 'Please enter a rating',
              },
              min: {
                args: [0],
                msg: 'Rating must be greater than or equal to 0',
              },
              max: {
                args: [5],
                msg: 'Rating must be less than or equal to 5',
              },
            },
          },
          PhoneNumber: {
            type: DataTypes.STRING,
            allowNull: false,
            validate: {
              notNull: {
                msg: 'Please enter a phone number',
              },
              len: {
                args: [10, 15],
                msg: 'Phone number must be between 10 and 15 digits',
              },
              isNumeric: {
                msg: 'Phone number must only contain digits',
              },
            },
          },
          PropertyID: {
            type: DataTypes.INTEGER,
            allowNull: false,
            validate: {
              notNull: {
                msg: 'Please enter a property ID',
              },
              isInt: {
                msg: 'Property ID must be an integer',
              },
            },
            references: {
              model: 'Property',
              key: 'propertyID',
            },
          },
          City: {
            type: DataTypes.STRING,
            allowNull: false,
            validate: {
              notNull: {
                msg: 'Please enter a city',
              },
              len: {
                args: [2, 50],
                msg: 'City must be between 2 and 50 characters',
              },
            },
          },
          State: {
            type: DataTypes.STRING,
            allowNull: false,
            validate: {
              notNull: {
                msg: 'Please enter a state',
              },
              len: {
                args: [2, 50],
                msg: 'State must be between 2 and 50 characters',
              },
            },
          },
          StreetAddress: {
            type: DataTypes.STRING,
            allowNull: false,
            validate: {
              notNull: {
                msg: 'Please enter a street address',
              },
              len: {
                args: [5, 100],
                msg: 'Street address must be between 5 and 100 characters',
              },
            },
          },
          ZipCode: {
            type: DataTypes.STRING,
            allowNull: false,
            validate: {
              notNull: {
                msg: 'Please enter a zip code',
              },
              len: {
                args: [5, 10],
                msg: 'Zip code must be between 5 and 10 characters',
              },
              isNumeric: {
                msg: 'Zip code must only contain digits',
              },
            },
          },
        },
        {
          sequelize,
          modelName: 'Agency',
          tableName: 'Agency',
          timestamps: false
        }
      );

    return Agency;
}
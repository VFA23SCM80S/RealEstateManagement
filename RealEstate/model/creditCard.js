module.exports = (sequelize,DataTypes) => {

    const CreditCard = sequelize.define('CreditCard', {
        CreditCard_ID: {
          type: DataTypes.INTEGER,
          primaryKey: true,
          autoIncrement: true
        },
        CreditCardNumber: {
          type: DataTypes.STRING(16),
          allowNull: false,
          validate: {
            len: [16, 16],
            isCreditCard: true
          }
        },
        User_ID: {
          type: DataTypes.INTEGER,
          allowNull: false,
          references: {
            model: 'User',
            key: 'User_ID',
          },
        },
        CVV: {
          type: DataTypes.STRING(3),
          allowNull: false,
          validate: {
            len: [3, 3],
            isNumeric: true
          }
        },
        ExpirationDate: {
          type: DataTypes.DATEONLY,
          allowNull: false,
          validate: {
            isDate: true,
            isAfter: new Date().toISOString().substring(0, 7) // Ensure expiration date is not in the past
          }
        },
        RenterID: {
          type: DataTypes.INTEGER,
          allowNull: false,
          references: {
            model: 'Renter',
            key: 'renterID',
          },
        }
      }, {
        sequelize,
        timestamps: false,
        modelName: 'CreditCard',
        tableName: 'CreditCard',
        indexes: [
          {
            unique: true,
            fields: ['CreditCardNumber']
          }
        ]
      });

    return CreditCard;
}
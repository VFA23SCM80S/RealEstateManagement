module.exports = (sequelize,DataTypes) => {

    const Booking = sequelize.define('Booking',{
            BookingID: {
              type: DataTypes.INTEGER,
              primaryKey: true,
              autoIncrement: true,
            },
            Start_date: {
              type: DataTypes.DATE,
              allowNull: false,
              validate: {
                isDate: true,
              },
            },
            End_date: {
              type: DataTypes.DATE,
              allowNull: false,
              validate: {
                isDate: true,
              },
            },
            PropertyID: {
              type: DataTypes.INTEGER,
              allowNull: false,
              references: {
                model: 'Property',
                key: 'propertyID',
              },
            },
            RenterID: {
              type: DataTypes.INTEGER,
              allowNull: false,
              references: {
                model: 'Renter',
                key: 'renterID',
              },
            },
            CreditCardID: {
              type: DataTypes.INTEGER,
              allowNull: false,
              references: {
                model: 'CreditCard',
                key: 'creditCard_ID',
              },
            },
            Booking_date: {
              type: DataTypes.DATE,
              allowNull: false,
              defaultValue: DataTypes.NOW,
              validate: {
                isDate: true,
              },
            },
            User_ID: {
              type: DataTypes.INTEGER,
              allowNull: false,
              references: {
                model: 'User',
                key: 'User_ID',
              },
            },
          }, {
            sequelize,
            modelName: 'Booking',
            tableName: 'Booking',
            timestamps: false,
          });

    return Booking;
}
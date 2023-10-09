module.exports = (sequelize,DataTypes) => {

    const Renter = sequelize.define('Renter', {
        RenterID: {
          type: DataTypes.INTEGER,
          primaryKey: true,
          autoIncrement: true
        },
        Address: {
          type: DataTypes.STRING,
          allowNull: false
        },
        Budget: {
          type: DataTypes.FLOAT,
          allowNull: false,
          validate: {
            min: 0
          }
        },
        PreferredLocation: {
          type: DataTypes.STRING,
          allowNull: false
        },
        PhoneNumber: {
          type: DataTypes.STRING,
          allowNull: false,
          validate: {
            is: /^\d{10}$/i // validate as a 10-digit phone number
          }
        },
        DesiredMoveInDate: {
          type: DataTypes.DATEONLY,
          allowNull: false
        },
        FirstName: {
          type: DataTypes.STRING,
          allowNull: false
        },
        MiddleName: {
          type: DataTypes.STRING,
          allowNull: true
        },
        LastName: {
          type: DataTypes.STRING,
          allowNull: false
        }
      }, {
        sequelize,
        modelName: 'Renter',
        tableName: 'Renter',
        timestamps: false
      });

    return Renter;
}
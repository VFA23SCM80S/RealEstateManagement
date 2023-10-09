module.exports = (sequelize,DataTypes) => {
    const User = sequelize.define('User', {
        User_ID: {
          type: DataTypes.INTEGER,
          allowNull: false,
          primaryKey: true,
          autoIncrement: true,
        },
        PhoneNumber: {
          type: DataTypes.STRING,
          allowNull: false,
          validate: {
            isNumeric: true,
          },
        },
        Address: {
          type: DataTypes.STRING,
          allowNull: false,
        },
        EmailAddress: {
          type: DataTypes.STRING,
          allowNull: false,
          validate: {
            isEmail: true,
          },
        },
        FirstName: {
          type: DataTypes.STRING,
          allowNull: false,
        },
        MiddleName: {
          type: DataTypes.STRING,
          allowNull: true,
        },
        LastName: {
          type: DataTypes.STRING,
          allowNull: false,
        },
      }, {
        sequelize,
        timestamps: false,
        modelName: 'User',
        tableName: 'User',
      });

    return User;
}
module.exports = (sequelize,DataTypes) => {

    const User_Address = sequelize.define('User_Address', {
        AddressID: {
          type: DataTypes.INTEGER,
          primaryKey: true,
          autoIncrement: true,
          allowNull: false,
        },
        UserID: {
          type: DataTypes.INTEGER,
          references: {
            model: 'User',
            key: 'UserID',
          },
          allowNull: false,
        },
        Address: {
          type: DataTypes.STRING,
          allowNull: false,
          validate: {
            notNull: {
              msg: 'Address is required',
            },
            notEmpty: {
              msg: 'Address cannot be empty',
            },
          },
        },
      },
      {
        sequelize,
        modelName: 'User_Address',
        tableName: 'User_Address',
        timestamps: false
      });

    return User_Address;
}
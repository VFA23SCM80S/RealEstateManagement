module.exports = (sequelize,DataTypes) => {

    const Agent = sequelize.define('Agent', {
        AgentID: {
          type: DataTypes.INTEGER,
          allowNull: false,
          primaryKey: true,
          autoIncrement: true,
        },
        JobTitle: {
          type: DataTypes.STRING,
          allowNull: false,
          validate: {
            notNull: {
              msg: 'JobTitle field is required',
            },
            notEmpty: {
              msg: 'JobTitle field is required',
            },
          },
        },
        EmailAddress: {
          type: DataTypes.STRING,
          allowNull: false,
          unique: true,
          validate: {
            notNull: {
              msg: 'EmailAddress field is required',
            },
            notEmpty: {
              msg: 'EmailAddress field is required',
            },
            isEmail: {
              msg: 'EmailAddress must be a valid email address',
            },
          },
        },
        PhoneNumber: {
          type: DataTypes.STRING,
          allowNull: false,
          unique: true,
          validate: {
            notNull: {
              msg: 'PhoneNumber field is required',
            },
            notEmpty: {
              msg: 'PhoneNumber field is required',
            },
            isNumeric: {
              msg: 'PhoneNumber must be a valid phone number',
            },
          },
        },
        FirstName: {
          type: DataTypes.STRING,
          allowNull: false,
          validate: {
            notNull: {
              msg: 'FirstName field is required',
            },
            notEmpty: {
              msg: 'FirstName field is required',
            },
          },
        },
        MiddleName: {
          type: DataTypes.STRING,
          allowNull: true,
        },
        LastName: {
          type: DataTypes.STRING,
          allowNull: false,
          validate: {
            notNull: {
              msg: 'LastName field is required',
            },
            notEmpty: {
              msg: 'LastName field is required',
            },
          },
        },
      },
      {
        sequelize,
        modelName: 'Agent',
        tableName: 'Agent',
        timestamps: false,
      });

    return Agent;
}
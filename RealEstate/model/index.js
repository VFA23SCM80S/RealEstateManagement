var fs        = require('fs');
var path      = require('path');
var Sequelize = require('sequelize');
const Settings = require("../settings");
const dbsettings = Settings[Settings.env].db;
var db        = {};


var sequelize = new Sequelize(dbsettings.database, dbsettings.user, dbsettings.password, dbsettings.options);

fs.readdirSync(__dirname)
  .filter(file => file.indexOf(".") !== 0 && file !== "index.js")
  .forEach(file => {
    const model = require(path.join(__dirname, file))(sequelize, Sequelize.DataTypes);
    db[model.name] = model;
  });

//-------------------------//
//db.User.hasMany(db.User_Address, { foreignKey: 'User_ID' });
//db.User.hasMany(db.Renter, { foreignKey: 'User_ID' });
//db.User.hasMany(db.Booking, { foreignKey: 'user_id' });

//db.User_Address.belongsTo(db.User, { foreignKey: 'user_id' });
// db.User_Address.belongsTo(db.Neighborhood, { foreignKey: 'neighborhood_id' });

// db.Neighborhood.hasMany(db.User_Address, { foreignKey: 'neighborhood_id' });
// db.Neighborhood.hasMany(db.Property, { foreignKey: 'neighborhood_id' });

// db.Property.belongsTo(db.Neighborhood, { foreignKey: 'neighborhood_id' });
// db.Property.belongsTo(db.Agency, { foreignKey: 'agency_id' });
// db.Property.hasMany(db.Booking, { foreignKey: 'property_id' });

// db.Renter.belongsTo(db.User, { foreignKey: 'user_id' });
// db.Renter.belongsTo(db.Property, { foreignKey: 'property_id' });

// db.CreditCard.belongsTo(db.Renter, { foreignKey: 'renter_id' });

// //db.Booking.belongsTo(db.User, { foreignKey: 'user_id' });
// db.Booking.belongsTo(db.Renter, { foreignKey: 'renter_id' });
// db.Booking.belongsTo(db.Property, { foreignKey: 'property_id' });

// db.Agency.hasMany(db.Property, { foreignKey: 'agency_id' });
// db.Agency.hasMany(db.Agent, { foreignKey: 'agency_id' });

// db.Agent.belongsTo(db.Agency, { foreignKey: 'agency_id' });




  sequelize.authenticate().then(() => {
    console.log('Connection has been established successfully.');
 }).catch((error) => {
    console.error('Unable to connect to the database: ', error);
 });

  sequelize.sync({
    force : false,
    logging : console.log
  }).then(function () {
    console.log('Database Synched!!');
  }).catch(function (err) {
    console.log(err, "Something went wrong with the Database Connection!")
  });
  
  
  db.sequelize = sequelize;
  db.Sequelize = Sequelize;
  
  module.exports= db;
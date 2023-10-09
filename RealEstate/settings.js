require("dotenv").config({silent : true});

module.exports = {
    port: process.env.PORT || 8080,
    env: process.env.NODE_ENV || "development",
    listPerPage: 10,
    
    // Environment-dependent settings
    development: {
      db: {
        host: "localhost",
        user: "root",
        password: "lapinours",
        database: "realestate",
        port : "3306",
        waitForConnections: true,
        connectionLimit: 10,
        queueLimit: 2,
        options: {
          dialect: "mysql",
          pool: {
            max: 5,                   //Maximum number of connection in pool
            min: 0,                   //Minimum number of connection in pool
            acquire: 60000,           //The maximum time, in milliseconds, that pool will try to get connection before throwing error
            idle: 30000               //The maximum time, in milliseconds, that a connection can be idle before being released. 
          }
        }
      }
    },
    production: {
      db: {
        host: "",
        username: "",
        password: "",
        database: "",
        options: {
          dialect: "mysql",
          pool: {
            max: 5,                   //Maximum number of connection in pool
            min: 0,                   //Minimum number of connection in pool
            acquire: 60000,           //The maximum time, in milliseconds, that pool will try to get connection before throwing error
            idle: 30000               //The maximum time, in milliseconds, that a connection can be idle before being released. 
          }
        },
        storage: "db/database.sqlite"
      }
    }
};
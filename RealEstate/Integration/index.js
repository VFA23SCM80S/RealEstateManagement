var fs        = require('fs');
var path      = require('path');
var daos      = {};

fs.readdirSync(__dirname)
  .filter(file => file.indexOf(".") !== 0 && file !== "index.js")
  .forEach(file => {
    const dao = require(path.join(__dirname, file));
    daos[file.split(".")[0]] = dao;
  });

module.exports= daos
const { log } = require('console');
const express = require('express');
const router = express.Router();
var fs        = require('fs');
var path      = require('path');

const crudAPI = require('./CrudAPI');
var routes      = {};

fs.readdirSync(__dirname)
  .filter(file => file.indexOf(".") !== 0 && file !== "router.js")
  .forEach(file => {
    const route = require(path.join(__dirname, file));
    let key= (file.split(".")[0]).split("API")[0];
    routes[key] = route;
    router.use(`/${key}`,routes[key]);
  });

router.use('/api',crudAPI);
  
router.use('/',(req,res)=>{
    res.status(200).send("You are in the main router");
});

module.exports = router;
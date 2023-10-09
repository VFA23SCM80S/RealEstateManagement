const Settings = require("./settings");
const express = require('express'); 
const mainroute = require('./controller/router');                        
const app = express();

const port = Settings.port;

app.use(express.json());
app.use(
  express.urlencoded({
    extended: true,
  })
);

app.use('/test',(req,res)=>{
    res.status(200).send("Application is Up and Running!!");
});

app.use("/",mainroute);

app.use((err, req, res, next) => {
    const statusCode = err.statusCode || 500;
    console.error(err.message, err.stack);
    res.status(statusCode).json({ message: err.message });
    return;
});

app.listen(port , ()=>{ console.log(`Server running on...http://localhost:${port}`)});
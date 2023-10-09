const express = require('express');
const router = express.Router();
const Urlservice= require('../services/urlHelper');


//Getting all data
router.get('/:model',(req,res)=>{
    Urlservice[req.params.model].findAll().then(data => {
        return res.status(200).json({
            success: true,
            data: JSON.parse(JSON.stringify(data))
        });
    }).catch(function (err) {
        console.log(err);
        return res.status(400).json({
            success: false, 
            message: "Issue in Processing your Request" 
        });
    });
});


//Getting Id data
router.get('/:model/:id',(req,res)=>{
    Urlservice[req.params.model].find(req.params.id).then(data=>{
        if(data.length!=0){
            return res.status(200).json({
                success: true,
                data: JSON.parse(JSON.stringify(data))
            });
        }else{
            return res.status(404).json({
                success: false,
                message: "Data Not found"
            })
        }
        
    }).catch(function (err) {
        console.log(err);
        return res.status(400).json({
            success: false, 
            message: "Issue in Processing your Request" 
        });
    });
});


//Deleting Data
router.delete('/:model/:id',(req,res)=>{
    Urlservice[req.params.model].find(req.params.id).then(data=>{
        if(data.length!=0){
            Urlservice[req.params.model].delete(req.params.id).then(data=>{
                return res.status(200).json({
                    success: true,
                    "message": "Deleted Successfully"
                });
            }).catch(function (err) {
                console.log(err);
                return res.status(400).json({
                    success: false, 
                    message: err.message || "Issue in Processing your Request" 
                });
            });
        }else{
            return res.status(404).json({
                success: false,
                message: "Data Not found"
            })
        }
        
    })
    
});


//Inserting DATA
router.post('/:model/',(req,res)=>{
    if (JSON.stringify(req.body) == "{}") {
        return res.status(400).json({
            success: false, 
            message: "No data is Provided" 
        });
    }
    columns=[]
    for(var i in req.body){
        columns.push(req.body[i]);
    };
    Urlservice[req.params.model].create(columns).then(data => {
        return res.status(200).json({
            success: true,
            data: JSON.parse(JSON.stringify(data))
        });
    }).catch(function (err) {
        console.log(err);
        return res.status(400).json({
            success: false, 
            message: err.message || "Issue in Processing your Request" 
        });
    });
});


//Updating DATA
router.put('/:model/:id',(req,res)=>{
    if (JSON.stringify(req.body) == "{}") {
        return res.status(400).json({
            success: false, 
            message: "No data is Provided" 
        });
    }
    Urlservice[req.params.model].find(req.params.id).then(data=>{
        if(data.length!=0){
            let columns=[]
            for(var i in req.body){
                columns.push(req.body[i]);
            }
            Urlservice[req.params.model].update(req.params.id,columns).then(data=>{
                res.status(200).json({
                    success: true,
                    "message": "Updated Successfully"
                });
            }).catch(function (err) {
                console.log(err);
                return res.status(400).json({
                    success: false, 
                    message: err.message || "Issue in Processing your Request" 
                });
            });
        }else{
            return res.status(404).json({
                success: false,
                message: "Data Not found"
            })
        }
        
    }).catch(function (err) {
        return res.status(400).json({
            success: false, 
            message: err.message || "Issue in Processing your Request" 
        });
    });
});


module.exports= router;
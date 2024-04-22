const express = require("express");
const serverStatic = require("servir-static");
const path = require("path");



const app = express();

app.use("/", serverStatic(path.join(__dirname, "/resource")));

app.get(/.*/, function(req, res){

    res.sendFile(path.join(__dirname,  "/resource/home.blade.php"));

});

const port = process.env.port || 8080;
app.listen(port);
console.log('app is listening on port : ${port}');
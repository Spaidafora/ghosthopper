var express = require('express'); 
var app = express(); 

// routes 

//home page
app.get('/', (req, res) => {
    res.send("Hello World")
})


// get departments 
app.get("/departments", (req, res) => {
    res.send("Departments list")
})



// dynamic  urls using params 

// courses by dept
app.get("/courses/:dept", (req, res) => {
    res.send(`Courses per dept: ${req.params.dept}`)
})

// courses by id 
app.get("/courses/dept/:id", (req, res) => {
    res.send(`Get Course ID: ${req.params.id}`)

})



// ability to search by prof, id, title, keyword, desc etc.
app.get("/search", (req, res) => {
    res.send("Ability to search anything")
})




app.listen(3000); 


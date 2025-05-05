var express = require('express'); 
const pool = require('./database.js');
const path = require('path'); 
const searchCourses = require('./search.js'); // search function
var app = express(); 

app.use(express.json()) 

app.use(express.static(__dirname)); // serve static files from the current directory i.e logo


app.get('/', (req, res) => {
    res.sendFile(path.join(__dirname, 'index.html'));
});


// routes 

//home page
//app.get('/', (req, res) => {
 //   res.send("hello world") 
//})

//sample


// api calls +  dynamic  urls using params 


//courses
app.get('/api/courses', async (req, res) => {
    console.log('Got a request at /api/courses');
    try {
        const results = await pool.query(
            'SELECT * FROM courses' 
        ); 
        res.json(results.rows); 
    }
    catch (error) { // 404 not found - server cannot find req resource
        console.error(error); 
        console.log('Our servers cannot find that data!')
        res.status(404).send("Couldn't find that in the DB");
    }
    
})

// courses by id 

app.get("/api/courses/:id", async (req, res) => {
    console.log('Got a request at /api/courses');
    try {
        const courseId = req.params['id']; //get from url
        console.log("RequestedId: ", courseId);
        const results = await pool.query(
            'SELECT * FROM courses WHERE "id" = $1',
            [courseId] 
        ); 
        res.json(results.rows);  //php fetch 
    }
    catch (error) { // 404 not found - server cannot find req resource
       // console.error(error); 
        console.log('Our servers cannot find course ID data!')
        res.status(404).send("Couldn't find that in the DB-id");
    }
    
})


// get all departments 
app.get("/departments", (req, res) => {
    res.send("Departments list")
})

// courses by dept name
app.get("/api/courses/department/:dept", (req, res) => {
    res.send(`Courses per dept: ${req.params.dept}`)
})



//courses by time 

app.get("/api/courses/currently", async (req, res) => {
    console.log('Got a request at /api/courses/currently');
    try {
        
        const results = await pool.query(
            `SELECT *
            FROM courses
            WHERE NOW()::time BETWEEN 
            TO_TIMESTAMP(meeting_start, 'HH12:MIAM')::time AND 
            TO_TIMESTAMP(meeting_end, 'HH12:MIAM')::time`
        ); 
        res.json(results.rows);  //php fetch 
    }
    catch (error) { // 404 not found - server cannot find req resource
       // console.error(error); 
        console.log('Our servers cannot this data!')
        res.status(404).send("Couldn't find that in the DB-t");
    }
    
})






// search function from search.js
app.get("/search", searchCourses);


//const port = process.env.PORT || 3000; 
const port = 3000; 

app.listen(port, () => console.log(`Server is running @ ${port} ...`)); 


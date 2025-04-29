var express = require('express'); 
const pool = require('./database.js');
var app = express(); 

app.use(express.json()) 





// routes 

//home page
app.get('/', (req, res) => {
    res.send("Hello World")

})

//sample
//const courses = [
  //  { id: 1, name: "Intro to CS" },
 //   { id: 2, name: "Web Development" },
//];


// dynamic  urls using params 


// get departments 
app.get("/departments", (req, res) => {
    res.send("Departments list")
})

// courses by dept
app.get("/api/courses/department/:dept", (req, res) => {
    res.send(`Courses per dept: ${req.params.dept}`)
})


// courses 


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


// ability to search by prof, id, title, keyword, desc etc.
app.get("/search", (req, res) => {
    res.send("Ability to search anything")
})

//const port = process.env.PORT || 3000; 
const port = 3000; 

app.listen(port, () => console.log(`Server is running @ ${port} ...`)); 


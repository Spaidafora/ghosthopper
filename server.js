var express = require('express'); 
var app = express(); 

//csv parse 
const {parse} = require('csv-parse')
const fs = require('fs') //local file 

const parser = parse({columns: true}, function (err, records) {
    //console.log(records);


    const filtered = records.map((row) => {
        // course info 
        const subject = row['Subject']  + " " + row['Course Number']; 
        const title = row['Course Title'];
        const units = row['Min Units'];
        const instructor = row['Instructor Name'];
        const email = row['Email'];
        const location = row['Building'] + " " + row['Room'];
   
        // meeting
        const meetingStart = row['Mtg Start'];
        const meetingEnd = row['Mtg End'];  

        const weekDays= row['Mon'] + " " + row['Tues'] + " " +  row['Wed'] + "" + row['Thu'] + " " +  row['Fri']; 
 
        // dates
        const startDate = row['Start Date']; 
        const endDate = row['End Date'];

        // capacity

        const maxCapacity  = row['Req Rm Cap']; 
        const totalEnrolled = row['Tot Enrl']; 
        const totalWaitlisted = row['Wait Tot']; 

        return {  subject, title, units, instructor , email, location
            , meetingStart, meetingEnd, weekDays, startDate, endDate, 
        maxCapacity, totalEnrolled, totalWaitlisted}
    
});
    console.log(filtered); 
}); 





fs.createReadStream(__dirname+'/cmps.csv').pipe(parser); 

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



app.use(express.json()) 
app.listen(3000, () => console.log("Server is running")); 


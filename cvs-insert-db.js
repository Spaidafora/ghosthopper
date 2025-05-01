
//require('dotenv').config({   //loads .env
  //  path: './conn.env'
//});                         

const { Pool } = require('pg');
const {parse} = require('csv-parse')
const fs = require('fs') //local file 

//env not working. hardcoded for now. 
const pool = new Pool({
    host: 'localhost',
    user: 'postgres',
    database: 'ghostDB',
    password: 'postgres',  
    port: 5432

});




async function testConnection(){
    try {
        const result = await pool.query ('SELECT NOW()'); 
        console.log('Database connected successfully'); 
    }
    catch (err) {
        console.error("Failed to connect to Database", err);

    }
}

testConnection();


//csv parse 


const parser = parse({columns: true}, async function (err, records) {
    //console.log(records);


    const filtered = records.map((row) => {
        // course info 
        const subject = row['Subject']  + " " + row['Course Number']; 
        const id = row['Course Number']; 
        const title = row['Course Title'];
        const courseDescription = row['Course Description'];
        const units = row['Min Units'];
        const instructor = row['Instructor Name'];
        const email = row['Email'];
        const location = row['Building'] + " " + row['Room'];
        const coursePrereq = row['Course Prerequisites']; 
   
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

        return {  subject, id, title, courseDescription, units, instructor , email, location
            , coursePrereq, meetingStart, meetingEnd, weekDays, startDate, endDate, 
        maxCapacity, totalEnrolled, totalWaitlisted } 
    
    });
    // temp so we don't duplicate table

    await pool.query('DELETE FROM courses'); 

    //insert into db

    for (const row of filtered) {
        try {
            await pool.query(
                `INSERT INTO courses (
                 subject, id, title, courseDescription, units, instructor, email, location, coursePrereq,
                 meeting_start, meeting_end, weekdays,
                 start_date, end_date, max_capacity, total_enrolled, total_waitlisted)

                 VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10,$11,$12,$13,$14, $15, $16, $17)`,

                 [
                    row.subject, row.id, row.title, row.courseDescription, row.units, row.instructor , row.email, row.location, row.coursePrereq,
                    row.meetingStart, row.meetingEnd, row.weekDays, row.startDate, row.endDate, 
                    row.maxCapacity, row.totalEnrolled, row.totalWaitlisted
                 ]
            );
        } catch (error) {
            console.error(error); 
            console.log("Unable to insert data into DB");
        }

    }
    console.log("Done inserting into DB");
    await pool.end(); //not exporting, can close
}); 


//start reading and parsing... 
fs.createReadStream(__dirname+'/cmps-all.csv').pipe(parser); 











// pool = dynamic and consistent connection

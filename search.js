const pool = require('./database.js'); //connect to db

function searchCourses(req, res) {
    const searchTerm = req.query.searchTerm;    //query parameters from the URL  ./search?searchTerm=...
    console.log('Search term received:', searchTerm);


    // server side val
    //localhoost:3000/search?searchTerm=

    if (!searchTerm || searchTerm.trim() === '') {
        console.log('No search term provided');
        res.status(400).json({ error: 'No search term provided' });
        return;
    }

  

    let queryText = `
    SELECT * FROM courses WHERE subject ILIKE $1 
    OR title ILIKE $1
    OR id::text ILIKE $1
    OR courseDescription ILIKE $1
    OR instructor ILIKE $1
    OR email ILIKE $1
    OR location ILIKE $1
    OR coursePrereq ILIKE $1
    OR meeting_start::text ILIKE $1
    OR meeting_end::text ILIKE $1
    OR weekdays::text ILIKE $1
    OR start_date::text ILIKE $1
    OR end_date::text ILIKE $1
    
    `; //[value] injected below 
    
    // values variable is used to pass the search term to the query
    // i.e $1 = %searchTerm%
    const values = `%${searchTerm}%`; // js template literal + wildcard

    pool.query(queryText, [values], (error, results) => {
        
        if (error) {
            console.log('Error executing query:', error);
            res.status(500).send('Error executing query');
        } 
        
        if (results.rows.length == 0) {
            console.log('No results found');
            res.status(400).json({ error: 'No search term provided' });
        }
        
       
        const resultsDisplay = results.rows; // get rows from db
        console.log('Search results:', resultsDisplay);
        res.json(resultsDisplay); // send back to client in json
        

    });

}



// export the search function
module.exports = searchCourses
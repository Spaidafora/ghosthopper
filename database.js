
require('dotenv').config({   //loads .env
    path: './conn.env'
});                         

const { Pool } = require('pg');


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
        const testResult = await pool.query ('SELECT NOW()');

        console.log(testResult.rows); 
        console.log('Database connected successfully'); 
    }
    catch (err) {
        console.error("Failed to connect to Database");

    }
}

testConnection();






module.exports = pool; 




// pool = dynamic and consistent connection

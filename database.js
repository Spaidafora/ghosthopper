
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
        const result = await pool.query ('SELECT NOW()'); 
        console.log('Database connected successfully'); 
    }
    catch (err) {
        console.error("Failed to connect to Database", err);

    }
}

testConnection();



module.exports = pool; 




// pool = dynamic and consistent connection

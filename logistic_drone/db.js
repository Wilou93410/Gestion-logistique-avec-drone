const mysql = require('mysql');

const db = mysql.createConnection({
    host: 'localhost',
    user: 'admin',
    password: 'As@24d',
    database: 'logistic_drone'
});

db.connect((err) => {
    if (err) throw err;
    console.log('Connecté à la base de données MySQL');
});

module.exports = db;

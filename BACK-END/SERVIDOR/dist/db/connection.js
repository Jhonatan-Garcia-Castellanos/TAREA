import mysql from 'mysql';
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '', // Recuerda: en XAMPP por defecto la contraseña viene vacía
    database: 'yutuvideo',
});
export default connection;
//# sourceMappingURL=connection.js.map
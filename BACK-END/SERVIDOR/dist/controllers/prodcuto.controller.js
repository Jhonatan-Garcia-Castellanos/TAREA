import connection from '../db/connection.js';
export const getProductos = (req, res) => {
    connection.query('SELECT * FROM productos', (err, data) => {
        if (err) {
            console.log(err);
        }
        else {
            res.json({
                data
            });
        }
    });
};
//# sourceMappingURL=prodcuto.controller.js.map
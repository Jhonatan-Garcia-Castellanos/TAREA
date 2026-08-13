import express, { type Application } from 'express';
import connection from '../db/connection.js'
import routesProducto from '../routes/producto.routes.js'
import routesDefault from '../routes/defaul.routes.js'
import routesUsuario from '../routes/usuario.routes.js'

class Server {
    private app: express.Application;
    private port: string;

    constructor(){
        this.app = express();
        this.port = process.env.PORT || "3000";
        this.listen();
        this.conectDB();
        this.midLewares();
        this.routes();
    }

    listen() {
        this.app.listen(this.port, () => {
            console.log('Servidor correidno en el puerto ', this.port);
        })

    }

    conectDB() {
        connection.connect((err) => {
            if (err) {
                console.log(err)
            } else {
                console.log('Base de datos conectada exitosamente!');
            }
        });
    }

    routes() {
        this.app.use('/', routesDefault);
        this.app.use('/api/productos', routesProducto);
        this.app.use('/api/usuarios', routesUsuario);
    }

    midLewares() {
        this.app.use(express.json());
    }

}

export default Server;
import { Request, Response } from 'express';
import connection from '../db/connection.js'
import bcrypt from 'bcrypt';

export const addUsuario = async (req: Request, res: Response) => {

    const { nombre, password } = req.body;

    const hashedPassword = await bcrypt.hash(password, 10);

    connection.query('INSERT INTO usuarios SET ?', { nombre: nombre, password: hashedPassword } , (err, data) =>{
        if(err) {
            console.log(err)

        } else {
            res.json ({
            msg: 'Add Usuario',
            })

        }   
        
    })


}

export const loginUser = (req: Request, res: Response) => {
   
    const { nombre, password } = req.body

    connection.query('SELECT * FROM usuarios WHERE nombre = ' + connection.escape(nombre), (err, data) => {
        if(err) {
            console.log(err)
        } else {
            if(data.length == 0) {
            res.json({
                msg: 'Login',

            })
            } else {

            }
            console.log(data)
        }
    })


    res.json({
        msg: 'Login',
        body: req.body
    })

}
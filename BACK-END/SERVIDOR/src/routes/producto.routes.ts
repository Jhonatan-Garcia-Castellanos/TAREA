import { Router } from 'express';
import { getProductos } from '../controllers/prodcuto.controller.js';

const router = Router();

router.get('/', getProductos);

export default router;
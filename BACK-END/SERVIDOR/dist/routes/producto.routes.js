import { Router } from 'express';
import { getProductos } from '../controllers/prodcuto.controller.js';
import validateToken from './validate-token.js';
const router = Router();
router.get('/', validateToken, getProductos);
export default router;
//# sourceMappingURL=producto.routes.js.map
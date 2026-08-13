import { Router } from 'express';
import { addUsuario, loginUser } from '../controllers/usuario.controller.js';
const router = Router();
router.post('/', addUsuario);
router.post('/login', loginUser);
export default router;
//# sourceMappingURL=usuario.routes.js.map
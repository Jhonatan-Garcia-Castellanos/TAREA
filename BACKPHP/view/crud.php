<?php
if (!isset($_SESSION["user"])) {
    header("Location: index.php?action=login");
    exit();
}

$host = 'localhost';
$dbname = 'login_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["crud_action"]) && $_POST["crud_action"] === "save") {
    $id = $_POST['id'] ?? '';
    $user_input = $_POST['username'] ?? '';
    $pass_input = $_POST['password'] ?? '';

    if (!empty($id)) {
        if (!empty($pass_input)) {
            $stmt = $pdo->prepare("UPDATE usuarios SET username = ?, password = ? WHERE id = ?");
            $stmt->execute([$user_input, $pass_input, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE usuarios SET username = ? WHERE id = ?");
            $stmt->execute([$user_input, $id]);
        }
    } else {
        $stmt = $pdo->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
        $stmt->execute([$user_input, $pass_input]);
    }
    header("Location: index.php?action=crud");
    exit();
}

if (isset($_GET["delete_id"])) {
    $id = $_GET["delete_id"];
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php?action=crud");
    exit();
}

$stmt = $pdo->query("SELECT * FROM usuarios ORDER BY id DESC");
$registros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Usuarios - ÁCIDO COLOMBIA</title>
    <link rel="stylesheet" href="/TAREA/BACKPHP/public/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body class="dashboard-body crud-body">

    <div class="dashboard-container crud-container">
        
        <aside class="sidebar">
            <div class="sidebar-brand">
                <img src="/TAREA/BACKPHP/public/LOGO2.png" class="brand-icon" alt="Logo Ácido Colombia">                
                <span>ACIDO</span>
            </div>

            <hr class="sidebar-divider">

            <a href="index.php" class="nav-item">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">INTERFACE</div>

            <a href="index.php?action=crud" class="nav-item active">
                <i class="fa-solid fa-gear"></i>
                <span>CRUD</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fa-solid fa-wrench"></i>
                <span>Utilidades</span>
            </a>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">COMPLEMENTOS</div>

            <div class="sidebar-dropdown open">
                <button type="button" class="nav-item dropdown-toggle" onclick="toggleSubmenu(this)">
                    <div class="nav-label">
                        <i class="fa-solid fa-folder"></i>
                        <span>Páginas</span>
                    </div>
                    <i class="fa-solid fa-chevron-right arrow-icon"></i>
                </button>

                <div class="sidebar-submenu">
                    <a href="/TAREA/BACKPHP/index.php?action=login">
                        <i class="fa-solid fa-right-to-bracket"></i> Iniciar Sesión
                    </a>
                    <a href="/TAREA/BACKPHP/view/register.php">
                        <i class="fa-solid fa-user-plus"></i> Registro
                    </a>
                    <a href="index.php?action=crud" class="active">
                        <i class="fa-solid fa-users"></i> Usuarios
                    </a>
                </div>
            </div>

            <a href="#" class="nav-item">
                <i class="fa-solid fa-chart-area"></i>
                <span>Gráficas</span>
            </a>

            <a href="#" class="nav-item">
                <i class="fa-solid fa-table"></i>
                <span>Tablas</span>
            </a>

            <div class="sidebar-promo">
                <i class="fa-solid fa-rocket promo-icon"></i>
                <p><strong>ÁCIDO Pro</strong> incluye funciones avanzadas y componentes exclusivos.</p>
            </div>
        </aside>

        <main class="main-content">
            
            <header class="topbar">
                <div class="search-bar">
                    <input type="text" placeholder="Buscar...">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>

                <div class="topbar-user">
                    <div class="icon-badge">
                        <i class="fa-solid fa-bell"></i>
                        <span class="badge red">3+</span>
                    </div>
                    <div class="icon-badge">
                        <i class="fa-solid fa-envelope"></i>
                        <span class="badge yellow">7</span>
                    </div>
                    <div class="divider-vertical"></div>
                    <div class="user-info">
                        <span><?php echo htmlspecialchars($_SESSION["user"]["username"] ?? 'Usuario Demo'); ?></span>
                        <div class="avatar"></div>
                    </div>
                </div>
            </header>

            <div class="content-padding-crud">
                
                <div class="page-header">
                    <h2 id="form-title-text">GESTIÓN DE USUARIOS</h2>
                </div>

                <div class="crud-container-box">
                    <div class="crud-modern-card" style="margin-top: 0;">
                        <div class="crud-modern-header">
                            <i class="fa-solid fa-user-pen"></i>
                            <span id="form-card-title">Formulario de Registro de Usuario</span>
                        </div>
                        <div class="crud-form-body">
                            <form action="index.php?action=crud" method="POST">
                                <input type="hidden" name="crud_action" value="save">
                                <input type="hidden" name="id" id="form-id">
                                
                                <div style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 15px; align-items: center;">
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #4a5568; margin-bottom: 6px; text-transform: uppercase;">Usuario</label>
                                        <input type="text" class="crud-input" name="username" id="form-username" placeholder="Ingrese el username" required>
                                    </div>
                                    <div>
                                        <label style="display: block; font-size: 11px; font-weight: 700; color: #4a5568; margin-bottom: 6px; text-transform: uppercase;">Contraseña</label>
                                        <input type="text" class="crud-input" name="password" id="form-password" placeholder="Ingrese la contraseña">
                                    </div>
                                    <div style="padding-top: 18px; display: flex; gap: 8px;">
                                        <button type="submit" class="btn-crud-save" id="btn-submit-text">Guardar</button>
                                        <button type="button" class="btn-crud-cancel" id="btn-cancelar" onclick="limpiarFormulario()">Cancelar</button>
                                    </div>
                                </div>
                                <small style="color: #a0aec0; display: block; margin-top: 12px; font-size: 11px;">* Al editar, si dejas la contraseña en blanco, se mantendrá la anterior guardada en el sistema.</small>
                            </form>
                        </div>
                    </div>

                    <div class="crud-modern-card">
                        <div class="crud-modern-header">
                            <i class="fa-solid fa-table-list"></i>
                            <span>Usuarios Registrados en el Sistema</span>
                        </div>
                        <div style="overflow-x: auto;">
                            <table class="crud-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Username</th>
                                        <th>Password (Prueba)</th>
                                        <th style="text-align: right;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($registros)): ?>
                                        <?php foreach ($registros as $row): ?>
                                            <tr>
                                                <td style="font-weight: 600; color: #718096;">#<?php echo $row['id']; ?></td>
                                                <td><strong style="color: #1a202c;"><?php echo htmlspecialchars($row['username']); ?></strong></td>
                                                <td><code style="background: #edf2f7; padding: 4px 8px; border-radius: 4px; color: #4a5568; word-break: break-all; max-width: 250px; display: inline-block;"><?php echo htmlspecialchars($row['password']); ?></code></td>
                                                <td style="text-align: right;">
                                                    <button type="button" class="btn-action-edit" onclick="editarRegistro(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['username'], ENT_QUOTES); ?>')"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
                                                    <a href="index.php?action=crud&delete_id=<?php echo $row['id']; ?>" class="btn-action-delete" onclick="return confirm('¿Estás seguro de eliminar este usuario?');"><i class="fa-solid fa-trash"></i> Eliminar</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" style="text-align: center; color: #a0aec0; padding: 40px; font-style: italic;">No hay usuarios registrados actualmente.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <script>
        function toggleSubmenu(button) {
            const dropdown = button.parentElement;
            dropdown.classList.toggle('open');
        }

        function editarRegistro(id, username) {
            document.getElementById('form-title-text').innerText = "MODIFICAR USUARIO";
            document.getElementById('form-card-title').innerText = "Editando el Registro #" + id;
            document.getElementById('form-id').value = id;
            document.getElementById('form-username').value = username;
            document.getElementById('form-password').value = '';
            document.getElementById('form-password').placeholder = "Nueva contraseña (opcional)";
            document.getElementById('btn-submit-text').innerText = "Actualizar Cambios";
            document.getElementById('btn-cancelar').style.display = 'inline-block';
            window.scrollTo({top: 0, behavior: 'smooth'});
        }

        function limpiarFormulario() {
            document.getElementById('form-title-text').innerText = "GESTIÓN DE USUARIOS";
            document.getElementById('form-card-title').innerText = "Formulario de Registro de Usuario";
            document.getElementById('form-id').value = '';
            document.getElementById('form-username').value = '';
            document.getElementById('form-password').value = '';
            document.getElementById('form-password').placeholder = "Ingrese la contraseña";
            document.getElementById('btn-submit-text').innerText = "Guardar";
            document.getElementById('btn-cancelar').style.display = 'none';
        }
    </script>
</body>
</html>

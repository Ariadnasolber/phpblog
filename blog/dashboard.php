<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: /SoundVibes/public/user.php"); // Redirigir si no es admin
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy(); // Cerrar sesión
    header("Location: /SoundVibes/src/views/Auth/login.php");
    exit();
}

// Leer usuarios desde el archivo JSON
$users = json_decode(file_get_contents('../../data/users.json'), true);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Administrador</title>
    <link rel="stylesheet" href="/public/css/dashboard.css">
</head>

<body>
    <h1>Welcome to your Dashboard, <span class="username-highlight"><?php echo $_SESSION['username']; ?></span>!</h1>
    <a href="?logout=true" class="button-logout">LOGOUT →</a>

    <div class="dashboard-container">
        <div id="add-user">
            <form action="/SoundVibes/api/api.php" class="form" method="POST">
                <div class="title">Welcome,<span> Add User</span></div>
                <input type="text" placeholder="Name" name="username" class="input" required>
                <input type="password" placeholder="Password" name="password" class="input" required>
                <div class="user-add-buttons">
                    <select class="rol-options" name="role">
                        <option value="admin">Administrador</option>
                        <option value="user">Usuario</option>
                    </select>
                    <button class="button-add" type="submit" name="action" value="create">Add →</button>
                </div>
            </form>
        </div>
        <div id="update-users">
            <h2>Users List</h2>
            <table class="users-table">
                <tr>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                        <td>
                            <!-- Botón para eliminar -->
                            <form action="dashboard.php" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="username" value="<?php echo $user['username']; ?>">
                                <button class="button-delete" type="submit">Delete</button>
                            </form>
                            <a href="update_user.php?username=<?php echo $user['username']; ?>"
                                class="button-update">Update</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

</body>

</html>
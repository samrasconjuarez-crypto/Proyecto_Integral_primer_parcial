<?php
session_start();
include 'db.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if ($nombre === '' || $password === '') {
        $error = "Todos los campos son obligatorios.";
    } elseif ($password !== $confirm) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Verificar si el empleado ya existe
        $chk = $conn->prepare('SELECT id FROM empleados WHERE nombre = ?');
        $chk->bind_param('s', $nombre);
        $chk->execute();
        $chk->store_result();

        if ($chk->num_rows > 0) {
            $error = "El empleado ya existe.";
        } else {
            // Insertar empleado con hash de contraseña
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $ins = $conn->prepare('INSERT INTO empleados (nombre, password) VALUES (?, ?)');
            $ins->bind_param('ss', $nombre, $hash);

            if ($ins->execute()) {
                $success = "Empleado creado correctamente.";
            } else {
                $error = "Error al crear empleado: " . $conn->error;
            }
        }
        $chk->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Registrar Empleado</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Registrar empleado</h2>

<?php if (!empty($error)) echo "<p class='error'>" . htmlspecialchars($error) . "</p>"; ?>
<?php if (!empty($success)) echo "<p class='success'>" . htmlspecialchars($success) . "</p>"; ?>

<form method="post">
    <input type="text" name="nombre" placeholder="Nombre completo" required><br>
    <input type="password" name="password" placeholder="Contraseña" required><br>
    <input type="password" name="confirm" placeholder="Confirmar contraseña" required><br>
    <button type="submit">Crear empleado</button>
</form>

<p><a href="dashboard.php">Volver al dashboard</a></p>
</body>
</html>

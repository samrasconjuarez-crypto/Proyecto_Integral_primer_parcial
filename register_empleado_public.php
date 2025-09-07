<?php
include 'db.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($usuario === '' || $nombre === '' || $password === '') {
        $error = "Completa todos los campos.";
    } else {
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

        $ins = $conn->prepare('INSERT INTO empleados (usuario, nombre, password) VALUES (?, ?, ?)');
        $ins->bind_param('sss', $usuario, $nombre, $pass_hash);

        if ($ins->execute()) {
            header('Location: index.php');
            exit;
        } else {
            $error = "Error al registrar el empleado: " . $ins->error;
        }
        $ins->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Registro de Empleado</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Registro de Empleado - Particular Books</h2>
<?php if ($error) echo "<p class='error'>" . htmlspecialchars($error) . "</p>"; ?>
<form method="post">
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="text" name="nombre" placeholder="Nombre completo" required><br>
    <input type="password" name="password" placeholder="Contraseña" required><br>
    <button type="submit">Registrarme</button>
</form>
<p><a href="index.php">Volver al login</a></p>
</body>
</html>

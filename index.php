<?php
session_start();
include 'db.php';

$error = '';
$success = '';

// ----------------------
// Registrar salida de empleado
// ----------------------
if(isset($_POST['registrar_salida_empleado'])){
    $id = intval($_POST['empleado_salida'] ?? 0);
    if($id > 0){
        $stmt = $conn->prepare("UPDATE accesos SET fecha_salida = NOW() WHERE id = ?");
        $stmt->bind_param('i', $id);
        if($stmt->execute()){
            $success = "Salida registrada correctamente para el empleado.";
        } else {
            $error = "Error al registrar salida: ".$stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Selecciona un empleado válido.";
    }
}

// ----------------------
// Login de empleados
// ----------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_empleado'])) {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($usuario === '' || $password === '') {
        $error = "Completa ambos campos.";
    } else {
        $stmt = $conn->prepare('SELECT id, nombre, password FROM empleados WHERE usuario = ? LIMIT 1');
        $stmt->bind_param('s', $usuario);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res && $res->num_rows === 1) {
            $row = $res->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['usuario'] = $row['nombre'];

                // Registrar acceso
                $ins = $conn->prepare('INSERT INTO accesos (tipo, nombre) VALUES (?, ?)');
                $tipo = 'Empleado';
                $nombre = $row['nombre'];
                $ins->bind_param('ss', $tipo, $nombre);
                $ins->execute();

                header('Location: dashboard.php');
                exit;
            } else {
                $error = "Contraseña incorrecta";
            }
        } else {
            $error = "Usuario no encontrado";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Particular Books - Acceso</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Acceso Empleados - Particular Books</h2>
<img src="particular_books.png" width="30%" alt="" style="display:block; margin:auto;">

<!-- Mostrar mensajes -->
<?php if ($error) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
<?php if ($success) echo "<p class='success'>".htmlspecialchars($success)."</p>"; ?>

<!-- Formulario Login Empleado -->
<form method="post" autocomplete="off">
    <input type="text" name="usuario" placeholder="Usuario" required><br>
    <input type="password" name="password" placeholder="Contraseña" required><br>
    <button type="submit" name="login_empleado">Ingresar</button>
</form>

<!-- Formulario Salida Empleado -->
<h3>Registrar salida de empleado</h3>
<?php
$res = $conn->query("SELECT id, nombre FROM accesos WHERE tipo='Empleado' AND fecha_salida IS NULL ORDER BY fecha_entrada ASC");
?>
<form method="post">
    <select name="empleado_salida">
        <option value="">-- Selecciona tu nombre --</option>
        <?php while($row = $res->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nombre']); ?></option>
        <?php endwhile; ?>
    </select>
    <button type="submit" name="registrar_salida_empleado">Registrar salida</button>
</form>

<!-- Enlaces a visitantes -->
<p><a href="registro_visitante.php">Registrar visita</a></p>
<p><a href="index_visitante_salida.php">Registrar salida de visitante</a></p>
<p><a href="register_empleado_public.php">Registrarse como empleado</a></p>
</body>
</html>

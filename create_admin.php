<?php
include 'db.php';

$nombre = "Administrador";
$password = "12345";
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare('SELECT id FROM empleados WHERE nombre = ?');
$stmt->bind_param('s', $nombre);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $upd = $conn->prepare('UPDATE empleados SET password = ? WHERE nombre = ?');
    $upd->bind_param('ss', $hash, $nombre);
    $upd->execute();
    echo "Contraseña actualizada correctamente.";
} else {
    $ins = $conn->prepare('INSERT INTO empleados (nombre, password) VALUES (?, ?)');
    $ins->bind_param('ss', $nombre, $hash);
    $ins->execute();
    echo "Empleado creado correctamente.";
}
$stmt->close();
?>

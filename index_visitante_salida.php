<?php
include 'db.php';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['visitante_id'] ?? 0);

    if ($id > 0) {
        $stmt = $conn->prepare("UPDATE accesos SET fecha_salida = NOW() WHERE id = ? AND fecha_salida IS NULL");
        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $success = "Salida registrada correctamente.";
        } else {
            $error = "Error al registrar la salida: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error = "Selecciona un visitante válido.";
    }
}

$result = $conn->query("SELECT id, nombre, tipo FROM accesos WHERE tipo!='Empleado' AND fecha_salida IS NULL ORDER BY fecha_entrada ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Salida Visitante - Particular Books</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Registrar Salida de Visitante</h2>
<?php if ($error) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
<?php if ($success) echo "<p class='success'>".htmlspecialchars($success)."</p>"; ?>

<form method="post">
    <label for="visitante">Selecciona tu nombre:</label><br>
    <select name="visitante_id" id="visitante" required>
        <option value="">-- Selecciona tu nombre --</option>
        <?php while ($row = $result->fetch_assoc()): ?>
            <option value="<?php echo $row['id']; ?>">
                <?php echo htmlspecialchars($row['nombre'] . " (" . $row['tipo'] . ")"); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>
    <button type="submit">Registrar Salida</button>
</form>

<p><a href="index.php">Volver al inicio</a></p>
</body>
</html>

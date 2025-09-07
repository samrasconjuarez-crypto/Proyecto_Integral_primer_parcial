<?php
include 'db.php';
$error = '';
$success = '';

$tipos = ['Corrector de estilo', 'Ilustrador', 'Escritor', 'Reportero', 'Impresor', 'Entrega de alimentos', 'Visita familiar'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $tipo   = $_POST['tipo'] ?? '';

    if ($nombre === '' || $tipo === '') {
        $error = "Completa todos los campos.";
    } else {
        // Usamos transacción para asegurar que se guarde en ambas tablas
        $conn->begin_transaction();

        try {
            // Insertar en visitantes
            $stmt1 = $conn->prepare("INSERT INTO visitantes (nombre, tipo, fecha_registro) VALUES (?, ?, NOW())");
            $stmt1->bind_param('ss', $nombre, $tipo);
            $stmt1->execute();
            $stmt1->close();

            // Insertar en accesos
            $stmt2 = $conn->prepare("INSERT INTO accesos (tipo, nombre) VALUES (?, ?)");
            $stmt2->bind_param('ss', $tipo, $nombre);
            $stmt2->execute();
            $stmt2->close();

            // Confirmar transacción
            $conn->commit();
            $success = "Visitante registrado correctamente.";
        } catch (Exception $e) {
            // Revertir si hay error
            $conn->rollback();
            $error = "Error al registrar visitante: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Registro de Visitante</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Registro de Visitante - Particular Books</h2>
<?php if ($error) echo "<p class='error'>".htmlspecialchars($error)."</p>"; ?>
<?php if ($success) echo "<p class='success'>".htmlspecialchars($success)."</p>"; ?>
<form method="post">
    <input type="text" name="nombre" placeholder="Nombre completo" required><br>
    <select name="tipo" required>
        <option value="">-- Selecciona tipo de visitante --</option>
        <?php foreach ($tipos as $t): ?>
            <option value="<?php echo htmlspecialchars($t); ?>"><?php echo htmlspecialchars($t); ?></option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit">Registrar visita</button>
</form>
<p><a href="index.php">Volver al inicio</a></p>
</body>
</html>

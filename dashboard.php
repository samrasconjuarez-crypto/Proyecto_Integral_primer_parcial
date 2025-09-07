<?php
session_start();
include 'db.php';
if (!isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit;
}

if (isset($_GET['salida_id'])) {
    $id = intval($_GET['salida_id']);
    $stmt = $conn->prepare("UPDATE accesos SET fecha_salida = NOW() WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Dashboard - Particular Books</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</h2>
<p><a href="logout.php">Regresar a inicio</a></p>

<h3>Empleados</h3>
<table border="1">
<tr>
    <th>Nombre</th><th>Tipo</th><th>Entrada</th><th>Salida</th><th>Acción</th>
</tr>
<?php
$res = $conn->query("SELECT id,nombre,tipo,fecha_entrada,fecha_salida FROM accesos WHERE tipo='Empleado' ORDER BY fecha_entrada DESC");
while($row = $res->fetch_assoc()){
    echo "<tr>";
    echo "<td>".htmlspecialchars($row['nombre'])."</td>";
    echo "<td>".htmlspecialchars($row['tipo'])."</td>";
    echo "<td>".$row['fecha_entrada']."</td>";
    echo "<td>".($row['fecha_salida'] ?? 'Dentro')."</td>";
    if($row['fecha_salida']===null) echo "<td><a href='dashboard.php?salida_id=".$row['id']."'>Registrar salida</a></td>";
    else echo "<td>—</td>";
    echo "</tr>";
}
?>
</table>

<h3>Visitantes</h3>
<table border="1">
<tr>
    <th>Nombre</th><th>Tipo</th><th>Entrada</th><th>Salida</th><th>Acción</th>
</tr>
<?php
$res = $conn->query("SELECT id,nombre,tipo,fecha_entrada,fecha_salida FROM accesos WHERE tipo!='Empleado' ORDER BY fecha_entrada DESC");
while($row = $res->fetch_assoc()){
    echo "<tr>";
    echo "<td>".htmlspecialchars($row['nombre'])."</td>";
    echo "<td>".htmlspecialchars($row['tipo'])."</td>";
    echo "<td>".$row['fecha_entrada']."</td>";
    echo "<td>".($row['fecha_salida'] ?? 'Dentro')."</td>";
    if($row['fecha_salida']===null) echo "<td><a href='dashboard.php?salida_id=".$row['id']."'>Registrar salida</a></td>";
    else echo "<td>—</td>";
    echo "</tr>";
}
?>
</table>
</body>
</html>

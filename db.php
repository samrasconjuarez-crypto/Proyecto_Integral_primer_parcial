<?php
$host = "fdb1034.awardspace.net"; // Ajusta al host de AwardSpace
$user = "4667269_particularbooks"; // Tu usuario
$pass = "sS1/11/1Ss"; // Tu contraseña
$db   = "4667269_particularbooks"; // Nombre exacto de la base en AwardSpace

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>

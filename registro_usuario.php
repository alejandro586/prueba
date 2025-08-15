<?php
require_once 'config/database.php';

$db = new Database();
$conn = $db->conectar();

// Datos del nuevo usuario
$usuario = 'admin';
$clave_plana = '123456';  // Contraseña en texto plano
$clave_encriptada = password_hash($clave_plana, PASSWORD_DEFAULT);

// Eliminar usuarios antiguos (opcional)
$conn->exec("DELETE FROM usuarios WHERE usuario = '$usuario'");

// Insertar nuevo usuario
$stmt = $conn->prepare("INSERT INTO usuarios (usuario, contrasena) VALUES (:usuario, :contrasena)");
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':contrasena', $clave_encriptada);

if ($stmt->execute()) {
    echo "<h3 style='color:green;'>✅ Usuario '$usuario' creado correctamente con contraseña encriptada.</h3>";
} else {
    echo "<h3 style='color:red;'>❌ Error al crear el usuario.</h3>";
}
?>

<?php
include_once('../conexionBd.php');

function obtenerUsuarioPorDocumento($documentoId) {
    global $conexion;
    abrirConexion();
    $sql = "SELECT Contrasenia FROM tbl_usuario WHERE Documento = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $documentoId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    cerrarConexion();
    return $row;
}

function cambiarContraseña($documentoId, $newPassword) {
    global $conexion;
    abrirConexion();
    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
    $sql = "UPDATE tbl_usuario SET Contrasenia = ? WHERE Documento = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ss", $newPasswordHash, $documentoId);
    $result = $stmt->execute();
    cerrarConexion();
    return $result;
}
?>

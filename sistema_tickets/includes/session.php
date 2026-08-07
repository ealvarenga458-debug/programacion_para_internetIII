<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    $_SESSION['mensaje'] = "Debe iniciar sesión para acceder al sistema.";
    $_SESSION['tipo'] = "warning";
    header("Location: login.php");
    exit;
}
?>

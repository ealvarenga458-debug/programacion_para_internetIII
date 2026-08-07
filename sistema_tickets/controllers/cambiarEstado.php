<?php
require "../includes/session.php";
require "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && $_SESSION['rol'] === 'tecnico') {
    $id_ticket = intval($_POST['id_ticket']);
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("UPDATE tickets SET estado = ? WHERE id = ?");
    $stmt->bind_param("si", $estado, $id_ticket);

    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Estado del ticket #$id_ticket actualizado a '$estado'.";
        $_SESSION['tipo'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar el estado.";
        $_SESSION['tipo'] = "danger";
    }

    header("Location: ../index.php");
    exit;
}
?>

<?php
require "../includes/session.php";
require "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_usuario = $_SESSION['id_usuario'];
    $titulo = trim($_POST['titulo']);
    $descripcion = trim($_POST['descripcion']);
    $prioridad = $_POST['prioridad'];

    if (!empty($titulo) && !empty($descripcion) && !empty($prioridad)) {
        $stmt = $conn->prepare("INSERT INTO tickets (id_usuario, titulo, descripcion, prioridad) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id_usuario, $titulo, $descripcion, $prioridad);

        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "Ticket registrado con éxito.";
            $_SESSION['tipo'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al guardar el ticket.";
            $_SESSION['tipo'] = "danger";
        }
    } else {
        $_SESSION['mensaje'] = "Por favor, llene todos los campos obligatorios.";
        $_SESSION['tipo'] = "warning";
    }

    header("Location: ../index.php");
    exit;
}
?>
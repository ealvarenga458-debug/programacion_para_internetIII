<?php
require "includes/session.php";

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: index.php");
    exit;
}

include "includes/header.php";
include "includes/navbar.php";
?>

<div class="container" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fa-solid fa-plus-circle"></i> Nuevo Ticket</h2>
        <a href="index.php" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Regresar
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div id="alertaJS" class="alert alert-danger d-none" role="alert"></div>

            <form id="formTicket" action="controllers/guardarTicket.php" method="POST" onsubmit="return validarFormulario()">
                <div class="mb-3">
                    <label class="form-label">Título de la Incidencia</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Ej. Error al imprimir documentos">
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" rows="4" placeholder="Detalle lo sucedido..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prioridad</label>
                    <select name="prioridad" id="prioridad" class="form-select">
                        <option value="">-- Seleccione Prioridad --</option>
                        <option value="Baja">Baja</option>
                        <option value="Media">Media</option>
                        <option value="Alta">Alta</option>
                    </select>
                </div>

                <hr>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Guardar Ticket
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function validarFormulario() {
    const titulo = document.getElementById('titulo').value.trim();
    const descripcion = document.getElementById('descripcion').value.trim();
    const prioridad = document.getElementById('prioridad').value;
    const alerta = document.getElementById('alertaJS');

    if (titulo === '' || descripcion === '' || prioridad === '') {
        alerta.innerText = "Todos los campos son obligatorios.";
        alerta.classList.remove('d-none');
        return false;
    }
    alerta.classList.add('d-none');
    return true;
}
</script>

<?php include "includes/footer.php"; ?>
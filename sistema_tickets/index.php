<?php
require "includes/session.php";
require "config/db.php";

$id_usuario = $_SESSION['id_usuario'];
$rol = $_SESSION['rol'];

if ($rol === 'tecnico') {
    $query = "SELECT t.*, u.nombre AS usuario_nombre 
              FROM tickets t 
              JOIN usuarios u ON t.id_usuario = u.id 
              ORDER BY t.fecha_creacion DESC";
    $stmt = $conn->prepare($query);
} else {
    $query = "SELECT t.*, u.nombre AS usuario_nombre 
              FROM tickets t 
              JOIN usuarios u ON t.id_usuario = u.id 
              WHERE t.id_usuario = ? 
              ORDER BY t.fecha_creacion DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_usuario);
}

$stmt->execute();
$tickets = $stmt->get_result();

include "includes/header.php";
include "includes/navbar.php";
?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fa-solid fa-list-check"></i> Gestor de Incidencias</h2>
        <?php if ($rol === 'usuario'): ?>
            <a href="nuevoTicket.php" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Nuevo Ticket
            </a>
        <?php endif; ?>
    </div>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-<?php echo $_SESSION['tipo']; ?> alert-dismissible fade show">
            <?php echo $_SESSION['mensaje']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php 
        unset($_SESSION['mensaje']);
        unset($_SESSION['tipo']);
    endif; 
    ?>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Solicitante</th>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Prioridad</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <?php if ($rol === 'tecnico'): ?>
                                <th>Acción</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($tickets->num_rows > 0): ?>
                            <?php while ($row = $tickets->fetch_assoc()): 
                                $claseFila = ($row['prioridad'] === 'Alta') ? 'prioridad-alta' : '';
                                
                                $badgeEstado = 'badge-pendiente';
                                if ($row['estado'] === 'En Proceso') $badgeEstado = 'badge-en-proceso';
                                if ($row['estado'] === 'Resuelto') $badgeEstado = 'badge-resuelto';
                            ?>
                                <tr class="<?php echo $claseFila; ?>">
                                    <td><strong>#<?php echo $row['id']; ?></strong></td>
                                    <td><?php echo htmlspecialchars($row['usuario_nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                                    <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                                    <td>
                                        <span class="badge bg-secondary"><?php echo $row['prioridad']; ?></span>
                                    </td>
                                    <td>
                                        <span class="badge <?php echo $badgeEstado; ?>"><?php echo $row['estado']; ?></span>
                                    </td>
                                    <td><small><?php echo date('d/m/Y H:i', strtotime($row['fecha_creacion'])); ?></small></td>
                                    
                                    <?php if ($rol === 'tecnico'): ?>
                                        <td>
                                            <form action="controllers/cambiarEstado.php" method="POST" class="d-flex align-items-center">
                                                <input type="hidden" name="id_ticket" value="<?php echo $row['id']; ?>">
                                                <select name="estado" class="form-select form-select-sm me-1" onchange="this.form.submit()">
                                                    <option value="Pendiente" <?php if($row['estado'] === 'Pendiente') echo 'selected'; ?>>Pendiente</option>
                                                    <option value="En Proceso" <?php if($row['estado'] === 'En Proceso') echo 'selected'; ?>>En Proceso</option>
                                                    <option value="Resuelto" <?php if($row['estado'] === 'Resuelto') echo 'selected'; ?>>Resuelto</option>
                                                </select>
                                            </form>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8" class="text-center py-3">No hay tickets registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>
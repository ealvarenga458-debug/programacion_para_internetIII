<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <i class="fa-solid fa-ticket"></i> Soporte Técnico
        </a>
        <div class="d-flex align-items-center text-white me-3">
            <span class="me-3">
                <i class="fa-solid fa-user me-1"></i>
                <strong><?php echo $_SESSION['nombre']; ?></strong> (<?php echo ucfirst($_SESSION['rol']); ?>)
            </span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">
                <i class="fa-solid fa-right-from-bracket"></i> Salir
            </a>
        </div>
    </div>
</nav>

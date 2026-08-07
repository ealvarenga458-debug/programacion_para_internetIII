<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema de Tickets</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container" style="max-width: 420px;">
        <div class="card shadow">
            <div class="card-body p-4 text-center">
                <i class="fa-solid fa-ticket-simple fa-3x text-primary mb-3"></i>
                <h3 class="fw-bold">Tickets de Soporte</h3>
                <p class="text-muted">Inicia sesión para continuar</p>

                <?php if (isset($_SESSION['mensaje'])): 
                    $tipo = isset($_SESSION['tipo']) ? $_SESSION['tipo'] : 'danger';
                ?>
                    <div class="alert alert-<?php echo $tipo; ?> alert-dismissible fade show text-start" role="alert">
                        <?php echo $_SESSION['mensaje']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php 
                    unset($_SESSION['mensaje']);
                    unset($_SESSION['tipo']);
                endif; 
                ?>

                <form action="controllers/login.php" method="POST" class="text-start">
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="correo@ejemplo.com" required autofocus>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Clave</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Ingrese su clave" required>
                            <button type="button" class="btn btn-outline-secondary" onclick="mostrarPassword()">
                                <i class="fa-solid fa-eye" id="iconoPassword"></i>
                            </button>
                        </div>
                    </div>
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-right-to-bracket"></i> Iniciar Sesión
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function mostrarPassword() {
            const password = document.getElementById("password");
            const icono = document.getElementById("iconoPassword");
            if (password.type === "password") {
                password.type = "text";
                icono.classList.remove("fa-eye");
                icono.classList.add("fa-eye-slash");
            } else {
                password.type = "password";
                icono.classList.remove("fa-eye-slash");
                icono.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
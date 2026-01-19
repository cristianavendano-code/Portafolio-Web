<?php
include '../includes/headContent.php';
include '../includes/footer.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    headContent("Login Admin");
    ?>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- css de login  -->
    <link rel="stylesheet" href="../assets/css/login.css">

</head>

<body>
    <div class="login-container">
        <div class="glass-card">

            <!-- Titulo -->
            <h2>Panel Administrativo</h2>
            <p>Ingresa tus credenciales para continuar</p>

            <form action="actions.php" method="POST">
                <input type="hidden" name="action" value="login-admin">

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>

                        <input type="text" class="form-control" name="user" placeholder="Usuario" required>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100 mb-3">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Iniciar Sesión
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="../index.php" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Volver al Inicio
                </a>
            </div>
        </div>
    </div>

    <?php
    footer();
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
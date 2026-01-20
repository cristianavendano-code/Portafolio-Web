<?php
session_start();
include '../includes/headContent.php';
include '../includes/functions.php';
include '../includes/navbar.php';
include '../config/conection.php';
include '../includes/footer.php';

if (!isset($_SESSION['admin_logged']) || $_SESSION['admin_logged'] !== true) {
    header('Location: login.php');
    exit;
}

$unidades = obtenerUnidades($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php headContent("Admin Dashboard"); ?>
</head>

<body>
    <?php navbar(); ?>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="../admin/dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo 'Nuevo Proyecto'; ?>
                </li>
            </ol>
        </div>
    </nav>

    <!-- Formulario -->
    <section class="form-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Header -->
                    <div class="card border-0 shadow-lg">
                        <div class="card-header bg-primary text-white py-3">
                            <h4 class="mb-0">
                                <i class="bi bi-plus-circle me-2"></i>
                                <?php echo 'Crear Nuevo Proyecto'; ?>
                            </h4>
                        </div>

                        <div class="card-body p-4">

                            <form action="actions.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="createProject">

                                <!-- Unidad -->
                                <div class="mb-4">
                                    <label for="unit_id" class="form-label fw-semibold">
                                        <i class="bi bi-collection text-primary me-2"></i>
                                        Unidad
                                    </label>
                                    <select class="form-select" id="unit_id" name="unit_id" required>
                                        <option value="">Selecciona una unidad...</option>
                                        <?php foreach ($unidades as $unidad): ?>
                                        <option value="<?php echo $unidad['id']; ?>">
                                            Unidad <?php echo $unidad['id']; ?>:
                                            <?php echo htmlspecialchars($unidad['name']); ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <small class="form-text text-muted">
                                        Selecciona la unidad temática a la que pertenece este proyecto
                                    </small>
                                </div>

                                <!-- Título -->
                                <div class="mb-4">
                                    <label for="title" class="form-label fw-semibold">
                                        <i class="bi bi-card-heading text-primary me-2"></i>
                                        Título del Proyecto
                                    </label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Ej: Sistema de Gestión de Inventario" maxlength="150" required>
                                    <small class="form-text text-muted">
                                        Máximo 150 caracteres
                                    </small>
                                </div>

                                <!-- Descripción -->
                                <div class="mb-4">
                                    <label for="description" class="form-label fw-semibold">
                                        <i class="bi bi-card-text text-primary me-2"></i>
                                        Descripción
                                    </label>
                                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe brevemente el proyecto, sus características principales y objetivos..."></textarea>
                                    <small class="form-text text-muted">
                                        Proporciona una descripción clara y concisa del proyecto
                                    </small>
                                </div>

                                <!-- Tecnologías -->
                                <div class="mb-4">
                                    <label for="technologies" class="form-label fw-semibold">
                                        <i class="bi bi-code-slash text-primary me-2"></i>
                                        Tecnologías Utilizadas
                                    </label>
                                    <input type="text" class="form-control" id="technologies" name="technologies"
                                        placeholder="HTML, CSS, JavaScript, PHP, MySQL">
                                    <small class="form-text text-muted">
                                        Separa las tecnologías con comas (Ej: HTML, CSS, JavaScript)
                                    </small>
                                </div>

                                <!-- Imagen -->
                                <div class="mb-4">
                                    <label for="image" class="form-label fw-semibold">
                                        <i class="bi bi-image text-primary me-2"></i>
                                    </label>
                                    Imagen del Proyecto
                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                    <small class="form-text text-muted">
                                        Formatos aceptados: JPG, PNG, GIF. Tamaño recomendado: 800x600px
                                    </small>
                                </div>

                                <!-- URL Externa -->
                                <div class="mb-4">
                                    <label for="external_url" class="form-label fw-semibold">
                                        <i class="bi bi-link-45deg text-primary me-2"></i>
                                        URL del Proyecto
                                    </label>
                                    <input type="url" class="form-control" id="external_url" name="external_url"
                                        placeholder="https://servidor.edu.mx/mi-proyecto" required>
                                    <small class="form-text text-muted">
                                        URL completa donde está alojado el proyecto (debe iniciar con http:// o
                                        https://)
                                    </small>
                                </div>

                                <!-- Botones -->
                                <hr class="my-4">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="bi bi-save me-2"></i>
                                        Crear Proyecto
                                    </button>
                                    <a href="dashboard.php" class="btn btn-outline-secondary px-4">
                                        <i class="bi bi-x-circle me-2"></i>
                                        Cancelar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    // Preview de imagen
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Validar tamaño (máximo 5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('La imagen no debe superar los 5MB');
                this.value = '';
                return;
            }

            // Validar tipo
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Solo se permiten archivos JPG, PNG o GIF');
                this.value = '';
                return;
            }
        }
    });
    </script>

    <?php footer(); ?>
</body>
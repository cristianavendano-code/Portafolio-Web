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

$proyectos = obtenerTodosProyectos($pdo);
$total_proyectos = count($proyectos);
$total_unidades = count(obtenerUnidades($pdo));

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
                <li class="breadcrumb-item active" aria-current="page">Dashboard Admin</li>
            </ol>
        </div>
    </nav>

    <!-- Dashboard -->
    <section class="dashboard py-5">
        <div class="container">
            <!-- Header del Dashboard -->
            <div class="row align-items-center mb-4">
                <div class="col-md-6">
                    <h1 class="display-6 fw-bold mb-0">
                        Panel de Control
                    </h1>
                    <p class="text-muted mb-0">
                        Bienvenido, <strong><?php echo $_SESSION['admin_user']; ?></strong>
                    </p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="project-form.php" class="btn btn-primary me-2">
                        <i class="bi bi-plus-circle me-2"></i>
                        Nuevo Proyecto
                    </a>

                    <form action="actions.php" method="POST" class="d-inline">
                        <input type="hidden" name="action" value="logout-admin">
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tarjetas de Estadísticas -->
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-folder-fill text-primary fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-1">Total Proyectos</h6>
                                    <h2 class="fw-bold mb-0"><?php echo $total_proyectos; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-collection-fill text-success fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-1">Unidades</h6>
                                    <h2 class="fw-bold mb-0"><?php echo $total_unidades; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="bg-info bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-calendar-check text-info fs-2"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="text-muted mb-1">Último Proyecto</h6>
                                    <h2 class="fw-bold mb-0">
                                        <?php 
                                    if (!empty($proyectos)) {
                                        echo date('d/m/Y', strtotime($proyectos[0]['created_at']));
                                    } else {
                                        echo 'N/A';
                                    }
                                    ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Proyectos -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold">
                    Gestión de Proyectos
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 60px;">ID</th>
                                <th style="width: 100px;">Imagen</th>
                                <th>Título</th>
                                <th style="width: 150px;">Unidad</th>
                                <th style="width: 200px;">Tecnologías</th>
                                <th style="width: 120px;">Fecha</th>
                                <th style="width: 150px;" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($proyectos)): ?>
                            <?php foreach ($proyectos as $proyecto): ?>
                            <tr>
                                <td class="align-middle">
                                    <span class="badge bg-secondary">#<?php echo $proyecto['id']; ?></span>
                                </td>
                                <td class="align-middle">
                                    <?php if (!empty($proyecto['image_url'])): ?>
                                    <img src="../assets/uploads/<?php echo htmlspecialchars($proyecto['image_url']); ?>"
                                        class="img-thumbnail" alt="Preview"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                    <?php else: ?>
                                    <div class="bg-secondary d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px;">
                                        <i class="bi bi-image text-white"></i>
                                    </div>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle">
                                    <div class="fw-semibold"><?php echo htmlspecialchars($proyecto['title']); ?></div>
                                    <small class="text-muted">
                                        <?php 
                                                $desc = htmlspecialchars($proyecto['description']);
                                                echo strlen($desc) > 50 ? substr($desc, 0, 50) . '...' : $desc;
                                                ?>
                                    </small>
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-primary">
                                        <?php echo htmlspecialchars($proyecto['unit_name']); ?>
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <small>
                                        <?php 
                                                if (!empty($proyecto['technologies'])) {
                                                    echo generarBadgesTecnologias($proyecto['technologies']);
                                                } else {
                                                    echo '<span class="text-muted">N/A</span>';
                                                }
                                                ?>
                                    </small>
                                </td>
                                <td class="align-middle">
                                    <small class="text-muted">
                                        <?php echo date('d/m/Y', strtotime($proyecto['created_at'])); ?>
                                    </small>
                                </td>
                                <td class="align-middle text-center">
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo htmlspecialchars($proyecto['external_url']); ?>"
                                            class="btn btn-sm btn-outline-info" target="_blank" title="Ver proyecto">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="project-form.php?id=<?php echo $proyecto['id']; ?>"
                                            class="btn btn-sm btn-outline-primary" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="confirmarEliminacion(<?php echo $proyecto['id']; ?>, '<?php echo htmlspecialchars(addslashes($proyecto['title'])); ?>')"
                                            title="Eliminar">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-inbox display-4 text-muted d-block mb-3"></i>
                                    <p class="text-muted mb-3">No hay proyectos registrados</p>
                                    <a href="project-form.php" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Crear Primer Proyecto
                                    </a>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>

    </section>

    <!-- Modal de Confirmación de Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header border-0">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                        Confirmar Eliminación
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar el proyecto:</p>
                    <p class="fw-bold" id="projectTitle"></p>
                    <p class="text-danger small mb-0">
                        <i class="bi bi-info-circle me-1"></i>
                        Esta acción no se puede deshacer.
                    </p>
                </div>

                <!-- FORMULARIO SOLO PARA EL BOTÓN FINAL -->
                <form method="POST" action="actions.php">
                    <input type="hidden" name="action" value="delete-project">
                    <input type="hidden" name="project_id" id="deleteProjectId">

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </button>

                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash me-2"></i>
                            Eliminar Proyecto
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
    // Función para confirmar eliminación
    function confirmarEliminacion(id, titulo) {
        document.getElementById('projectTitle').textContent = titulo;
        document.getElementById('deleteProjectId').value = id;

        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }
    </script>

    <?php footer(); ?>
</body>

</html>
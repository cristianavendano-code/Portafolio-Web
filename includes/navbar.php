<?php
function navbar() {
?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow">
        <div class="container">
            <!-- Logo/Brand -->
            <a class="navbar-brand fw-bold" href="../index.php">
                <i class="bi bi-code-square me-2"></i>
                Portafolio Hub
            </a>
            
            <!-- Botón hamburguesa para móvil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Links de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">
                            <i class="bi bi-house-door me-1"></i>
                            Inicio
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../unidades.php">
                            <i class="bi bi-folder me-1"></i>
                            Proyectos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../nosotros.php">
                            <i class="bi bi-people me-1"></i>
                            Nosotros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../admin/login.php">
                            <i class="bi bi-shield-lock me-1"></i>
                            Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<?php
}
?>
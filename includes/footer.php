<?php
function footer() {
    ?>
<footer class="bg-dark text-white mt-5">
    <div class="container py-4">
        <div class="row">

            <!-- Columna 1: Información -->
            <div class="col-md-4 mb-3 mb-md-0">
                <h5 class="mb-3">
                    <i class="bi bi-code-square me-2"></i>
                    Portafolio Web
                </h5>
                <p class="text-white-50">
                    Plataforma de evidencias académicas para la materia
                    <strong>Desarrollo Web Orientado a Servicios</strong>.
                </p>
            </div>

            <!-- Columna 2: Enlaces rápidos -->
            <div class="col-md-4 mb-3 mb-md-0">
                <h5 class="mb-3">Enlaces Rápidos</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="<?php echo isset($root_path) ? $root_path : ''; ?>index.php"
                            class="text-white-50 text-decoration-none">
                            <i class="bi bi-chevron-right"></i> Inicio
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="<?php echo isset($root_path) ? $root_path : ''; ?>unidades.php"
                            class="text-white-50 text-decoration-none">
                            <i class="bi bi-chevron-right"></i> Proyectos
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="<?php echo isset($root_path) ? $root_path : ''; ?>nosotros.php"
                            class="text-white-50 text-decoration-none">
                            <i class="bi bi-chevron-right"></i> Nosotros
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Columna 3: Contacto/Info -->
            <div class="col-md-4">
                <h5 class="mb-3">Información</h5>
                <p class="text-white-50">
                    <i class="bi bi-calendar3 me-2"></i>
                    Enero 2026
                </p>
                <p class="text-white-50">
                    <i class="bi bi-mortarboard me-2"></i>
                    Universidad Tecnológica
                </p>
                <div class="mt-3">
                    <a href="#" class="text-white-50 me-3" title="GitHub">
                        <i class="bi bi-github fs-5"></i>
                    </a>
                    <a href="#" class="text-white-50 me-3" title="LinkedIn">
                        <i class="bi bi-linkedin fs-5"></i>
                    </a>
                    <a href="#" class="text-white-50" title="Email">
                        <i class="bi bi-envelope fs-5"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <hr class="border-secondary my-4">
        <div class="text-center text-white-50">
            <p class="mb-0">
                &copy; 2026 Portafolio Hub. Desarrollado con
                <i class="bi bi-heart-fill text-danger"></i>
                por Cristian Avendaño
            </p>
        </div>
    </div>
</footer>

<!-- Bootstrap Bundle JS (incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- JavaScript Personalizado -->
<script src="<?php echo isset($js_path) ? $js_path : 'assets/js/script.js'; ?>"></script>

<?php if (isset($extra_scripts)): ?>
<!-- Scripts adicionales de la página -->
<?php echo $extra_scripts; ?>
<?php endif; ?>
</body>

</html>
<?php
      }
?>
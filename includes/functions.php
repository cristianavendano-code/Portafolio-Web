<?php
function limpiarDato($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato, ENT_QUOTES, 'UTF-8');
    return $dato;
}

function obtenerNombreUnidad($pdo, $unit_id) {
    try {
        $stmt = $pdo->prepare("SELECT name FROM units WHERE id = ?");
        $stmt->execute([$unit_id]);
        $result = $stmt->fetch();
        return $result ? $result['name'] : 'Unidad Desconocida';
    } catch (PDOException $e) {
        return 'Error al obtener unidad';
    }
}

function obtenerDescripcionUnidad($pdo, $unit_id) {
    try {
        $stmt = $pdo->prepare("SELECT description FROM units WHERE id = ?");
        $stmt->execute([$unit_id]);
        $result = $stmt->fetch();
        return $result ? $result['description'] : '';
    } catch (PDOException $e) {
        return '';
    }
}

function obtenerUnidades($pdo) {
    try {
        $stmt = $pdo->query("SELECT * FROM units ORDER BY id ASC");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

function obtenerProyectosPorUnidad($pdo, $unit_id) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM projects WHERE unit_id = ? ORDER BY created_at DESC");
        $stmt->execute([$unit_id]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

// Obtiene todos los proyectos
function obtenerTodosProyectos($pdo) {
    try {
        $stmt = $pdo->query("SELECT p.*, u.name as unit_name FROM projects p 
                             LEFT JOIN units u ON p.unit_id = u.id 
                             ORDER BY p.created_at DESC");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        return [];
    }
}

function formatearFecha($fecha) {
    $timestamp = strtotime($fecha);
    $meses = [
        1 => 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];
    
    $dia = date('d', $timestamp);
    $mes = $meses[(int)date('m', $timestamp)];
    $anio = date('Y', $timestamp);
    
    return "$dia de $mes, $anio";
}

function validarURL($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

function generarBadgesTecnologias($technologies) {
    if (empty($technologies)) {
        return '';
    }
    
    $techs = explode(',', $technologies);
    $html = '';
    
    $colores = [
        'html' => 'danger',
        'css' => 'primary',
        'javascript' => 'warning',
        'js' => 'warning',
        'php' => 'secondary',
        'mysql' => 'info',
        'bootstrap' => 'purple',
        'api' => 'success'
    ];
    
    foreach ($techs as $tech) {
        $tech = trim($tech);
        $tech_lower = strtolower($tech);
        $color = $colores[$tech_lower] ?? 'dark';
        $html .= '<span class="badge bg-' . $color . ' me-1">' . htmlspecialchars($tech) . '</span>';
    }
    
    return $html;
}
?>
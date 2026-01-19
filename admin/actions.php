<?php
session_start();
require_once "../config/conection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // Iniciar Sesion Admin
    if ($action === 'login-admin') {
        $user = trim($_POST['user'] ?? '');
        $password  = trim($_POST['password'] ?? '');

        if (!empty($user) && !empty($password)) {
            try {
                
                $query = "SELECT * FROM admins WHERE username = :user LIMIT 1";

                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':user', $user, PDO::PARAM_STR);
                $stmt->execute();

                $admin = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($admin && $password === $admin['password']) {

                    $_SESSION['admin_logged'] = true;
                    $_SESSION['admin_id'] = $admin['id'];
                    $_SESSION['admin_user'] = $admin['username'];

                    header('Location: ../admin/dashboard.php');
                    exit;
                } else {
                    $_SESSION['alert'] = ['type' => 'error', 'msg' => 'Usuario o contraseña incorrectos.'];
                    header("Location: ../admin/login.php");
                    exit;
                }

            } catch (PDOException $e) {
                echo 'Error en la conexión: ' . $e->getMessage();

            }
        }
    } 

    // Logout Admin
    if ($action === 'logout-admin') {
        session_destroy();
        header("Location: ../index.php");
        exit;
    }

    // Eliminar proyecto
    if ($action === 'delete-project') {
        $project_id = intval($_POST['project_id'] ?? 0);

        if ($project_id > 0) {
            try {
                $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");
                $stmt->execute([$project_id]);

                $_SESSION['alert'] = ['type' => 'success', 'msg' => 'Proyecto eliminado correctamente.'];
                header("Location: ../admin/dashboard.php");
                exit;

            } catch (PDOException $e) {
                $_SESSION['alert'] = ['type' => 'error', 'msg' => 'Error al eliminar el proyecto.'];
                header("Location: ../admin/dashboard.php");
                exit;
            }
        }
    }
}
?>
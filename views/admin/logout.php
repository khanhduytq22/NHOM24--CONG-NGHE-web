<?php
    require_once(__DIR__ . '/../../controllers/AdminController.php');
    $adminController = new AdminController();
    $adminController->logout();
?>
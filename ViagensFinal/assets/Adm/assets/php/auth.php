<?php
session_start();

if (($_SESSION['NAME'] ?? '') !== 'Administrador') {
    $destino = $loginUrl ?? '../../../pages/login.html';
    header("Location: " . $destino);
    exit;
}
?>

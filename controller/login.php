<?php
session_start();

require '../models/Empresa.php';

$c_empresa = new Empresa();

$ruc = filter_input(INPUT_POST, 'ruc_empresa');
$password = filter_input(INPUT_POST, 'password');

$c_empresa->setRuc($ruc);
$c_empresa->setPassword($password);

if ($c_empresa->validarLogin()) {
    $c_empresa->obtenerDatos();
    if ($c_empresa->getPassword() == $password) {
        $_SESSION['id_empresa'] = $c_empresa->getIdEmpresa();
        $_SESSION['nombre_empresa'] = $c_empresa->getRazonSocial();
        $_SESSION['logo_empresa'] = $c_empresa->getLogo();
        header("Location: ../index.php");
    } else {
        header("Location: ../login.php?error=CONTRASEÑA INCORRECTA");
    }
} else {
    header("Location: ../login.php?error=EMPRESA NO EXISTE - CONTRASEÑA INCORRECTA");
}


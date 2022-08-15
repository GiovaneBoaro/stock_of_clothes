<?php

namespace APP\Controller;

require_once '../../vendor/autoload.php';

use APP\Model\DAO\UserDAO;
use APP\Utils\Redirect;

if (empty($_POST)) {
    Redirect::redirect('Requisição inválida!!!', type: 'error');
}

$login = $_POST['login'];
$password = $_POST['pass'];

$dao = new UserDAO();
$result = $dao->findUser($login);

if (password_verify($password, $result['pass'])) {
    session_start();
    $_SESSION['login'] = $login;
    header("location:../View/list_of_products.php");
} else {
    Redirect::redirect(message: ['Usuário ou senha inválidos!!!']);
}
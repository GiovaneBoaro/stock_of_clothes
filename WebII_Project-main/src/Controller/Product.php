<?php

namespace APP\Controller;

require_once '../../vendor/autoload.php';

use APP\Model\DAO\ProductDAO;
use APP\Utils\Redirect;
use APP\Model\Validation;
use APP\Model\Product;
use PDOException;

if (empty($_GET['operation'])) {
    Redirect::redirect(message: 'Nenhuma operação foi informada!!!', type: 'error');
}

switch ($_GET['operation']) {
    case 'insert':
        insertProduct();
        break;
    case 'list':
        listProducts();
        break;
    case 'delete':
        deleteProduct();
        break;
    case 'find':
        findProduct();
        break;
    case 'edit':
        editProduct();
        break;
    default:
        Redirect::redirect(message: 'Operação informada é inválida!!!', type: 'error');
}

function insertProduct()
{
    if (empty($_POST)) {
        Redirect::redirect(
            type: 'error',
            message: 'Requisição inválida!!!'
        );
    }

    $productTipo = $_POST["tipo"];
    $productQuantity = $_POST["quantity"];
    $productPrice = $_POST["price"];
    $productSize = $_POST["size"];
    $productColor = $_POST["color"];
    $barCode = $_POST["barCode"];

    $error = array();

    if (!Validation::validateTipo($productTipo)) {
        array_push($error, 'O tipo do produto deve conter ao menos 5 caracteres entre letras e números!!!');
    }

    if (!Validation::validateQuantity($productQuantity)) {
        array_push($error, 'A quantidade em estoque deve ser superior ou igual à 1 unidade!!!');
    }

    if (!Validation::validatePrice($productPrice)) {
        array_push($error, 'O custo de aquisição deve ser superior ou igual à R$ 0.00');
    }

    if (!Validation::validateSize($productSize)) {
        array_push($error, 'O tamanho do produto deve conter no minimo 1 caractere!!');
    }
    if (!Validation::validateColor($productColor)) {
        array_push($error, 'A cor do produto deve conter no minimo 4 caracteres');
    }
    if (!Validation::validateBarCode($barCode)) {
        array_push($error, 'O código de barra não é válido segundo nossos parâmetros!!!');
    }

    if ($error) { // Se o array NÃO estiver vazio
        Redirect::redirect(
            message: $error,
            type: 'warning'
        );
    } else {
        $product = new Product(
            tipo: $productTipo,
            barCode: $barCode,
            price: $productPrice,
            quantity: $productQuantity,
            size:$productSize,
            color:$productColor
        );
        $dao = new ProductDAO();
        try {
            $result = $dao->insert($product);
        } catch (PDOException $e) {
            // Redirect::redirect(message: 'Lamento, houve um erro inesperado na execução do sistema!!!', type: 'error');
            // Tratar de notificar a equipe
            $e->getMessage();
        }
        if ($result)
            Redirect::redirect(
                message: 'Roupa cadastrada com sucesso!!!'
            );
        else
            Redirect::redirect(
                message: 'Não foi possível cadastrar sua roupa!!!',
                type: 'error'
            );
    }
}
function listProducts()
{
    $dao = new ProductDAO();
    try {
        $products = $dao->findAll();
    } catch (PDOException $e) {
        Redirect::redirect(message: 'Lamento, houve um erro inesperado na execução do sistema!!!', type: 'error');
    }
    session_start();
    if ($products) {
        $_SESSION['list_of_products'] = $products;
        header("location:../View/list_of_products.php");
    } else {
        Redirect::redirect(message: ['Não existem produtos cadastrados no sistema!!!'], type: 'warning');
    }
}

function deleteProduct()
{
    $barCode = $_GET['code'];
    $dao = new ProductDAO();
    try {
        $result = $dao->delete($barCode);
        if ($result) {
            Redirect::redirect(message: 'Produto removido com sucesso!!!');
        } else {
            Redirect::redirect(message: ['Não foi possível remover a roupa!!!'], type: 'warning');
        }
    } catch (PDOException $e) {
        Redirect::redirect(message: 'Lamento, houve um erro inesperado na execução do sistema!!!', type: 'error');
    }
}

function findProduct()
{
    //Problema na linha 146. Não está identificando o GET_ 'barCode'.
    $barCode = $_GET['code'];
    $dao = new ProductDAO();
    $data = $dao->findOne($barCode);
    if ($data) {
        session_start();
        $_SESSION['product_data'] = $data;
        header('location:../View/form_edit_product.php');
    } else {
        Redirect::redirect(message: 'Roupa não localizada em nossa base de dados!!!');
    }
}

function editProduct()
{
    if (empty($_POST)) {
        Redirect::redirect(
            type: 'error',
            message: 'Requisição inválida!!!'
        );
    }

    $barCode = $_POST['barCode'];
    $productTipo = $_POST['tipo'];
    $productQuantity = $_POST['quantity'];
    $productSize = $_POST['size'];
    $productColor = $_POST['color'];
    $productPrice = $_POST['price'];


    $error = array();

    if (!Validation::validateTipo($productTipo)) {
        array_push($error, 'O tipo do produto deve conter ao menos 5 caracteres entre letras e números!!!');
    }

    if (!Validation::validateQuantity($productQuantity)) {
        array_push($error, 'A quantidade em estoque deve ser superior ou igual à 1 unidade!!!');
    }

    if (!Validation::validatePrice($productPrice)) {
        array_push($error, 'O custo de aquisição deve ser superior ou igual à R$ 0.00');
    }

    if (!Validation::validateSize($productSize)) {
        array_push($error, 'O tamanho do produto deve conter no minimo 1 caractere!!');
    }
    if (!Validation::validateColor($productColor)) {
        array_push($error, 'A cor do produto deve conter no minimo 4 caracteres');
    }
    if (!Validation::validateBarCode($barCode)) {
        array_push($error, 'O código de barra não é válido segundo nossos parâmetros!!!');
    }

    if ($error) {
        Redirect::redirect(message: $error, type: 'warning');
    } else {
        $product = new Product(
            barCode: $barCode,
            tipo: $productTipo,
            quantity: $productQuantity,
            size:$productSize,
            color:$productColor,
            price:$productPrice
        );
        $dao = new ProductDAO();
        $result = $dao->update($product);
        if ($result) {
            Redirect::redirect(message: 'Roupa atualizada com sucesso!!!');
        } else {
            Redirect::redirect(message: ['Não foi possível atualizar os dados da roupa!!!'], type: 'warning');
        }
    }
}

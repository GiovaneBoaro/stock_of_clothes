<?php
session_start();
if(empty($_SESSION['login'])) {
    header("location../../index.html");  
  }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Roupas - Adicionar Roupa</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header id="cabecalho-index">
        <nav>
        <ul id="navegacao-index">
            <li>
            <a href="./dashboard.php">Home</a>
            </li>
            <li>
            <a href="./form_add_product.php">Adicionar Roupa</a>
            </li>
            <li>
            <a href="../Controller/Product.php?operation=list">Listar Roupas</a>
            </li>
        </ul>
        </nav>
    </header>
    <h2>Adicionar Roupa no estoque</h2>
    <form action="../controller/Product.php?operation=insert" method="POST">
        <section id="informacao-roupa">
            <article>
                <label for="barCode" class="cursor-pointer">Código de barra: </label>
                <input type="number" name="barCode" id="barCode" class="border border-blue-400" required>
            </article>
            <article>
                <label for="tipo" class="cursor-pointer">Roupa: </label>
                <select name="tipo" id="tipo">
                    <option value=1>Calça</option>
                    <option value=2>Camiseta</option>
                    <option value=3>Moletom</option>
                    <option value=4>Saia</option>
                    <option value=5>Regata</option>
                    <option value=6>Bermuda</option>
                </select>
            </article>
            <article>
                <label for="size" class="cursor-pointer">Tamanho: </label>
                <select name="size" id="size">
                    <option value=1>PP</option>
                    <option value=2>P</option>
                    <option value=3>M</option>
                    <option value=4>G</option>
                    <option value=5>GG</option>
                </select>
            </article>
            <article>
                <label for="color" class="cursor-pointer">Cor: </label>
                <input type="text" name="color" id="color" class="border border-blue-400" required>
            </article>
        </section>
        <section id="informacao-quantidade-preco">
            <article>
                <label for="quantity" class="cursor-pointer">Quantidade em estoque: </label>
                <input type="number" name="quantity" id="quantity" class="border border-blue-400" required min=1 max=1000>
            </article>
            <article>
                <label for="price" class="cursor-pointer">Preço: </label>
                <input type="number" name="price" id="price" class="border border-blue-400" required min=1 max=10000>
            </article>
        </section>
        <article class="flex justify-center mt-3" id="div-btn">
            <button type="submit" class="p-3 text-white bg-blue-700 rounded">Cadastrar</button>
        </article>
    </form>
</body>

</html>
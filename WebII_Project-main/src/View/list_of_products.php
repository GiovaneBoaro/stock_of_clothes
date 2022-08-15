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
    <title>Lista de produtos</title>
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
    <main id="lista-corpo">
        <table id="tabela-lista">
            <thead class="text-white bg-blue-600" id="tabela-cabecalho">
                <th class="titulos">Código de barra</th>
                <th class="titulos">Tipo</th>
                <th class="titulos">Tamanho</th>
                <th class="titulos">Cor</th>
                <th class="titulos">Preço</th>
                <th class="titulos">Quantidade em estoque</th>
                <th class="titulos">Ações</th>
            </thead>
            <tbody id="tabela-corpo">
                <?php
                foreach ($_SESSION['list_of_products'] as $product) :
                ?>
                    <tr id="tabela-dados">
                        <td class="dados">
                            <?= $product['barCode'] ?>
                        </td>
                        <td class="dados">
                            <?= $product['tipo'] ?>
                        </td>
                        <td class="dados">
                            <?= $product['size'] ?>
                        </td>
                        <td class="dados">
                            <?= $product['color'] ?>
                        </td>
                        <td class="dados">
                            R$ <?= str_replace(".", ",", $product['price']) ?>
                        </td>
                        <td class="dados">
                            <?= $product['quantity'] ?>
                        </td>
                        <td class="dados">
                            <a href="../Controller/Product.php?operation=find&code=<?= $product["barCode"] ?>" id="btn-editar">Editar</a>
                            <a href="../Controller/Product.php?operation=delete&code=<?= $product["barCode"] ?>" id="btn-deletar">Deletar</a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </main>
</body>

</html>
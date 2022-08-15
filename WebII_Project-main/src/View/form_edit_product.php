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
    <title>Loja de varejo - Novo produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<header id="cabecalho-index">
        <nav>
        <ul id="navegacao-index">
            <li>
            <a href="../../index.html">Home</a>
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
    <form action="../controller/Product.php?operation=edit" method="POST" id="">
        <?php
        $product = $_SESSION['product_data'];
        ?>
        <input type="hidden" name="barCode" value=<?= $product['barCode'] ?>>
        <section class="mx-4 mt-4 columns-2">
            <article>
                <label for="price" class="cursor-pointer">Preço: </label>
                <input type="number" name="price" id="price" class="border border-blue-400" required value="<?= $product['price'] ?>">
            </article>
            <article>
                 <label for="size" class="cursor-pointer">Tamanho: </label>
                <select name="size" id="size" required value=<?= $product['size'] ?>>
                    <option value=1>PP</option>
                    <option value=2>P</option>
                    <option value=3>M</option>
                    <option value=4>G</option>
                    <option value=5>GG</option>
                </select>
            </article>
            <article>
                <label for="quantity" class="cursor-pointer">Quantidade em estoque: </label>
                <input type="number" name="quantity" id="quantity" class="border border-blue-400" required value="<?= $product['quantity'] ?>">
            </article>
            <article>
                 <label for="tipo" class="cursor-pointer">Roupa: </label>
                <select name="tipo" id="tipo" required value=<?= $product['tipo'] ?>>
                    <option value=1>Calça</option>
                    <option value=2>Camiseta</option>
                    <option value=3>Moletom</option>
                    <option value=4>Saia</option>
                    <option value=5>Regata</option>
                    <option value=6>Bermuda</option>
                </select>
            </article>
            <article>
                <label for="color" class="cursor-pointer">Cor: </label>
                <input type="text" name="color" id="color" class="border border-blue-400" required value="<?= $product['color'] ?>">
            </article>
            
            
        </section>
        <article class="flex justify-center mt-3">
            <button type="submit" class="p-3 text-white bg-blue-700 rounded">Salvar</button>
        </article>
    </form>
</body>

</html>
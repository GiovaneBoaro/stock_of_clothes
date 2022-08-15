<?php
  session_start();
  if(empty($_SESSION['login'])) {
    header("location../../index.html");  
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Loja de Roupas - Dashboard</title>
  <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
  <header id="cabecalho-index">
    <nav>
      <ul id="navegacao-index">
        <li>
          <a href="./index.html">Home</a>
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
</body>

</html>
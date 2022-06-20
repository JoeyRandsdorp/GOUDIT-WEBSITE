<?php
require_once 'connect.php';
/** @var array $db */
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Adminpage</title>
    <link rel="stylesheet" href="Adminpagina.css"/>
</head>
<body>
    <section>    
        <div class="TableOverview">
            <a href= "AccountTable.php">Accounts overzicht</a>
            <a href= "CustomerTable.php">Klantgegevens</a>
            <a href= "OrderTable.php">Bestellijst</a>
            <a href= "ProductTable.php">Productenlijst</a>
        </div>
    </section>
</body>
</html>
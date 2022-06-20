<?php
/*LIST OF ABBREVIATIONS:
PT = Product Table */

/** @var mysqli $db */                                      //definieer variable in comment zodat dat geen error geeft

session_start();

if (!isset($_SESSION['loggedInUser'])) {            //bescherming tegen deeplinken
    header('Location: Loginpagina.php');
    exit;
}

$loggedInUser = $_SESSION['loggedInUser'];

if(!isset($_GET['id'])){                            //zorg dat als er geen id meekrijgt je terug naar de tabel gestuurd wordt
    header('Location: ProductTable.php');
    exit;
}

require_once 'connect.php';                 //connectie naar bestand met de link naar de database

$productId = $_GET['id'];               //zet de meegegeven id om naar een variable waar mee je kunt werken

$query = "SELECT * FROM product WHERE id = ". mysqli_escape_string($db, $productId);
                        //selecteer de gegevens die gelinkt zijn aan het meegegeven id +beveiliging

$result = mysqli_query($db, $query)
 or die ('Error: ' . $query );

if(mysqli_num_rows($result) == 1)           //controleer of er maar 1 id meegegeven is door de rijen te tellen
{
    $product = mysqli_fetch_assoc($result);
}
else {
    header('Location: ProductTable.php');       //als het niet goed gaat stuur de gebruiker terug naar de tabel
    exit;
}
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang = "english">
    <head>
        <title>Product informatie</title>
        <link rel="stylesheet"  href="TableMakeUp.css"/>
        <meta charset="utf-8"/>
    </head>
    <body>
        <h1><?= $product['productName'] ?></h1>
        <a class="TableReturn" href="ProductTable.php">Terug naar de productenlijst</a>
        <section>
            <ul>Product_Type: <?= $product['productType'] ?> </ul>                     //toon de gegevens
            <ul>Quantiteit: <?= $product['quantity'] ?> </ul>
            <ul>Prijs: €<?= $product['price'] ?> </ul>
            <ul class= "descriptionBox">Omschrijving <?= $product['productDescription'] ?></ul>
        </section>
    </body>
</html>

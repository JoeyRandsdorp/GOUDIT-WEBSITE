<?php
/*LIST OF ABBREVIATIONS:
PT = Product Table */

session_start();

if (!isset($_SESSION['loggedInUser'])) {            //bescherming tegen deeplinken
    header('Location: Loginpagina.php');
    exit;
}

$loggedInUser = $_SESSION['loggedInUser'];

require_once 'connect.php';                     //connectie met bestand dat linkt naar database
/** @var mysqli $db */

    $query = "SELECT * FROM product";              //selecteer de tabel die gebruikt moet gaan worden in de database
    $result = mysqli_query($db, $query)
    or die('Error: ' . $query);                    //+ een error als dat niet lukt

$PT = [];                                       //maak een array variable
while($row = mysqli_fetch_assoc($result)){      //maak een loop zodat de tabel zich toont
    $PT[] = $row;
}

    mysqli_close($db);                              //sluit de "sessie" zodat de server veel gebruikers aan kan
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Productenlijst</title>
        <link rel="stylesheet"  href="TableMakeUp.css"/>
    </head>
    <body>
        <h1>Productenlijst</h1>
        <table>
            <thead>
            <div class="AdminReturn">
                <a href="CreateProduct.php">Voeg nieuw product toe</a>
                <a href="Adminpagina.php" >Terug naar Adminpagina</a>
            </div>
            <tr>
                <th>#</th>
                <th>Product_ID</th>
                <th>Product_Name</th>
                <th>Quantiteit</th>
                <th>Product_Type</th>
                <th>Price</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tfoot>
            </tfoot>
            <tbody>
                    <?php foreach($PT as $PT) { ?>                         //maak een loop zodat elke kolom zich toont
                    <tr>    
                        <td><?= $PT['id'] ?></td>                          //maak de kolommen die getoont moeten worden
                        <td><?= $PT['productId'] ?></td>
                        <td><?= $PT['productName'] ?></td>
                        <td><?= $PT['quantity'] ?></td>
                        <td><?= $PT['productType'] ?></td>
                        <td>€<?= $PT['price'] ?></td>
                        <td><a class = "Info" href="ProductDetails.php?id=<?= $PT['id']; ?>">Details</a></td>
                        <td><a class = "Info" href="EditProduct.php?id=<?= $PT['id']; ?>">Edit</a></td>
                        <td><a class = "Info" href="DeleteProduct.php?id=<?= $PT['id']; ?>">Delete</a></td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>
      
    </body>
</html>
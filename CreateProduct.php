<?php
/*LIST OF ABBREVIATIONS:
PT = Product Table \
CF = CreateForm
CB = CReateButton*/
/** @var mysqli $db */

session_start();

if (!isset($_SESSION['loggedInUser'])) {            //bescherming tegen deeplinken
    header('Location: Loginpagina.php');
    exit;
}

$loggedInUser = $_SESSION['loggedInUser'];

require_once "connect.php";

if(isset($_POST['submit'])){
    //controle of er gegevens ingevuld zijn
    $productId = mysqli_escape_string($db, $_POST['IdCreate']);
    $productName = mysqli_escape_string($db, $_POST['nameCreate']);
    $quantity  = mysqli_escape_string($db, $_POST['quantityCreate']);
    $productType   = mysqli_escape_string($db, $_POST['typeCreate']);
    $price = mysqli_escape_string($db, $_POST['priceCreate']);
        //ingevulde gegevens naar variablen+beveiliging van het invoerveld tegen bijv javascript en queries

    require_once "FormValidation.php";          //link naar bestand met hoe error berichtjes gehandeld worden
}

if (empty($errors)) {
    $query = "INSERT INTO product (IdCreate, nameCreate, quantityCreate, typeCreate, priceCreate)    
                  VALUES ('$productId', '$productName', $quantity , '$productType',  $price)";
    $result = mysqli_query($db, $query) or die('Error: ' . $query);
                                                 //als er geen errors zijn, voer de ingevulde gegevens in de database

    if ($result) {                                //na de toevoeging wordt je of teruggestuurd naar de tabel of er wordt een error aangegeven
        header('Location: ProductTable.php');
        exit;
    } else {
        $errors['db'] = 'Er is iets fout gegaan in de database:' . mysqli_error($db);
    }

    mysqli_close($db);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Pagina</title>
    <link rel="stylesheet" href="TableMakeUp.css"/>
</head>
<body>
    <section>
            <h1>Voeg een nieuw product toe</h1>

            <form action="" method="post">
                    <div class="CF">
                        <label for="productId">Product_ID:</label>
                        <input  type="text" name="IdCreate" value="<?= isset($productId) ? htmlentities($productId) : '' ?>" />     //invoerveld beveiligen
                    <?= isset($errors['IdCreate']) ? $errors['IdCreate'] : '' ?>
                                                                         //dit zorgt ervoor dat de error message achter het invoerveld komt te staan
                    </div>
                    <div class="CF">
                        <label for="productName">Product_Name:</label>
                        <input  name="nameCreate" type="text" value="<?= isset($productName) ? htmlentities($productName) : '' ?>" />
                        <?= isset($errors['nameCreate']) ? $errors['nameCreate'] : '' ?>
                    </div>
                    <div class="CF">
                        <label for="quantity">Quantiteit:</label>
                        <input  name="quantityCreate" type="number" value="<?= isset($quantityCreate) ? htmlentities($quantityCreate) : '' ?>" />
                        <?= isset($errors['quantityCreate']) ? $errors['quantityCreate'] : '' ?>
                    </div>
                    <div class="CF">
                        <label for="productType">Product_Type:</label>
                        <input name="typeCreate" type="text" value="<?= isset($typeCreate) ? htmlentities($typeCreate) : '' ?>" />
                        <?= isset($errors['typeCreate']) ? $errors['typeCreate'] : '' ?>
                    </div>
                    <div class="CF">
                        <label for="price">Prijs:</label>
                        <input  name="priceCreate" type="text" value="<?= isset($priceCreate) ? htmlentities($priceCreate) : '' ?>" />
                        <?= isset($errors['priceCreate']) ? $errors['priceCreate'] : '' ?>
                    </div>
                    <div class="CB">
                        <input type="submit" value="Save" name="submit" />
                    </div>
            </form>

     </section>
        <div>
            <a href="ProductTable.php">Terug naar de productenlijst</a>
        </div>
</body>
</html>

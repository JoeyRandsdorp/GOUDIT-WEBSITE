<?php

/*LIST OF ABBREVIATIONS:
PT = Product Table \
EF = EditForm
EB = EditButton*/

/** @var mysqli $db */
require_once "connect.php";

session_start();

if (!isset($_SESSION['loggedInUser'])) {            //bescherming tegen deeplinken
    header('Location: Loginpagina.php');
    exit;
}

$loggedInUser = $_SESSION['loggedInUser'];

if (isset($_POST['submit'])) {

    $productId = mysqli_escape_string($db, $_POST['IdCreate']);         //beveilig invoervelden en zet de ingevoegde
    $productName = mysqli_escape_string($db, $_POST['nameCreate']);     //gegevens om in variablen
    $quantity  = mysqli_escape_string($db, $_POST['quantityCreate']);
    $productType   = mysqli_escape_string($db, $_POST['typeCreate']);
    $price = mysqli_escape_string($db, $_POST['priceCreate']);

    require_once "FormValidation.php";

    $product = [                                //defineer array $product
        'IdCreate' => $productId,
        'nameCreate' => $productName,
        'quantityCreate' => $quantity,
        'typeCreate' => $productType,
        'priceCreate' => $price,
    ];

    if (empty($errors)) {                           //voer verandering uit als er geen fouten zijn

        $query = "UPDATE product SET                                  
                   IdCreate = '$productId',
                   nameCreate = '$productName',
                   quantityCreate = '$quantity',
                   typeCreate = '$productType',
                   priceCreate = '$price'
                  WHERE id = '$productId'";
        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: ProductTable.php');       //als er niks fout gaat stuur terug naar tabel
            exit;
        } else {
            $errors[] = 'Er is iets fout gegaan in de database:' . mysqli_error($db);       //error message
        }
    }
} else if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $query = "SELECT * FROM product WHERE id = " . mysqli_escape_string($db, $productId);
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $product = mysqli_fetch_assoc($result);
    } else {
        header('Location: ProductTable.php');
        exit;
    }
} else {
    header('Location: ProductTable.php');
    exit;
}
mysqli_close($db);
?>

<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="TableMakeUp.css"/>
</head>
<body>

<h1>Edit"<?= htmlentities($product['productName']) ?>" </h1>

    <form action="" method="post" >
        <div class="EF">
            <label for="productId">Product_ID</label>
            <input  type="text" name="IdCreate" value="<?= isset($IdCreate) ? htmlentities($IdCreate) : '' ?>" />       //beveiligd invoerveld
            <?= isset($errors['IdCreate']) ? $errors['IdCreate'] : '' ?>                    //voert error message uit
        </div>
        <div class="EF">
            <label for="productName">Product_Name:</label>
            <input  name="nameCreate" type="text" value="<?= isset($productName) ? htmlentities($productName) : '' ?>" />
            <?= isset($errors['nameCreate']) ? $errors['nameCreate'] : '' ?>
        </div>
        <div class="EF">
            <label for="quantity">Quantiteit:</label>
            <input  name="quantityCreate" type="number" value="<?= isset($quantityCreate) ? htmlentities($quantityCreate) : '' ?>" />
            <?= isset($errors['quantityCreate']) ? $errors['quantityCreate'] : '' ?>
        </div>
        <div class="EF">
            <label for="productType">Product_Type:</label>
            <input name="typeCreate" type="text" value="<?= isset($typeCreate) ? htmlentities($typeCreate) : '' ?>" />
            <?= isset($errors['typeCreate']) ? $errors['typeCreate'] : '' ?>
        </div>
        <div class="EF">
            <label for="price">Prijs:</label>
            <input  name="priceCreate" type="text" value="<?= isset($priceCreate) ? htmlentities($priceCreate) : '' ?>" />
            <?= isset($errors['priceCreate']) ? $errors['priceCreate'] : '' ?>
        </div>
        <div class="EB">
            <input type="hidden" name="id" value="<?= $productId ?>"/>          //je werkt hier met POST niet GET,
    </form>                                             // dus moet je hier de id meegeven zodat de website heet om welk product het gaat
<input type="submit" value="Edit" name="submit" />
<div>
    <a href="ProductTable.php">Terug naar de productenlijst</a>
</div>
</body>
</html>
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
session_start();

if (!isset($_SESSION['loggedInUser'])) {            //bescherming tegen deeplinken
    header('Location: Loginpagina.php');
    exit;
}
$loggedInUser = $_SESSION['loggedInUser'];


if (isset($_POST['submit'])) {

    $query = "DELETE FROM product WHERE id = " . mysqli_escape_string($db, $_POST['id']);   //query om item te deleten op basis van id
    mysqli_query($db, $query) or die ('Error: ' . mysqli_error($db));

    mysqli_close($db);

    header("Location: ProductTable.php");
    exit;

} else if (isset($_GET['id'])) {                            //zorgt dat het item herkent kan worden voordat je op de knop met submit hebt gedrukt
    $productId = $_GET['id'];

    $query = "SELECT * FROM product WHERE id = " . mysqli_escape_string($db, $productId);
    $result = mysqli_query($db, $query) or die ('Error: ' . $query);

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
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete pagina</title>
</head>
<body>
<h2>Delete - <?= $product['productName'] ?></h2>
<form action="" method="post">
    <p>
        Weet u zeker dat u het album "<?= $product['productName'] ?>" wilt verwijderen?
    </p>
    <input type="hidden" name="id" value="<?= $product['id'] ?>"/>
    <input type="submit" value="Delete" name="submit" />

    <div>
        <a href="ProductTable.php">Terug naar de productenlijst</a>
    </div>
</form>
</body>
</html>
<?php
$errors = [];
if($productId == '') {
    $errors[] = 'Het veldnaam met Product_ID mag niet leeg zijn.';
}
if($productName == '') {
    $errors[] = 'Het veldnaam met Product_Name mag niet leeg zijn.';
}
if(!is_numeric($quantity)) {
    $errors[] = 'Het veldnaam met Quantiteit moet een cijfer zijn.';
}
if($quantity == "") {
    $errors[] = 'Het veldnaam met Quantiteit mag niet leeg zijn.';
}
if($productType == '') {
    $errors[] = 'Het veldnaam met Product_Type mag niet leeg zijn.';
}
if(!is_numeric($price)) {
    $errors[] = 'Het veldnaam met Quantiteit moet een cijfer zijn.';
}
if($price == '') {
    $errors[] = 'Het veldnaam met de prijs mag niet leeg zijn.';
}
if(empty($errors)) {

}
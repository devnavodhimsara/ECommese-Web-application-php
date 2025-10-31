<?php
$order_id = uniqid();
$merchant_id = "1227714";
$name = isset($_POST["name"]) ? $_POST["name"] : '';
$price = isset($_POST["price"]) ? $_POST["price"] : 0.0;
$currency = "LKR";
$merchant_secret = "MzI3OTU4MDE2ODI5NzM5Nzg4MDQ3MjYxMjU4NjQxOTE0MDQ2NjA4";

if (empty($name) || empty($price)) {
    $response = array(
        "success" => false,
        "message" => "Name or price is missing"
    );
    echo json_encode($response);
    exit();
}

$hash = strtoupper(
    md5(
        $merchant_id .
        $order_id .
        number_format($price, 2, '.', '') .
        $currency .
        strtoupper(md5($merchant_secret))
    )
);

$response = array(
    "success" => true,
    "order_id" => $order_id,
    "merchant_id" => $merchant_id,
    "name" => $name,
    "price" => $price,
    "currency" => $currency,
    "hash" => $hash
);

echo json_encode($response);
?>

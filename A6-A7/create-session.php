<?php
session_start();
include 'funcions.php';
require 'stripe/init.php';
$preutotal = $_SESSION['preciototal'];







\Stripe\Stripe::setApiKey('sk_test_51HotcSHjhQPwWzaA8RxL2VjZrIws9ueUGAhiuHtscE4WlWiMXGTNMgQVaXHmN9eDeQQhNWSyCOANUk3H6CQ0h4TC00TK8kygHZ');
header('Content-Type: application/json');
$_SESSION["id_comanda"]=generate_string(20);
$YOUR_DOMAIN = 'http://dawjavi.insjoaquimmir.cat';
$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'unit_amount' => $preutotal*100,
      'product_data' => [
        'name' =>   $_SESSION["login"],
        'images' => ["https://i.imgur.com/EHyR2nP.png"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/acustodio/m07/UF1/A6-A7/ok.php?id_commanda='.$_SESSION["id_comanda"],
  'cancel_url' => $YOUR_DOMAIN . '/acustodio/m07/UF1/A6-A8/ko.php',
]);
echo json_encode(['id' => $checkout_session->id]);
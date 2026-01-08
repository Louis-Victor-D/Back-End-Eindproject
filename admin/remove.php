<?php
include_once(__DIR__ . '/admin_only.php');
include_once(__DIR__ . '/../classes/item.php');

$product = new Product($connect);
$product->delete($_GET['id']);

header("Location: overview.php");
exit;   
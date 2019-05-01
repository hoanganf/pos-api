<?php
include_once 'config.php';

include_once constant("MODEL_DIR").'dao/OrderDAO.php';
include_once constant("MODEL_DIR").'dao/NumberDAO.php';
include_once constant("MODEL_DIR").'dao/ProductDAO.php';
include_once constant("MODEL_DIR").'OrderResponseBuilder.php';

$responseGetter=new LocalApiResponseGetter();
echo $responseGetter->get('order');
?>

<?php
include_once 'config.php';
include_once constant("MODEL_DIR").'dao/TableDAO.php';
include_once constant("MODEL_DIR").'TableResponseBuilder.php';
$responseGetter=new ApiResponseGetter();
echo $responseGetter->get('table');
?>

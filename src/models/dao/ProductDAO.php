<?php
class ProductDAO extends BaseDAO{
  function __construct(){
     parent::__construct("product");
  }
  function getProductsByCategoryId($cateId){
    return $this->getAllWhere('category_id='.$cateId);
  }
  function getProduct($productId){
    return $this->getOnceWhere('id='.$productId);
  }
}
?>

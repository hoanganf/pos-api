<?php
class CommentDAO extends BaseDAO{
  function __construct(){
     parent::__construct("comment");
  }
  function getAllByProductId($productId){
    return $this->getAllWhere('product_id='.$productId);
  }
  function getComment($commentId){
    return $this->getOnceWhere('id='.$commentId);
  }
}
?>

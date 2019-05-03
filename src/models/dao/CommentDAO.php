<?php
class CommentDAO extends BaseDAO{
  function __construct(){
     parent::__construct("comment");
  }
  function getAllByProductId($productId){
    // id not used
    //return $this->getAll('product_id='.$productId);
    return $this->getAll();
  }
  function getComment($commentId){
    return $this->getOnceWhere('id='.$commentId);
  }
}
?>

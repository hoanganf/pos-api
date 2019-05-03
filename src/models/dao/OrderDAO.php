<?php
class OrderDAO extends BaseDAO{
  function __construct(){
     parent::__construct("`order`");
  }
  //getOrderListByArea
  function getOrderListGroupByTableInArea($area_id=-1){
    $sql=null;
    if($area_id>0){
       $sql='SELECT	o.*,t.name as table_name, sum(o.count) as count_sum,sum(o.price) as price_sum FROM `order` o INNER JOIN `table` t ON t.id = o.table_id WHERE t.area_id='.$area_id.' GROUP BY o.number_id ORDER BY o.order_time DESC';
    }else{
      //get all
      $sql='SELECT o.*, t.name as table_name, sum(o.count) as count_sum,sum(o.price) as price_sum FROM `order` o INNER JOIN `table` t ON t.id = o.table_id WHERE t.area_id='.$area_id.' GROUP BY o.number_id ORDER BY o.order_time DESC';
    }
    return $this->getAllQuery($sql);
  }

  function createOrder($order,$requester,$numberId){//if put connection mean transaction
    $sql='';
    //status==0 mean have to cook and else will finish now status will be send
    $finish_time=$order->status==0  ? '\'0000-00-00 00:00:00\'' :'now()';
    $sql = 'INSERT INTO `order` (waiter_id,chef_id, number_id, table_id, product_id,bill_detail_id, count, comments, order_time, finish_time, status, price) VALUES ';
    $sql.= '(\''.$requester.'\',\'\','.$numberId.', '.$order->table_id.', '.$order->product_id.',-1,'.$order->count.',\''.$order->comments.'\', now(), '.$finish_time.', \''.$order->status.'\', '.$order->price.');';
    //echo $sql;
    if(isset($this->connection)){
      return $this->queryNotAutoClose($sql);
    }else{
      return $this->query($sql);
    }
  }
  function updateOrder($order,$requester){//if put connection mean transaction
    $sql='';
    $sql = 'UPDATE `order` SET waiter_id=\''.$requester.'\',';
    $sql.='comments=\''.$order->comments.'\',order_time=now() WHERE id='.$order->id;
    if(isset($this->connection)){
      return $this->queryNotAutoClose($sql);
    }else{
      return $this->query($sql);
    }
    //TODO log this action to file for know who edit
  }
  /*
  return number of delete: -1 if error,0 if delete all,  1 if delete any
  */
  function removeOrderNotIn($orders,$numberId,$requester){//if put connection mean transaction
    $notInList='';
    $count=0;
    foreach( $orders as $order){
      if(isset($order->id)){//has id to delete
        $count++;
        if(empty($notInList)) {
          $notInList.='('.$order->id;
        }else{
          $notInList.=','.$order->id;
        }
      }
    }
    if(!empty($notInList)) {
      $notInList.=')';
      $sql='DELETE FROM `order` WHERE number_id='.$numberId.' AND id NOT IN '.$notInList;
    }else{
      $sql='DELETE FROM `order` WHERE number_id='.$numberId;
    }
    if(isset($this->connection)){
      if($this->queryNotAutoClose($sql)) return $count;
      else return -1;
    }else{
      if($this->query($sql)) return $count;
      else return -1;
    }
    //TODO log this action to file for know who delete
  }
}
?>

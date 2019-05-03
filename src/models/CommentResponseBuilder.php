<?php
	//echo 'OrderPageBuilder: '.$_SERVER["PHP_SELF"];
	class CommentResponseBuilder implements ResponseBuilder{
		public function build($request){
			$adapter=new CommentDAO();
			if(isset($_GET['productId']) && is_numeric($_GET['productId'])){
				$result=$adapter->getAllByProductId($_GET['productId']);
				if(!empty($result)) return json_encode(array('status'=>true,'code'=>SUCCEED,'comments'=>$result));
				else return ApiResponseGetter::createResponse('false',E_NO_COMMENT,'NO COMMENT');
			}else if(isset($_GET['commentId']) && is_numeric($_GET['commentId'])){
				$result=$adapter->getComment($_GET['commentId']);
				if($result!==null) return json_encode(array('status'=>true,'code'=>SUCCEED,'comment'=>$result));
				else return ApiResponseGetter::createResponse('false',E_NO_COMMENT,'NO COMMENT');
			}else{
				$result=$adapter->getAll();
				if(!empty($result)) return json_encode(array('status'=>true,'code'=>SUCCEED,'comments'=>$result));
				else return ApiResponseGetter::createResponse('false',E_NO_COMMENT,'NO COMMENT');
			}
		}
	}
?>

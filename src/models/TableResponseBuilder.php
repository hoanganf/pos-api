<?php
	//echo 'OrderPageBuilder: '.$_SERVER["PHP_SELF"];
	class TableResponseBuilder implements ResponseBuilder{
		public function build($request){
			$adapter=new CommentDAO();
			if(isset($_GET['areaId']) && is_numeric($_GET['areaId'])){
				$result=$adapter->getAllByAreaId($_GET['areaId']);
				if(!empty($result)) return json_encode(array('status'=>true,'code'=>SUCCEED,'tables'=>$result));
				else return ApiResponseGetter::createResponse('false',E_NO_TABLE,'NO TABLE');
			}else if(isset($_GET['tableId']) && is_numeric($_GET['tableId'])){
				$result=$adapter->getTable($_GET['tableId']);
				if($result!==null) return json_encode(array('status'=>true,'code'=>SUCCEED,'tables'=>$result));
				else return ApiResponseGetter::createResponse('false',E_NO_TABLE,'NO TABLE');
			}else{
				$result=$adapter->getAll();
				if(!empty($result)) return json_encode(array('status'=>true,'code'=>SUCCEED,'tables'=>$result));
				else return ApiResponseGetter::createResponse('false',E_NO_TABLE,'NO TABLE');
			}
		}
	}
?>

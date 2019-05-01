<?php
	//echo 'OrderPageBuilder: '.$_SERVER["PHP_SELF"];
	class ProductResponseBuilder implements ResponseBuilder{
		public function build($request){
			$adapter=new ProductDAO();
			if(isset($_GET['categoryId']) && is_numeric($_GET['categoryId'])){
				$products=$adapter->getProductsByCategoryId($_GET['categoryId']);
				if(!empty($products)) return json_encode(array('status'=>true,'code'=>SUCCEED,'products'=>$products),true);
				else return LocalApiResponseGetter::createResponse('false',E_NO_PRODUCT,'NO PRODUCT');
			}else if(isset($_GET['productId']) && is_numeric($_GET['productId'])){
				$product=$adapter->getProduct($_GET['productId']);
				if($product!==null) return json_encode(array('status'=>true,'code'=>SUCCEED,'product'=>$product),true);
				else return LocalApiResponseGetter::createResponse('false',E_NO_PRODUCT,'NO PRODUCT');
			}else{
				$products=$adapter->getAll();
				if(!empty($products)) return json_encode(array('status'=>true,'code'=>SUCCEED,'products'=>$products),true);
				else return LocalApiResponseGetter::createResponse('false',E_NO_PRODUCT,'NO PRODUCT');
			}
		}
	}
?>

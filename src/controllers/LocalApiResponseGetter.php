<?php
	class LocalApiResponseGetter extends ResponseGetter{
		public function buildResponse($pageId,$request){
			switch ($pageId) {
	      case 'order':
	        $responseBuilder=new OrderResponseBuilder();
	        break;
				case 'product':
	        $responseBuilder=new ProductResponseBuilder();
	        break;
				case 'comment':
	        $responseBuilder=new CommentResponseBuilder();
	        break;
	      default:
					return self::createResponse('false',E_BAD_REQUEST,'BAD REQUEST');
	    }
	    return $responseBuilder->build($request);
		}
	}
?>

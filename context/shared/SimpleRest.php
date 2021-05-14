<?php 
/*
A simple RESTful webservices base class
Use this as a template and build upon it
*/
class SimpleRest {
	

	public static function setHttpHeaders($contentType, $statusCode){
        $httpStatus = [
            200 => 'OK',
            201 => 'Created',
            204 => 'No Content',
            400 => 'Bad Request',  
            401 => 'Unauthorized', 
            403 => 'Forbidden',  
            404 => 'Not Found',
            500 => 'Internal Server Error',  
        ];

		$statusMessage = $httpStatus[$statusCode] ? $httpStatus[$statusCode] : $statusCode[500];
		
		header("HTTP/1.1 $statusCode $statusMessage");		
		header("Content-Type:". $contentType);
	}

}
?>
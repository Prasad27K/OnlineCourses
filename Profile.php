<?php
	if(session_start())
	{
		$userDetails = new stdClass();
		$userDetails = $_SESSION;
		$response = json_encode($userDetails);
		echo $response;
	}
	else
	{
		http_response_code(404);
	}
?>
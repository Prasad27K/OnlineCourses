<?php
	include 'MyConnection.php';
	if (!$conn)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	else 
	{
		$jsonString = file_get_contents('php://input');
		$newJsonString = json_decode($jsonString, true);

		$id = $newJsonString["id"];
		$query = "UPDATE syllabus set status = 0 where id = $id";
		if ($conn->query($query) === TRUE) 
		{
			echo 1;
			http_response_code(204);
			header('Status: 204 NO Content');
		}
		else
		{
			http_response_code(404);
			echo "Request failed";
		}
	}
	$conn->close();
?>
<?php
	include 'MyConnection.php';
	if (!$conn)
	{
		die("Connection failed: " . mysqli_connect_error());
		http_response_code(500);
	}
	else 
	{
		session_start();
		$userId = $_SESSION['userId'];
		$jsonString = file_get_contents('php://input');
		$newJsonString = json_decode($jsonString, true);

		$title = $newJsonString["title"];
		$description = $newJsonString["description"];
		$objective = $newJsonString["objectives"];

		$query = "INSERT INTO syllabus(title, description, objectives, userId, status) VALUES('$title', '$description', '$objective', $userId, 1)";
		if ($conn->query($query) === TRUE) 
		{
			$id = mysqli_insert_id($conn);
			$selectQuery = "SELECT id, title, description, objectives, status FROM syllabus where id = $id and userId = $userId";
			$result = $conn->query($selectQuery);
			$row = $result->fetch_assoc();
			$syllabusItems = new stdClass();
			$syllabusItems = $row;
			header('Content-Type: application/json');
			$response = json_encode($syllabusItems);
			echo $response;
			http_response_code(201);
		}
		else
		{
			http_response_code(404);
		}
	}
	$conn->close();
?>
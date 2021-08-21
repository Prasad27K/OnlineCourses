<?php
	include 'MyConnection.php';
	if (!$conn)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	else
	{
		session_start();
		$userId = $_SESSION['userId'];
		$query = "SELECT * FROM syllabus where userId = $userId";
		$result = $conn->query($query);
		if ($result->num_rows > 0)
		{
			$syllabusItems = [];
			while($row = $result->fetch_assoc())
			{
				$myObj = new stdClass();
				$myObj = $row;
				$syllabusItems[] = $myObj;
			}
			header('Content-Type: application/json');
			$response = json_encode($syllabusItems);
			echo $response;	
		}
		else
		{
			http_response_code(404);
			echo "No table found"; 
		}
	}
	$conn->close();	
?>
<?php
    include 'MyConnection.php';
    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
        http_response_code(500);
    }
    else 
    {
        $json_string = file_get_contents('php://input');
        $new_Jsons_tring = json_decode($json_string, true);

        $userName = $new_Jsons_tring["userName"];
        $password = $new_Jsons_tring["password"];
        if($userName != "" && $password != "")
        {
            $selectQuery = "SELECT * from users where userName = '$userName' or password = '$password'";
            $result = $conn -> query($selectQuery);
            $row = $result -> fetch_assoc();
            if($row["userName"] == $userName && $row["password"] == $password)
            {
                session_start();
                $_SESSION['userId'] = $row["userId"];
                $_SESSION['userName'] = $row["userName"];
                echo $row["userId"];
            }
            else 
            {
                http_response_code(400);
                session_destroy();
                die();
            }

        }
        else
        {
            http_response_code(404);
        }
    }
?>

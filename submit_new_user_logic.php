<?php
      $servername = "127.0.0.1"; // mysqli OO
      $username = "root";
      $password = "theWongDorr";
      $dbname = "tournament";
    ?>
    <form method="post">
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          if (empty($_POST["fullname"])) {
            $fullnameErr = "Name is required";
          } else {
            $fullname = test_input($_POST["fullname"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) {
              $fullnameErr = "Only letters and white space allowed"; 
            }
          }
          
          if (empty($_POST["email"])) {
            $emailErr = "Email is required";
          } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format"; 
            }
          }

          if (empty($_POST["birthdate"])) {
            $birthdateErr = "Birthdate must be present";
          } else {
            $birthdate = test_input($_POST["birthdate"]);
          }
        }

        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "INSERT INTO Users (fullname, birthdate, email)
    VALUES ('$fullname', '$birthdate', '$email')";

    if ($conn->query($sql) === TRUE) {
      header("Location:index.php");
        echo "New record created successfully";
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    ?>
  </body>
</html>
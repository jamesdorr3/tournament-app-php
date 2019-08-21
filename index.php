<?php 
  setcookie('name', 'James');
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hello, World!</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <style>.error{color:red}</style>
  </head>
  <body>
    <?php include 'menu.php' ?>
    <?php
      $servername = "127.0.0.1"; // mysqli OO
      $username = "root";
      $password = "theWongDorr";
      $dbname = "tournament";

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 

      $sql = "SELECT id, fullname, birthdate, email FROM Users";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          echo "<table>".
          "<tr><th></th><th>id</th><th>name</th><th>birthday</th><th>email</th></tr>";
          while($row = $result->fetch_assoc()) {
              echo "<tr><td><form method='post' id='delete' name='delete' ><input type='submit' value='X'/></form></td><td>" . $row["id"]. "</td><td>" . $row["fullname"]. "</td><td>" . $row["birthdate"]. "</td><td>" . $row["email"] . "</td></tr>";
          }
          echo "</table>";
      } else {
          echo "0 results";
      }
      $conn->close();

      if(($_SERVER["REQUEST_METHOD"]) == "POST"){
        foreach($_POST as $key=>$value){
          echo $key, $value;
        }
        $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to delete a record
$sql = "DELETE FROM Users WHERE id=10";

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully ";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

mysqli_close($conn);
      }
    ?>
  </body>
</html>
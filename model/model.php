<?php

$servername = "localhost";
$username = "root";
$password = "VjuHCjAj";
$dbname = "photostore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


//$sql = "SELECT customer_id, customer_name FROM customer";
//$result = $conn->query($sql);

/*if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["customer_id"]. " - Name: " . $row["customer_name"]. PHP_EOL;
  }
} else {
  echo "0 results";
}
$a = readline('Enter your name: ');
$sql = "INSERT INTO customer(customer_name) VALUES ('$a')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  } */

?>

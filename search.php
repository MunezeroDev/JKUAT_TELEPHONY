<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "iptelephony";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$searchQuery = mysqli_real_escape_string($conn, $_GET['search_query']);

$sql = "SELECT * FROM `depts` WHERE column_name LIKE '%$searchQuery%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['name'];

        echo "<p>ID: $id, Name: $name</p>";
    }
} else {
    echo "No results found.";
}

mysqli_close($conn);
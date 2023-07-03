<?php
include "../re-use/db_conn.php";

$id = $_POST["id"];
$sql = "DELETE  FROM `depts` WHERE id = $id";

$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: department.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}

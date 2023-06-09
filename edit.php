<?php
include "./re-use/db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $campus_code = $_POST['ccode'];
    $department_code = $_POST['deptcode'];
    $owner_assigned = $_POST['ownerassigned'];
    $department_name = $_POST['deptname'];

    $sql = "UPDATE `depts` SET `ccode`='$campus_code',`deptcode`='$department_code',`ownerassigned`='$owner_assigned',`deptname`='$department_name' WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php?msg=Data updated successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
include("./re-use/links.html");
?>

<body>
    <?php
    include("./re-use/header.html");
    ?>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit User Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <?php
        $sql = "SELECT * FROM `depts` WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Campus Code:</label>
                        <input type="text" class="form-control" name="ccode" value="<?php echo $row['ccode'] ?>">
                    </div>

                    <div class="col">
                        <label class="form-label">Department Code:</label>
                        <input type="number" class="form-control" name="deptcode" value="<?php echo $row['deptcode'] ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Owner Assigned:</label>
                    <input type="text" class="form-control" name="ownerassigned" value="<?php echo $row['ownerassigned'] ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Department Name:</label>
                    <input type="text" class="form-control" name="deptname" value="<?php echo $row['deptname'] ?>">
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

</body>

</html>
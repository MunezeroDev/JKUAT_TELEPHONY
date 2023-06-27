<?php
include "../re-use/db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $campus_code = $_POST['ccode'];
    $campus_name = $_POST['cname'];
    $added_by = $_POST['addedby'];

    $sql = "UPDATE `campuses` SET `ccode`='$campus_code',`cname`='$campus_name',`addedby`='$added_by' WHERE cid = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: campus.php?msg=Data updated successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
include("../re-use/links.html");
?>

<body>
    <?php
    include("../re-use/header.html");
    ?>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit User Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <?php
        $sql = "SELECT * FROM `campuses` WHERE cid = $id LIMIT 1";
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
                        <label class="form-label">Campus Name:</label>
                        <input type="text" class="form-control" name="cname" value="<?php echo $row['cname'] ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Added By:</label>
                    <input type="text" class="form-control" name="addedby" value="<?php echo $row['addedby'] ?>">
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="campus.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

</body>

</html>
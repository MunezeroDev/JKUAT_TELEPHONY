<?php
include "../re-use/db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $FirstName = $_POST['firstName'];
    $Surname = $_POST['Surname'];
    $OtherNames = $_POST['OtherNames'];
    $Email = $_POST['Email'];
    $AdminType = $_POST['AdminType'];
    $AddedBy = $_POST['AddedBy'];

    $sql = "UPDATE `adminregistration` SET `fname`='$FirstName',`surname`='$Surname',`othernames`='$OtherNames ',`email`=' $Email',`admintype`='$AdminType',`addedby` ='$AddedBy' WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: admin.php?msg=Data updated successfully");
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
        $sql = "SELECT * FROM `adminregistration` WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">First Name:</label>
                        <input type="text" class="form-control" name="firstname" value="<?php echo $row['fname'] ?>">
                    </div>

                    <div class="col">
                        <label class="form-label">Surname:</label>
                        <input type="text" class="form-control" name="Surname" value="<?php echo $row['surname'] ?>">
                    </div>


                    <div class="col">
                        <label class="form-label">Other Names:</label>
                        <input type="text" class="form-control" name="OtherNames" value="<?php echo $row['othernames'] ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Email:</label>
                        <input type="text" class="form-control" name="Email" value="<?php echo $row['email'] ?>">
                    </div>

                    <div class="col">
                        <label class="form-label">Admin Type:</label>
                        <input type="text" class="form-control" name="AdminType" value="<?php echo $row['adminType'] ?>">
                    </div>

                    <div class="col">
                        <label class="form-label">Added By:</label>
                        <input type="text" class="form-control" name="AddedBy" value="<?php echo $row['addedBy'] ?>">
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="admin.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>

</body>

</html>
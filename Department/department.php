<?php
include "../re-use/db_conn.php";
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
        <?php
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo  '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ' . $msg . '
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>

        <?php
        include("../re-use/pagination-settings.php");
        ?>

        <!-- Modal ADD NEW -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?php
            include "../re-use/db_conn.php";

            if (isset($_POST["submit"])) {
                $campus_code = $_POST['ccode'];
                $department_code = $_POST['deptcode'];
                $owner_assigned = $_POST['ownerassigned'];
                $department_name = $_POST['deptname'];

                $sql = "INSERT INTO `depts`(`id`, `ccode`, `deptcode`, `ownerassigned`, `deptname`) VALUES (NULL,'$campus_code','$department_code','$owner_assigned','$department_name')";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header("Location: department.php?msg=New record created successfully");
                } else {
                    echo "Failed: " . mysqli_error($conn);
                }
            }

            ?>

            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-popup">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label">Campus Code:</label>
                                <input type="text" class="form-control" name="ccode">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Department Code:</label>
                                <input type="number" class="form-control" name="deptcode">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Owner Assigned:</label>
                                <input type="text" class="form-control" name="ownerassigned">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Department Name:</label>
                                <input type="text" class="form-control" name="deptname">
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="submit">Save</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- button -->
        <div class="btn-div" style="display: flex;">
            <a class="btn" style="background-color: blue; color:white; margin-bottom:8px; " data-bs-toggle="modal" data-bs-target="#myModal">Add
                New Department</a>
        </div>

        <!-- search -->
        <div class="search" style=" width:100%; margin-bottom:10px">
            <?php
            include("search.php");
            ?>

        </div>

        <!-- table diplay -->
        <div class="table-container">
            <table class="table table-hover text-center">
                <thead class="custom-background">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">CampusCode</th>
                        <th scope="col">DeptCode</th>
                        <th scope="col">Owner Assigned</th>
                        <th scope="col">DepartmentName</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `depts` LIMIT $startFrom, $resultsPerPage";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["id"] ?></td>
                            <td><?php echo $row["ccode"] ?></td>
                            <td><?php echo $row["deptcode"] ?></td>
                            <td><?php echo $row["ownerassigned"] ?></td>
                            <td><?php echo $row["deptname"] ?></td>
                            <td>


                                <a href="edit.php?id=<?php echo $row["id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3" style="color:  #21BC10;"></i></a>

                                <a href="#" class="link-dark" data-bs-toggle="modal" data-bs-target="#myModal2" data-id="<?php echo $row["id"]; ?>">
                                    <i class="fa-solid fa-trash fs-5" style="color :red" ;></i>
                                </a>

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- pagination -->
        <?php
        include("../re-use/pagination.php");
        ?>
    </div>

    <!-- delete modal -->
    <div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-popup">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer">
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="id" id="deleteId" value="">
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="search_result"></div>

    <!-- Google CDN -->
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js">
    </script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
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
                $campus_name = $_POST['cname'];
                $addedby = $_POST['addedby'];

                $sql = "INSERT INTO `campuses`(`cid`, `ccode`, `cname`, `addedby`) VALUES (NULL,' $campus_code','$campus_name',' $addedby')";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header("Location: campus.php?msg=New record created successfully");
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
                                <label class="form-label">Campus Name:</label>
                                <input type="text" class="form-control" name="cname">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Added By:</label>
                                <input type="text" class="form-control" name="addedby">
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

        <!-- table of content -->
        <a class="btn" style="background-color: blue; color:white; margin-bottom:15px" data-bs-toggle="modal" data-bs-target="#myModal">Add
            New Campus</a>
        <div class="table-container">
            <table class="table table-hover text-center">
                <thead class="custom-background">
                    <tr>
                        <th scope="col">CID</th>
                        <th scope="col">Campus Code</th>
                        <th scope="col">Campus Name</th>
                        <th scope="col">Added By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `campuses` LIMIT $startFrom, $resultsPerPage";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["cid"] ?></td>
                            <td><?php echo $row["ccode"] ?></td>
                            <td><?php echo $row["cname"] ?></td>
                            <td><?php echo $row["addedby"] ?></td>
                            <td>

                                <a href="edit.php?id=<?php echo $row["cid"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3" style="color:  #21BC10;"></i></a>

                                <a href="#" class="link-dark" data-bs-toggle="modal" data-bs-target="#myModal2" data-id="<?php echo $row["cid"]; ?>">
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

        <?php

        // Pagination settings
        $resultsPerPage = 10; // Number of results to display per page
        $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

        // Calculate the starting position for fetching results
        $startFrom = ($page - 1) * $resultsPerPage;

        // Fetch the total number of results
        $totalResults = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `campuses`"));

        // Calculate the total number of pages
        $totalPages = ceil($totalResults / $resultsPerPage);
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

    <script>
        var myModal = document.getElementById('myModal2');
        myModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            document.getElementById('deleteId').value = id;
        });
    </script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
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

        // Pagination settings
        $resultsPerPage = 10; // Number of results to display per page
        $page = isset($_GET['page']) ? $_GET['page'] : 1; // Current page number

        // Calculate the starting position for fetching results
        $startFrom = ($page - 1) * $resultsPerPage;

        // Fetch the total number of results
        $totalResults = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `trialexcel`"));

        // Calculate the total number of pages
        $totalPages = ceil($totalResults / $resultsPerPage);
        ?>

        <!-- Modal ADD NEW -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?php
            include "../re-use/db_conn.php";

            if (isset($_POST["submit"])) {
                $campus_code = $_POST['ccode'];
                $extension_number = $_POST['extnumber'];
                $owner_assigned = $_POST['owerassigned'];
                $department_name = $_POST['deptname'];

                $sql = "INSERT INTO `trialexcel`(`id`, `ccode`, `extnumber`, `owerassigned`, `deptname`) VALUES (NULL,'$campus_code','$extension_number','$owner_assigned','$department_name')";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header("Location: extensions.php?msg=New record created successfully");
                } else {
                    echo "Failed: " . mysqli_error($conn);
                }
            }

            ?>

            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-popup">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Extension</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label">Campus Code:</label>
                                <input type="text" class="form-control" name="ccode">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Extension Number</label>
                                <input type="number" class="form-control" name="extnumber">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Owner Assigned:</label>
                                <input type="text" class="form-control" name="owerassigned">
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
                New Extension</a>
        </div>

        <!-- search -->
        <div class="search" style=" width:100%; margin-bottom:10px">
            <?php
            include("search.php");
            ?>
        </div>



        <!-- display -->
        <div class="table-container">
            <table class="table table-hover text-center">
                <thead class="custom-background">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Campus Code</th>
                        <th scope="col">Extension Number</th>
                        <th scope="col">Owner Assigned</th>
                        <th scope="col">Department Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `trialexcel` LIMIT $startFrom, $resultsPerPage";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["id"] ?></td>
                            <td><?php echo $row["ccode"] ?></td>
                            <td><?php echo $row["extnumber"] ?></td>
                            <td><?php echo $row["owerassigned"] ?></td>
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
        <div class="pagination-container">
            <?php if ($totalPages > 1) : ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php
                        $maxVisiblePages = 10; // Maximum number of page links to display
                        $halfMaxVisiblePages = floor($maxVisiblePages / 2);
                        $startPage = max($page - $halfMaxVisiblePages, 1);
                        $endPage = min($startPage + $maxVisiblePages - 1, $totalPages);

                        if ($startPage > 1) {
                            echo '
                            <li class="page-item">
                                <a class="page-link" href="?page=1" aria-label="First">
                                    <span aria-hidden="true">&laquo;&laquo;</span>
                                    <span class="sr-only">First</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=' . ($startPage - 1) . '" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            ';
                        }

                        for ($i = $startPage; $i <= $endPage; $i++) {
                            echo '
                        <li class="page-item ' . ($page == $i ? 'active' : '') . '">
                        <a class="page-link" href="?page=' . $i . '">' . $i . '</a>
                        </li>
                        ';
                        }

                        if ($endPage < $totalPages) {
                            echo '
                            <li class="page-item">
                                <a class="page-link" href="?page=' . ($endPage + 1) . '" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=' . $totalPages . '" aria-label="Last">
                                    <span aria-hidden="true">&raquo;&raquo;</span>
                                    <span class="sr-only">Last</span>
                                </a>
                            </li>
                            ';
                        }
                        ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>


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


    <div id="search_result"></div>

    <!-- Google CDN -->
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js">
    </script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
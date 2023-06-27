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
        $totalResults = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `adminregistration`"));

        // Calculate the total number of pages
        $totalPages = ceil($totalResults / $resultsPerPage);
        ?>


        <!-- Modal ADD NEW -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?php
            include "../re-use/db_conn.php";

            if (isset($_POST["submit"])) {
                $FirstName = $_POST['firstName'];
                $Surname = $_POST['Surname'];
                $OtherNames = $_POST['OtherNames'];
                $Email = $_POST['Email'];
                $AdminType = $_POST['AdminType'];
                $AddedBy = $_POST['AddedBy'];


                $sql = "INSERT INTO `adminregistration`(`id`, `fname`, `surname`, `othernames`, `email`, `admintype`, `addedby`) VALUES (NULL,' $FirstName','$Surname','$OtherNames','$Email','$AdminType','$AddedBy' )";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header("Location: admin.php?msg=New record created successfully");
                } else {
                    echo "Failed: " . mysqli_error($conn);
                }
            }

            ?>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-popup">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Admnistrator</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label class="form-label">First Name:</label>
                                <input type="text" class="form-control" name="firstName">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Surname:</label>
                                <input type="text" class="form-control" name="Surname">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Other Names:</label>
                                <input type="text" class="form-control" name="OtherNames">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email:</label>
                                <input type="text" class="form-control" name="Email">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Admin Type:</label>
                                <input type="text" class="form-control" name="AdminType">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Added By:</label>
                                <input type="text" class="form-control" name="AddedBy">
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

        <a class="btn" style="background-color: blue; color:white; margin-bottom:15px" data-bs-toggle="modal" data-bs-target="#myModal">Add
            New Admin</a>

        <!-- table display -->
        <div class="table-container">
            <table class="table table-hover text-center">
                <thead class="custom-background">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Surname </th>
                        <th scope="col">Other Names</th>
                        <th scope="col">Email</th>
                        <th scope="col">Admin Type</th>
                        <th scope="col">AddedBy</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `adminregistration` LIMIT $startFrom, $resultsPerPage";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row["id"] ?></td>
                            <td><?php echo $row["fname"] ?></td>
                            <td><?php echo $row["surname"] ?></td>
                            <td><?php echo $row["othernames"] ?></td>
                            <td><?php echo $row["email"] ?></td>
                            <td><?php echo $row["adminType"] ?></td>
                            <td><?php echo $row["addedBy"] ?></td>
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


    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
include "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merienda+One">

    <!-- generic header link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- google icons such the search icon -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- the message and alarm box link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- drop down functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

    <!-- drop down menu -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- custom css -->
    <link rel="stylesheet" href="css/custom.css">

    <title>Departments </title>
</head>

<body>
    <section id="header">
        <div class="img-holder"><a href="#"><img src="../AUTH/img/download.JPEG" alt="" class="logo"></a></div>

        <div class="search-container">
            <form method="GET" action="search.php">
                <input type="search" id="form1" class="form-control" name="search_query" />

            </form>
            <button type="button" class=" search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <div class="nav-holder-container">
            <ul class="nav-holder">
                <li> <a href="index.php">Extension</a></li>
                <li> <a href="department.php">Department</a></li>
                <li> <a href="campus.php">Campus</a></li>
                <li> <a href="admin.php">Administrators </a></li>
            </ul>
            <div id="admin-container" class="">
                <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"> Admn <b class="caret"></b></a>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a></a>
                    <!-- <a href="#" class="dropdown-item"><i class="fa fa-calendar-o"></i> Calendar</a></a> -->
                    <a href="#" class="dropdown-item"><i class="fa fa-sliders"></i> Settings</a></a>
                    <div class="dropdown-divider"></div>
                    <a href="../AUTH/login.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i>
                        Logout</a></a>
                </div>
            </div>
        </div>
    </section>


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
        $totalResults = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `depts`"));

        // Calculate the total number of pages
        $totalPages = ceil($totalResults / $resultsPerPage);
        ?>


        <!-- Modal ADD NEW -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <?php
            include "db_conn.php";

            if (isset($_POST["submit"])) {
                $campus_code = $_POST['ccode'];
                $department_code = $_POST['deptcode'];
                $owner_assigned = $_POST['ownerassigned'];
                $department_name = $_POST['deptname'];

                $sql = "INSERT INTO `depts`(`id`, `ccode`, `deptcode`, `ownerassigned`, `deptname`) VALUES (NULL,'$campus_code','$department_code','$owner_assigned','$department_name')";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header("Location: index.php?msg=New record created successfully");
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

        <a class="btn" style="background-color: blue; color:white; margin-bottom:15px" data-bs-toggle="modal" data-bs-target="#myModal">Add
            New Department</a>

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


    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>
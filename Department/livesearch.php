<?php

include "../re-use/db_conn.php";
include("../re-use/links.html");
if (isset($_POST['input'])) {

    $input = $_POST['input'];

    $query = "SELECT * FROM depts WHERE deptname LIKE '{$input}%' OR   ownerassigned LIKE '{$input}%' ";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) { ?>


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

                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                ?>

                    <tbody>


                        <!-- ----- -->
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
                        <!-- ---------- -->
                    <?php
                }
                    ?>

                    </tbody>

            </table>

        </div>

<?php
    } else {
        echo "<h6 class='text-danger text-center mt-3'>No data found</h6>";
    }
}

?>
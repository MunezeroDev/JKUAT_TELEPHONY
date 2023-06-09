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

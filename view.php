<?php include_once('conn.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Display Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icofont/1.0.1/icofont.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="height: 75px; background-color: blue;">

        <div class="container-fluid">
            <a class="navbar-brand" href="">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php"><i class="bi bi-person-plus-fill"></i></a>
                    </li> 
                </ul>
            </div>
            <form class="d-flex" method="GET" action="">
                <input class="form-control me-2" type="search" name="search" placeholder="Search anything" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

        </div>
    </nav>

    <div class="container mt-5" style="text-align:center">
        <?php
            if (isset($_GET['msg'])) {
                $message = $_GET['msg'];
                if($message == "1") {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Data Inserted successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                } elseif ($message == "2") {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Data updated successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                } elseif ($message == "@"){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> Data Deleted successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
            }
        ?>
        <!-- <h2 class="text-center" style="margin-bottom: 20px;" ><mark>Displaying All Records</mark></h2> -->

        <!-- <div class="text-right mb-3">
            <a href="index.php" class="btn btn-success">Insert Data</a>
        </div> -->

        <table class="table table-bordered table-striped">
            <tr>
                <th>serial num</th>
                <th>Name</th>
                <th>User Image</th>
                <th>Email</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Caste</th>
                <th colspan="2">Action</th>
            </tr>

            <?php
                $limit = 10;
                
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                } else{
                    $page=1;
                }
                $offset = ($page - 1) * $limit;
                if(isset($_GET['search'])){
                    $search = $_GET['search'];
                }
                else{
                    $search = "";
                }
                if(!empty($search)){
                        // data display kar rahi hai data table me
                 $query = "SELECT * FROM new_form WHERE Name LIKE '%$search%' or Email LIKE '%$search%' or Address LIKE '%$search%' or gender LIKE '%$search%' or caste LIKE '%$search%' LIMIT {$offset} , {$limit}";
                } else {
                    $query = "SELECT * FROM new_form LIMIT {$offset} , {$limit}";
                }

                $result = mysqli_query($conn, $query);

                $allRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $i = $offset+1;

                if (!empty($allRows)) {
                
                foreach ($allRows as $row) {
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo($row['Name']); ?></td>
                    <td><img src="<?php echo ($row['Image']); ?>" height="100" width="100"/></td>
                    <td><?php echo ($row['Email']); ?></td>
                    <td><?php echo ($row['Address']); ?></td>
                    <td><?php echo ($row['gender']); ?></td>
                    <td><?php echo ($row['caste']); ?></td>

                    <td>
                        <a href="index.php?id=<?php echo $row['id']; ?>" onclick="return check2();"><i class="bi bi-pencil text-success"></i></a>
                    </td>
                    <td>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return check();" ><i class="bi bi-trash text-danger"></i></a>
                    </td>
                </tr>
            <?php
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
                }
            ?>
        </table>
        <?php
        // pagination count karne ke liye  ye query likhi hai 
        if(!empty($search)){
            $sql = "SELECT * FROM new_form WHERE NAME LIKE '%$search%' or EMAIL LIKE '%$search%' or Address LIKE '%$search%' or gender LIKE '%$search%' or caste LIKE '%$search%'";
        }else{
        $sql = "SELECT * FROM new_form";
        }
        $result = mysqli_query($conn,$sql) or die("query failed");
        if(mysqli_num_rows($result)> 0){    
            $total_record = mysqli_num_rows($result);
            $total_page = ceil($total_record/$limit);

            echo'<nav><ul class="pagination  justify-content-center">';
            for($i = 1; $i<=$total_page;$i++){
                $active = ($i==$page) ? 'active' : '';
                echo '<li class="page-item ' . $active . '">
                    <a class="page-link" href="view.php?page=' . $i . '">' . $i . '</a>
                </li>';
 
            }
            echo '</ul></nav>';
        }
        ?>
    </div>

    <script>
        function check() {
            return confirm("Are you sure you want to delete this record");
        }
        function check2() {
            return confirm("Hey! Do you want to change this record");
        }
    </script>
</body>
</html>

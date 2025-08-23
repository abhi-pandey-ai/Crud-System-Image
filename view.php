<?php include_once('conn.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Display Records</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Insert</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>



<div class="container mt-5">
    <?php
        if (isset($_GET['msg'])) {
            $message = $_GET['msg'];
          

            if($message == "1") {
                echo '<div class="alert alert-success" role="alert">Data inserted successfully</div>';
            } elseif ($message == "2") {
                echo '<div class="alert alert-success" role="alert">Data updated successfully</div>';
            } elseif ($message == "@"){
                echo '<div class="alert alert-danger" role="alert">
                        Record Delete Successfully.
                        </div>';
            }
        }
    ?>
    <h2 class="text-center" ><mark>Displaying All Records</mark></h2>

    <div class="text-right mb-3">
        <a href="index.php" class="btn btn-success">Insert Data</a>
    </div>

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
        $query = "SELECT * FROM new_form";
        $result = mysqli_query($conn, $query);

        $allRows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $i =1;

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
                    <a href="index.php?id=<?php echo $row['id']; ?>" onclick="return check2();" class="btn btn-primary">Update</a>
                </td>
                <td>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return check();" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
        }
        ?>
    </table>
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

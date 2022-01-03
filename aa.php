<?php session_start(); 
$con = mysqli_connect("localhost","root","","phptutorials");

if(isset($_POST['update_stud_data']))
{
    $id = $_POST['stud_id'];

    $name = $_POST['name'];
    $class = $_POST['class'];
    $phone = $_POST['phone'];

    $query = "UPDATE student SET stud_name='$name', stud_class='$class', stud_phone='$phone' WHERE id='$id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data Updated Successfully";
        header("Location: index.php");
    }
    else
    {
        $_SESSION['status'] = "Not Updated";
        header("Location: index.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funda of Web IT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        unset($_SESSION['status']);
                    }
                ?>

                <div class="card mt-5">
                    <div class="card-header">
                        <h4>How to Update Data by ID into Database in PHP MySQL</h4>
                    </div>
                    <div class="card-body">

                        <form action="code.php" method="POST">

                            <div class="form-group mb-3">
                                <label for="">Student ID</label>
                                <input type="text" name="stud_id" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Class</label>
                                <input type="text" name="class" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone No.</label>
                                <input type="text" name="phone" class="form-control" >
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="update_stud_data" class="btn btn-primary">Update Data</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
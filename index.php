<?php
$conn = mysqli_connect("localhost", "root", "", "test");
if(isset($_POST['save_multiple_data']))
{
  // echo "<pre>";
  // print_r($_POST); exit;
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $salary = $_POST['salary'];
  $id_mem = $_POST['id_mem'];
  $name_mem = $_POST['name_mem'];
  $date = date('Y-m-d h:i:s');
  // echo "INSERT INTO form (name, email, phone, salary, created_at) VALUES ('$name','$email', $phone, $salary, '$date')"; exit;
  $query = mysqli_query($conn, "INSERT INTO form (name, email, phone, salary, created_at) VALUES ('$name','$email', $phone, $salary, '$date')");
  $last_id = mysqli_insert_id($conn);

  foreach($name_mem as $index => $names)
  {
      $s_name = $names;
      $s_id_mem = $id_mem[$index];
      $query = mysqli_query($conn, "INSERT INTO members (form_id, name_mem, id_mem) VALUES ($last_id, '$s_name', $s_id_mem)");
  }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multiple Members</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>
<body>
<div class="container">
<form action="" method="POST">
<input type="text"  name="name" placeholder="Head Name">
<input type="text"  name="email" placeholder="example@gmail.com">
<input type="number" name="phone" placeholder="Phone No.">
<input type="number" name="salary" placeholder="Salary">  
<input type="button" class="add-more-form btn btn-success" value="ADD MEMBERS">

<div class="paste-new-forms"></div>
<button type="submit" name="save_multiple_data" class="btn btn-primary">Save Multiple Data</button>
</form>
</div>


<script>
  $(document).ready(function () {
      $(document).on('click', '.remove-btn', function () {
          $(this).closest('.main-form').remove();
      });
      
      $(document).on('click', '.add-more-form', function () {
          $('.paste-new-forms').append(
            '<div class="main-form">\
            <input type="text" name="name_mem[]"  required placeholder="Enter Member Name">\
            <input type="text" name="id_mem[]" required placeholder="Member ID">\
            <button type="button" class="remove-btn btn btn-sm btn-danger ">Remove</button>\
            </div>'
          );
      });

  });
</script>

</body>
</html>


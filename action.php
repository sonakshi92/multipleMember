<?php
$conn = mysqli_connect("localhost", "root", "", "test");
$parent = mysqli_query($conn, "select * from form");

if(isset($_POST['save_multiple_data']))
{
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $salary = $_POST['salary'];
  $id_mem = $_POST['id_mem'];
  $name_mem = $_POST['name_mem'];
  $date = date('Y-m-d h:i:s');
  $query = mysqli_query($conn, "INSERT INTO form (name, email, phone, salary, created_at) VALUES ('$name','$email', $phone, $salary, '$date')");
  $last_id = mysqli_insert_id($conn);

  foreach($name_mem as $index => $names)
  {
    $s_name = $names;
    $s_id_mem = $id_mem[$index];
    $query = mysqli_query($conn, "INSERT INTO members (form_id, name_mem, id_mem) VALUES ($last_id, '$s_name', $s_id_mem)");
  }
  header("location:view.php");
}

if(isset($_POST['addChild'])){
  $form_id = $_POST['form_id'];
  $id_mem = $_POST['id_mem'];
  $name_mem = $_POST['name_mem'];
  $query = mysqli_query($conn, "INSERT INTO members (form_id, name_mem, id_mem) VALUES ($form_id, '$name_mem', $id_mem)");
  header("location:view.php");
}

if(isset($_POST['updateChild'])){
  $mid = $_POST['member_id'];
  $id_mem = $_POST['id_mem'];
  $name_mem = $_POST['name_mem'];
  $query = mysqli_query($conn, "UPDATE members SET name_mem='$name_mem', id_mem=$id_mem WHERE id=$mid");
  header("location:view.php");
}

if(isset($_POST['updateParent'])){
  $id = $_POST['form_id'];
  $mid = $_POST['member_id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $salary = $_POST['salary'];
  $date = date('Y-m-d h:i:s');
  $query = mysqli_query($conn, "UPDATE form SET name='$name', email='$email', phone='$phone', salary=$salary, updated_at='$date' WHERE id=$id");
  header("location:view.php");
}

if(isset($_POST['deleteChild'])){
  $mid = $_POST['member_id'];
  mysqli_query($conn, "DELETE FROM members WHERE id=$mid");
  header("location:view.php");
}

if(isset($_POST['delete'])){
  $form_id = $_POST['form_id'];
  mysqli_query($conn, "DELETE FROM form WHERE id=$form_id");
  mysqli_query($conn, "DELETE FROM members WHERE form_id=$form_id");
  header("location:view.php");
}
?>
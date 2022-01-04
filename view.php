<?php
$conn = mysqli_connect("localhost", "root", "", "test");
$parent = mysqli_query($conn, "select * from form");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Members</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
    <a href="index.php" class="remove-btn btn btn-success ">Add Head and Members</a>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Head Name</th>
        <th>email</th>
        <th>phone</th>
        <th>Salary</th>
        <th>Member ID</th>
        <th>Member Name</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
     <?php while ($rowResult =  mysqli_fetch_assoc($parent)){
        $parentId = $rowResult['id']; 
        ?><tr>
        <form action="action.php" method="POST">
       <div class="form-group"> 
            <td>
                <input type="hidden" class="form-control" name="form_id"  value="<?php echo $rowResult['id'] ?>">
                <input type="text" class="form-control" name="name"  value="<?php echo $rowResult['name'] ?>">
            </td>
        </div>
        <div class="form-group"> 
            <td><input type="text" class="form-control" name="email"  value="<?php echo $rowResult['email'] ?>"></td>
        </div>
        <div class="form-group"> 
            <td><input type="number" class="form-control" name="phone" value="<?php echo $rowResult['phone'] ?>"></td>
        </div>
        <div class="form-group"> 
             <td><input type="number" class="form-control" name="salary" placeholder="Salary" value="<?php echo $rowResult['salary'] ?>"></td>
        </div>
       <div class="form-group"> 
        <td>
            <?php 
                $childs = mysqli_query($conn, "select * from members where form_id = $parentId");
                    while ($child = mysqli_fetch_assoc($childs))
                {
                    if($parentId == $child['form_id']){?>
                     <input type="hidden" class="form-control" name="member_id"  value="<?php echo $child['id'] ?>">
                    <input type="text"  class="form-control" name="id_mem"  value="<?php echo $child['id_mem']?>">
                <?php    }
                } ?>
        </td>
        </div>
    <td>
        <?php 
            $childs = mysqli_query($conn, "select * from members where form_id = $parentId");
                while ($child = mysqli_fetch_assoc($childs))
                {
                    if($parentId == $child['form_id']){?>
             <div class="input-group"> 
                   <input type="text" class="form-control" name="name_mem"  value="<?php echo $child['name_mem']?>">
                   <span class="input-group-addon"><i class=""></i>
                   <input type="submit" class="btn btn-sm btn-danger" name="deleteChild" value="Delete">
                   <input type="submit" class="btn btn-sm btn-success" name="updateChild" value="Update">
                  </span>
            </div>
                <?php    }
                    }
                ?>
    <div class="display<?php echo $parentId?>"></div>
    </td>
    <td>
        <input type="button"  onClick="addMem(<?php echo $parentId ?>)" class="btn btn-primary" value="Add Members">
        <input type="submit" class="btn btn-danger" name="delete" value="Delete">
        <input type="submit" class="btn btn-warning" name="updateParent" value="update Parent">
    </td>
    </tr>
</form>
    <?php    } ?>
    </tbody>
</table>
<div class="paste-new-forms"></div>
</div>
<script>
    $(document).ready(function () {
      $(document).on('click', '.remove-btn', function () {
          $(this).closest('.main-form').remove();
      });
    });
  function addMem(id){
    //   alert(id);
    $('.display'+id).append(
        '<div class="main-form"><form action="action.php" method=POST>\
        <input type="text" name="name_mem"  required placeholder="Enter Member Name">\
        <input type="hidden" name="form_id" value="'+id+'">\
        <button type="button" class="remove-btn btn btn-sm btn-danger ">Remove</button>\
       <input type="text" name="id_mem" required placeholder="Member ID">\
       <input type="submit" class="btn btn-primary" name="addChild" value="Add">\
       </form></div>'
        );
  }
</script>
</body>
</html>
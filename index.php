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
<a href="view.php" class="remove-btn btn btn-primary">View Head and Members</a>
<form action="action.php" method="POST">
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


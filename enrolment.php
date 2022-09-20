<?php 
ob_start();
include('class/Course.php');
if(!empty($_SESSION["adminUserid"])) {	
	header("location: dashboard.php"); 	
}
$enrolment = new Course();
$errorMessage =  $enrolment->createcourse();
// $course->updatecourse();
// $course->addenrolment();

?>



<link href="style.css" rel="stylesheet" id="bootstrap-css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
>
<!------ Include the above in your HEAD tag ---------->



<table class="table">
  <thead>
    <tr>
      <th scope="col">Subject Name</th>
      <th scope="col">Code</th>
      <th scope="col">Teacher Name</th>
      <th scope="col">Student Name</th>
    </tr>
  </thead>
  <tbody>
  <?php echo $enrolment->enrolment(); ?>
  </tbody>
</table>




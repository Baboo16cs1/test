<?php 
ob_start();
include('class/Course.php');
if(!empty($_SESSION["adminUserid"])) {	
	header("location: dashboard.php"); 	
}
$course = new Course();
$errorMessage =  $course->createcourse();
$course->updatecourse();
$course->addenrolment();

?>



<link href="style.css" rel="stylesheet" id="bootstrap-css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style>

	</style>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<div class="row">
    <div class="col-md-4">
		<div class="form_main">
			
                <h4 class="heading"><strong>Create </strong> Course <span></span></h4>
                <div class="form">
                <form action="" method="post" id="contactFrm" name="contactFrm">
                    <input type="text" required="" placeholder="Please Enter Course Name" value="" name="subjectname" class="txt">
                    <input type="text" required="" placeholder="Please Enter Code " value="" name="code" class="txt">
                   
                     <input type="submit" value="submit" name="submitcourse" class="txt2">
                </form>
            </div>
            </div>
            </div
	</div>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Code</th>
      <th scope="col" colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php echo $course->subjectlist(); ?>
  </tbody>
</table>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="" method="post" id="contactFrm" name="contactFrm">
         <input type="text" name="name" id="name" class="form-control">
         <input type="text" name="code" id="code" class="form-control">
      
          <input type="hidden" name="subject" id="teacherid" class="form-control">
           <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
    
  </div>
</div>




<div class="modal fade" id="Enrolment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="" method="post" id="contactFrm" name="contactFrm">
      		<input type="hidden" name="enrolment" value="1">
         <select name="teacherid" class="form-control" >
      			<option>Select Teacher</option>
      		<?php echo $course->getTeacherList(); ?>
      		 </select><br>
      		 <select name="studentid" class="form-control" >
      			<option>Select Teacher</option>
      		<?php echo $course->getstudentList(); ?>
      		 </select>
          <input type="hidden" name="coursidd" id="coursidd" class="form-control">
           <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
    
  </div>
</div>



<!-- Button trigger modal -->




<script type="text/javascript">
	
	$(document).on('click', '.delete', function(){
		var deleteSubject = $(this).attr("id");		
		var action = "deleteSubject";
		if(confirm("Are you sure you want to delete this Teacher?")) {
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{deleteSubject:deleteSubject, action:action},
				success:function(data) {					
				location.reload();
				}
			})
		} else {
			return false;
		}
	});	


	

		// $(document).on('click', '.editmodal', function(){
			$('body').on('click', '.editmodal', function() {
			
			 
		var getSubject = $(this).attr("id");
		var action = 'getSubject';
		$.ajax({
			url:'action.php',
			method:"POST",
			data:{getSubject:getSubject, action:action},
			dataType:"json",
			success:function(data){
				$('#exampleModal').modal('show');
				$('#name').val(data.subjectname);
					$('#code').val(data.code);
				$('#teacherid').val(data.id);				
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Class");
				$('#action').val('updateClass');
				$('#exampleModal').modal('show');
				$('#save').val('Save');
			}
		})
	});	

			$('body').on('click', '.Enrolment', function() {
			
			 
		var Enrolment = $(this).attr("id");
		alert(Enrolment)
		$('#coursidd').val(Enrolment);
		$('#Enrolment').modal('show');
		
	});	


			
</script>
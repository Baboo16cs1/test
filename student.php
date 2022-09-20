<?php 
ob_start();
include('class/Course.php');
if(!empty($_SESSION["adminUserid"])) {	
	header("location: dashboard.php"); 	
}
$student = new Course();
$errorMessage =  $student->createstudent();
$student->updatestudent();

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
                <h4 class="heading"><strong>Create </strong> Student <span></span></h4>
                <div class="form">
                <form action="" method="post" id="contactFrm" name="contactFrm">
                    <input type="text" required="" placeholder="Please student Name" value="" name="name" class="txt">
                   
                     <input type="submit" value="submit" name="submitstudent" class="txt2">
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
      <th scope="col">Qualification</th>
      <th scope="col" colspan="2">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php echo $student->studentlist(); ?>
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
      
          <input type="hidden" name="student" id="teacherid" class="form-control">
           <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
    
  </div>
</div>
<script type="text/javascript">
	
	$(document).on('click', '.delete', function(){
		var studentid = $(this).attr("id");		
		var action = "deletestudent";
		if(confirm("Are you sure you want to delete this Teacher?")) {
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{studentid:studentid, action:action},
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
			
			 
		var studentid = $(this).attr("id");
		var action = 'getStudent';
		$.ajax({
			url:'action.php',
			method:"POST",
			data:{studentid:studentid, action:action},
			dataType:"json",
			success:function(data){
				$('#exampleModal').modal('show');
				$('#name').val(data.name);
				$('#teacherid').val(data.id);				
				$('.modal-title').html("<i class='fa fa-plus'></i> Edit Class");
				$('#action').val('updateClass');
				$('#exampleModal').modal('show');
				$('#save').val('Save');
			}
		})
	});	
</script>
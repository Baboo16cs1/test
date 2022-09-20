<?php
session_start();
require('config.php');
class Course extends Dbconfig {	
    protected $hostName;
    protected $userName;
    protected $password;
	protected $dbName;
	private $teacherTable = 'teachers';
	private $studentTable = 'student';
	private $subjectTable = 'subject';
	private $course_enrollmentTable = 'course_enrollment';
	// private $teacherTable = 'sms_teacher';
	// private $subjectsTable = 'sms_subjects';
	// private $attendanceTable = 'sms_attendance';
	private $dbConnect = false;
    public function __construct(){
        if(!$this->dbConnect){ 		
			$database = new dbConfig();            
            $this -> hostName = $database -> serverName;
            $this -> userName = $database -> userName;
            $this -> password = $database ->password;
			$this -> dbName = $database -> dbName;			
            $conn = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            } else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
//===========================================Teacher===============================//
public function createteacher () {
		if(!empty($_POST["submitteacher"])) {
			$insertQuery = "INSERT INTO ".$this->teacherTable."(name,qualification) 
				VALUES ('".$_POST["name"]."','".$_POST["quali"]."')";
			$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}

	public function teacherlist(){		
		$sqlQuery = "SELECT * FROM ".$this->teacherTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$classHTML = '';
		while( $class = mysqli_fetch_assoc($result)) {
			$classHTML .= ' <tr><th scope="row">'.$class['name'].'</th>
					      <td>'.$class['qualification'].'</td>
					      <td><a class="delete" id="'.$class['id'].'">delete</a></td>
					      <td><a class="editmodal" id="'.$class['id'].'">Edit</a></td>
					    </tr>';	
		}
		return $classHTML;
	}



public function deleteteacher(){
		if($_POST["teacherid"]) {
			$sqlUpdate = "
				DELETE FROM ".$this->teacherTable."
				WHERE id = '".$_POST["teacherid"]."'";		
			mysqli_query($this->dbConnect, $sqlUpdate);		
		}
	}


public function getTeacher(){
		$sqlQuery = "SELECT *
			FROM ".$this->teacherTable." WHERE id = '".$_POST["classid"]."'";		
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
	}
public function updateTeacher() {
		if(!empty($_POST['teacherid'])) {	
			// print_r($_POST);
			// exit;
			$updateQuery = "UPDATE ".$this->teacherTable." 
			SET name = '".$_POST["name"]."', qualification = '".$_POST["qualification"]."'
			WHERE id ='".$_POST["teacherid"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
	}
//======================================================Student=====================================//
	public function createstudent () {
		if(!empty($_POST["submitstudent"])) {
			$insertQuery = "INSERT INTO ".$this->studentTable."(name) 
				VALUES ('".$_POST["name"]."')";
			$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}

	public function studentlist(){		
		$sqlQuery = "SELECT * FROM ".$this->studentTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$classHTML = '';
		while( $class = mysqli_fetch_assoc($result)) {
			$classHTML .= ' <tr><th scope="row">'.$class['name'].'</th>
					      <td><a class="delete" id="'.$class['id'].'">delete</a></td>
					      <td><a class="editmodal" id="'.$class['id'].'">Edit</a></td>
					    </tr>';	
		}
		return $classHTML;
	}
 function deletestuden(){
 	if($_POST["studentid"]) {
			$sqlUpdate = "
				DELETE FROM ".$this->studentTable."
				WHERE id = '".$_POST["studentid"]."'";		
			mysqli_query($this->dbConnect, $sqlUpdate);		
		}
 }
 public function getStudent()
 {
     $sqlQuery = "SELECT *
			FROM ".$this->studentTable." WHERE id = '".$_POST["studentid"]."'";		
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
 }
function updatestudent(){
	if(!empty($_POST['student'])) {	
			// print_r($_POST);
			// exit;
			$updateQuery = "UPDATE ".$this->studentTable." 
			SET name = '".$_POST["name"]."'
			WHERE id ='".$_POST["student"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
}







//======================================================subject=====================================//
	public function createcourse () {
		if(!empty($_POST["submitcourse"])) {
			$insertQuery = "INSERT INTO ".$this->subjectTable."(subjectname,code) 
				VALUES ('".$_POST["subjectname"]."','".$_POST["code"]."')";
			$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}

	public function subjectlist(){		
		$sqlQuery = "SELECT * FROM ".$this->subjectTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$classHTML = '';
		while( $class = mysqli_fetch_assoc($result)) {
			$classHTML .= ' <tr><td>'.$class['subjectname'].'</td><td >'.$class['code'].'</td>
					      <td><a class="delete" id="'.$class['id'].'">delete</a></td>
					      <td><a class="editmodal" id="'.$class['id'].'">Edit</a></td>
					      <td><a class="Enrolment" id="'.$class['id'].'">Enrolment</a></td>
					    </tr>';	
		}
		return $classHTML;
	}
 function deleteSubject(){
 	if($_POST["deleteSubject"]) {
			$sqlUpdate = "
				DELETE FROM ".$this->subjectTable."
				WHERE id = '".$_POST["deleteSubject"]."'";		
			mysqli_query($this->dbConnect, $sqlUpdate);		
		}
 }
 public function getSubject()
 {
     $sqlQuery = "SELECT *
			FROM ".$this->subjectTable." WHERE id = '".$_POST["getSubject"]."'";		
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		echo json_encode($row);
 }
function updatecourse(){
	if(!empty($_POST['subject'])) {	
			// print_r($_POST);
			// exit;
			$updateQuery = "UPDATE ".$this->subjectTable." 
			SET subjectname = '".$_POST["name"]."',code = '".$_POST["code"]."'
			WHERE id ='".$_POST["subject"]."'";
			$isUpdated = mysqli_query($this->dbConnect, $updateQuery);		
		}	
}

	public function getTeacherList(){		
		$sqlQuery = "SELECT * FROM ".$this->teacherTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$teacherHTML = '';
		while( $teacher = mysqli_fetch_assoc($result)) {
			$teacherHTML .= '<option value="'.$teacher["id"].'">'.$teacher["name"].'</option>';	
		}
		return $teacherHTML;
	}

	public function getstudentList(){		
		$sqlQuery = "SELECT * FROM ".$this->studentTable;	
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$teacherHTML = '';
		while( $teacher = mysqli_fetch_assoc($result)) {
			$teacherHTML .= '<option value="'.$teacher["id"].'">'.$teacher["name"].'</option>';	
		}
		return $teacherHTML;
	}

	public function addenrolment()
	{
		if(!empty($_POST['enrolment'])){
		$insertQuery = "INSERT INTO ".$this->course_enrollmentTable."(student_id,teacher_id,course_id) 
				VALUES ('".$_POST["studentid"]."','".$_POST["teacherid"]."','".$_POST["coursidd"]."')";
			$userSaved = mysqli_query($this->dbConnect, $insertQuery);
		}
	}

	function enrolment(){
		$sqlQuery="SELECT ce.*, s.*, t.name as tname, std.name as stname
			FROM course_enrollment as ce
			INNER JOIN  teachers as t ON t.id = ce.teacher_id
			INNER JOIN student as std ON std.id = ce.student_id 
            INNER JOIN subject as s ON s.id= ce.course_id";


            $result = mysqli_query($this->dbConnect, $sqlQuery);	
		$classHTML = '';
		while( $class = mysqli_fetch_assoc($result)) {
			$classHTML .= ' <tr><th scope="row">'.$class['subjectname'].'</th>
					      <td>'.$class['code'].'</td>
					      <td>'.$class['tname'].'</td>
					       <td>'.$class['stname'].'</td>
					    </tr>';	
		}
		return $classHTML;
	}

	




	

}
?>
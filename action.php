<?php
include('class/Course.php');
$course = new Course();

if(!empty($_POST['action']) && $_POST['action'] == 'deleteteacher') {
	$course->deleteteacher();
}

if(!empty($_POST['action']) && $_POST['action'] == 'gettecher') {
	$course->getTeacher();
	// $school->getClassesDetails();
}


if(!empty($_POST['action']) && $_POST['action'] == 'deletestudent') {
	$course->deletestuden();
	// $school->getClassesDetails();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getStudent') {
	$course->getStudent();
	// $school->getClassesDetails();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteSubject') {
	$course->deleteSubject();
	// $school->getClassesDetails();
}


if(!empty($_POST['action']) && $_POST['action'] == 'getSubject') {
	$course->getSubject();

	// $school->getClassesDetails();
}



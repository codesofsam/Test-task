<?php 
session_start();
include("function.class.php");

$db = new Functions();

//for get teachers lists
$getListteacher = $db->getTeachers("*","isDelete=0","name ASC");


//for get class lists
$getListclass = $db->getClasses("*","isDelete=0","name ASC");

//for enrollstudents (here id will be dynamic)
$rows = array(
            "name"          => "Student A",
            "class_id"      => "1",
            "teacher_id"    => "1",
        );

$last_id = $db->studentEnroll($rows);

//for unenrollstudents (here id will be dynamic)
$wh = "id=1 AND class_id=1 AND teacher_id=1";
$db->studentunEnroll($wh);
?>
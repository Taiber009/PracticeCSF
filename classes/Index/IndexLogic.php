<?php

include "./../Core/Logics.php";

$logic = new Logics();
$logic->Connect();

if(isset($_POST['indexLogic'])) {
    switch ($_POST['indexLogic']){
        case 'getCourses':
            $arr = $logic->GetCourses();
            echo json_encode($arr);
            break;
		case 'getSubjects': 
		    $course = $_POST['arguments'][0];
		    $group = $_POST['arguments'][1];
            $arr = $logic->GetSubjects1($course,$group);
            echo json_encode($arr);
            break;
		case 'getStudents':
		    $course = $_POST['arguments'][0];
		    $group = $_POST['arguments'][1];
            $arr = $logic->GetStudents($course,$group);
            echo json_encode($arr);
            break;
        case 'getGroups':
            $course = $_POST['arguments'][0];
            $arr = $logic->GetGroups($course);
            echo json_encode($arr);
            break;
        default:
            echo 'Не нашел определения для '.$_POST['indexLogic'].'!';
            break;
    }

}
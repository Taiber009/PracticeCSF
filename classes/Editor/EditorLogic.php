<?php

include "./../Core/Logics.php";

$logic = new Logics();
$logic->Connect();

if(isset($_POST['editorLogic'])) {
    switch ($_POST['editorLogic']){
        case 'getCourses':
            $arr = $logic->GetCourses();
            echo json_encode($arr);
            break;
        case 'getGroups':
            $course = $_POST['arguments'][0]; //1 -> 0!!!
            $arr = $logic->GetGroups($course);
            echo json_encode($arr);
            break;
        case 'getSubjects':
            $arr = $logic->GetSubjects();
            echo json_encode($arr);
            break;
        case 'save':
            $group = $_POST['arguments'][0];
            $course = $_POST['arguments'][1];
            $subj = $_POST['arguments'][2];
            $arr = $logic->SetSchedule($group, $course, $subj);
            echo json_encode($arr);
            break;
        case 'delete':
            $group = $_POST['arguments'][0];
            $course = $_POST['arguments'][1];
            $subj = $_POST['arguments'][2];
            $arr = $logic->DeleteSchedule($group, $course, $subj);
            echo json_encode($arr);
            break;
        default:
            echo 'Не нашел определения для '.$_POST['editorLogic'].'!';
            break;
    }

}
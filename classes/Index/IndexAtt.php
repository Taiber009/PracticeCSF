<?php

include "./../Core/Logics.php";

$logic = new Logics();
$logic->Connect();

$group = null;
$course = null;
$subj = null;
$stud = null;
$mark = null;

$group = $_POST['arguments'][0];
$course = $_POST['arguments'][1];
$subj = $_POST['arguments'][2];
$stud = $_POST['arguments'][3];
$mark = $_POST['arguments'][4];


if(isset($_POST['indexAtt'])) {
    switch ($_POST['indexAtt']){
        case 'Att1':
            $arr = $logic->ChangeAtt1($group, $course, $subj, $stud, $mark);
            echo json_encode($arr);
            break;
        case 'Att2':
            $arr = $logic->ChangeAtt2($group, $course, $subj, $stud, $mark);
            echo json_encode($arr);
            break;
        case 'Att3':
            $arr = $logic->ChangeAtt3($group, $course, $subj, $stud, $mark);
            echo json_encode($arr);
            break;
        case 'Itog':
            $arr = $logic->ChangeItog($group, $course, $subj, $stud, $mark);
            echo json_encode($arr);
            break;
        default:
            echo 'Не нашел определения для '.$_POST['indexAtt'].'!';
            break;
    }

}
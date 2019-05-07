<?php

include "./../Core/Logics.php";

$logic = new Logics();
$logic->Connect();
if( !isset($_POST['studentsLogic']) ) { $aResult['error'] = 'No function name!'; }

if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

if( !isset($aResult['error']) ) {
    switch ($_POST['studentsLogic']){
        case 'add':
            $newStudents = $_POST['arguments'][0];
            $co = $_POST['arguments'][1];
            $gr = $_POST['arguments'][2];
            $logic->AddStudents($newStudents, $co, $gr);
            echo "Добавил студента";
            break;
        case 'change':
            $oldStudents = $_POST['arguments'][0];
            $newStudents = $_POST['arguments'][1];
            $co = $_POST['arguments'][2];
            $gr = $_POST['arguments'][3];
            $logic->ChangeStudents($oldStudents, $newStudents, $co, $gr);
            echo "Изменил студента";
            break;
        case 'delete':
            $oldStudents = $_POST['arguments'][0];
            $co = $_POST['arguments'][1];
            $gr = $_POST['arguments'][2];
            $logic->DeleteStudents($oldStudents, $co, $gr);
            echo "Удалил студента";
            break;
        default:
            echo 'Не нашел определения для '.$_POST['studentsLogic'].'!';
            break;
    }

}
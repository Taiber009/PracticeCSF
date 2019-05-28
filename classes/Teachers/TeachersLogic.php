<?php

include "./../Core/Logics.php";

$logic = new Logics();
$logic->Connect();
//if( !isset($_POST['teacherLogic']) ) { $aResult['error'] = 'No function name!'; }
//if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

if(isset($_POST['teachersLogic'])) {
    switch ($_POST['teachersLogic']){
        case 'add':
		if (!preg_match("/^[a-zA-Z0-9]+$/",$_POST['arguments'][0]))
        {

            $err[] = "Логин может состоять только из букв английского алфавита и цифр";
            foreach($err AS $error)
            {
                echo $error."<br>";
            }
        }
		else
		if(strlen($_POST['arguments'][0]) < 3 or strlen($_POST['arguments'][0]) > 30)
        {
            $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
            foreach($err AS $error)
            {
                echo $error."<br>";
            }
        }
		else
		{
            $login = $_POST['arguments'][0];
            $pass = md5(md5(trim($_POST['arguments'][1])));
			echo $login;
			echo $pass;
            $logic->AddTeacher($login, $pass);
            echo "Добавил учителя";
		}
            break;
        /*case 'change':
            $oldStudents = $_POST['arguments'][0];
            $newStudents = $_POST['arguments'][1];
            $co = $_POST['arguments'][2];
            $gr = $_POST['arguments'][3];
            $logic->ChangeStudents($oldStudents, $newStudents, $co, $gr);
            echo "Изменил студента";
            break;*/
        case 'delete':
            $login = $_POST['arguments'][0];
            $logic->DeleteTeacher($login);
            echo "Удалил учителя";
            break;
        default:
            echo 'Не нашел определения для '.$_POST['teacherLogic'].'!';
            break;
		///	
		foreach($err AS $error)
            {
                echo $error."<br>";
            }
    }

}
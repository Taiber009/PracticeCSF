<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
include './../Core/Logics.php';
    $logic = new Logics();
    $logic->Connect();
	$login = $_GET['lo'];
    $password = $_GET['pa'];
	$realpassword = "";
    $arr = $logic->GetTeacher($login);
	foreach ($arr as &$value) 
		{
			$data = $value;
		}
	if($login === "admin" && $data["Password"] === md5(md5($password)))
    {
		echo "<div id=\"Index\">
		<a class=\"button\" id=\"HeaderLink\" href=\"./admindex.html\">Администрирование</a>
		</div>";
    }
    if($data["Password"] === md5(md5($password)))
    {
		echo "<div id=\"Index\">
		<ul>
		<div class=\"Elements\">
		Студент:
		<select id=\"Student\">
		<option value=\"-1\">Не выбрано</option>
		</select>
		</div>
			&nbsp;
			&nbsp;
			&nbsp;
			&nbsp;
		<div class=\"Elements\">
				<input type=\"text\" size=2 id=\"Att1\">
				<button class=\"ButtonInput\" onClick=\"ChangeAtt1()\">Атт1</button>
		</div>
			&nbsp;
			&nbsp;
			&nbsp;
		<div class=\"Elements\">
				<input type=\"text\" size=2 id=\"Att2\">
				<button class=\"ButtonInput\" onClick=\"ChangeAtt2()\">Атт2</button>
		</div>
			&nbsp;
			&nbsp;
			&nbsp;
		<div class=\"Elements\">
				<input type=\"text\" size=2 id=\"Att3\">
				<button class=\"ButtonInput\" onClick=\"ChangeAtt3()\">Атт3</button>
		</div>
			&nbsp;
			&nbsp;
			&nbsp;
		<div class=\"Elements\">
				<input type=\"text\" size=2 id=\"Itog\">
				<button class=\"ButtonInput\" onClick=\"ChangeItog()\">Итог</button>
		</div>
		</ul>
	  </div>";
    }
    else
    {
        echo "<div id=\"Index\"><h4>Вы ввели неправильный логин/пароль</div>";
    }
?>
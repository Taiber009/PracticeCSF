<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
        include './../Core/Logics.php';

        $logic = new Logics();
        $logic->Connect();

        //echo "<table border='1'>";
       // echo "<tr>";
        //    echo "<th>Учители</th>";
       // echo "</tr>";
		
		echo "<table border='1'>";
            echo "<tr>";
                echo "<th colspan=3>Учители</th>";
            echo "</tr>";

            echo "<tr>";
                echo "<th class=\"TimeTD\">Логин</th>";
                //echo "<th class=\"TimeTD\">Пароль</th>";
                //echo "<th class=\"TimeTD\">Хэш (куки)</th>";
            echo "</tr>";
            echo "<tr>";
		
        $arr = $logic->GetTeachers();
        foreach ($arr as &$value) 
		{
            echo "<tr>";
				echo "<td>" . $value["Login"] . "</td>";
				//echo "<td>" . $value["Password"] . "</td>";
				//echo "<td>" . $value["Hash"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>
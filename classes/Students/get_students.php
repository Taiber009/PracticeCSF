<!DOCTYPE html>
<html>
<head>
</head>
<body>
    <?php
        include './../Core/Logics.php';

        $logic = new Logics();
        $logic->Connect();

        echo "<table border='1'>";
        echo "<tr>";
            echo "<th>Студенты</th>";
        echo "</tr>";

         $co = $_GET['co'];
         $gr = $_GET['gr'];
        $arr = $logic->GetStudents($co, $gr);
        foreach ($arr as &$value) 
		{
            echo "<tr>";
                echo "<td>" . $value["Name"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>
<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <?php
        include './../Core/Logics.php';
        $logic = new Logics();
        $logic->Connect();
        $group = null;
        $course = null;
        $subject = null;
		$sched = null;
		
		if(isset($_POST['course']))
            $course = $_POST['course'];
        if(isset($_POST['group']))
            $group = $_POST['group'];
		if(isset($_POST['subj']))
            $subject = $_POST['subj'];
			
        if($group != null && $course != null && $subject != null)
             $sched = $logic->GetScheduleAdmin1($group, $course, $subject);
        else if ($course != null && $subject != null)
            $sched = $logic->GetScheduleAdmin2($course, $subject);
        else if ($course != null && $group != null)
            $sched = $logic->GetScheduleAdmin5($group,$course);
        else if ($course != null)
            $sched = $logic->GetScheduleAdmin3($course);
        else if ($subject != null)
            $sched = $logic->GetScheduleAdmin4($subject);
        else
            $sched = $logic->GetScheduleAdminFull();

        echo "<table border='1' id=\"Schedule\">";
            echo "<tr>";
                echo "<th colspan=3>Список занятий</th>";
            echo "</tr>";

            echo "<tr>";
                echo "<th class=\"TimeTD\">Курс</th>";
                echo "<th class=\"TimeTD\">Группа</th>";
                echo "<th class=\"TimeTD\">Предмет</th>";
            echo "</tr>";
            echo "<tr>";
            
            if($sched != null)
            {
			  {
                $rows = count($sched);
                for ($i = 0 ; $i < $rows ; ++$i)
                {
                   $row = $sched[$i];
                   echo "<tr>";
                   for ($j = 0 ; $j < 3 ; ++$j) echo "<td>$row[$j]</td>";
                   echo "</tr>";
                }
              }
            }
            echo "</tr>";
        echo "</table>";
        ?>
    </body>
</html>
                
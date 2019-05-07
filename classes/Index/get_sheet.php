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

        $course = $_POST['course'];
        if(isset($_POST['group']))
            $group = $_POST['group'];
		if(isset($_POST['subj']))
            $subject = $_POST['subj'];

        if($group != null && $course != null && $subject != null)
		{
          $sched = $logic->GetSchedule($group, $course, $subject);
          echo "<table border='1' id=\"Schedule\">";
          echo "<tr>";
          echo "<th colspan='5' >Ведомость ";
		  echo $subject;
		  echo " (группа ";
		  echo $group;
		  echo " курс ";
		  echo $course;
		  echo ")</th>";
          echo "</tr>";
  
          echo "<tr>";
          echo "<th class=\"TimeTD\">Студент</th>";
          echo "<th class=\"TimeTD\">Атт1</th>";
          echo "<th class=\"TimeTD\">Атт2</th>";
          echo "<th class=\"TimeTD\">Атт3</th>";
          echo "<th class=\"TimeTD\">Итог</th>";
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
                   for ($j = 0 ; $j < 5 ; ++$j) echo "<td>$row[$j]</td>";
                   echo "</tr>";
                }
              }
            }
          echo "</tr>";
          echo "</table>";
		}
		?>
    </body>
</html>
                
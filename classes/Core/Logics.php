<?php

include 'Connector.php';

class Logics
{
    var $connector;
    function Connect(){
        $this->connector = new Connector('mysql:host=localhost;dbname=hoziev_yu_g;charset=utf8', 'hoziev_yu_g', 'Password');
    }

    function GetStudents($co, $gr){
        $arr = $this->connector->getData("SELECT s.Name FROM Students s where s.ID_Groups = (SELECT ID from Groups g where g.ID_Course = (Select ID from Course c where c.Number = ?) AND g.Name = ?) order by s.Name", array($co, $gr));
        return $arr;
    }

    function AddStudents($newStudent,$co, $gr){
        $this->connector->saveData("INSERT INTO Students (Name,ID_Groups) VALUES (?,(SELECT ID from Groups g where g.ID_Course = (Select ID from Course c where c.Number = ?) AND g.Name = ?))", array($newStudent,$co, $gr));
    }

    function DeleteStudents($oldStudents,$co, $gr){
        $this->connector->saveData("DELETE FROM Students WHERE Name = ? and ID_Groups = (SELECT ID from Groups g where g.ID_Course = (Select ID from Course c where c.Number = ?) AND g.Name = ?)", array($oldStudents,$co, $gr));
    }

    function ChangeStudents($oldStudents, $newStudents,$co, $gr){
        $this->connector->saveData("UPDATE Students S SET S.Name = ? WHERE S.Name = ? AND S.ID_Groups = (SELECT ID from Groups G where G.ID_Course = (Select ID from Course C where C.Number = ?) AND G.Name = ?)", array($newStudents, $oldStudents,$co, $gr));
    }

    function GetSubjects(){
        $arr = $this->connector->getData("SELECT * FROM Subject order by Name", null);
        return $arr;
    }
	
	function GetSubjects1($course, $group){//только для 1 группы
        $arr = $this->connector->getData("SELECT DISTINCT U.Name FROM Course CO, Groups G, Subject U, Lesson L, Students S WHERE 
		CO.Number=? AND CO.ID=G.ID_Course AND G.Name=? AND G.ID=S.ID_Groups AND S.ID=L.ID_Students AND L.ID_Subject=U.ID ORDER BY U.Name"
		, array($course,$group));
		return $arr;
    }

    function AddSubject($newsubject){
        $this->connector->saveData("INSERT INTO Subject (Name) VALUES (?)", array($newsubject));
    }

    function DeleteSubject($oldsubject){
        $this->connector->saveData("DELETE FROM Subject WHERE Name = ?", array($oldsubject));
    }

    function ChangeSubject($oldsubject, $newsubject){
        $this->connector->saveData("UPDATE Subject SET Name = ? WHERE Name = ?", array($newsubject, $oldsubject));
    }

    function GetCourses(){
        $arr = $this->connector->getData("SELECT Number FROM Course order by Number", null);
        return $arr;
    }

    function AddCourse($newcourse){
        $this->connector->saveData("INSERT INTO Course (Number) VALUES (?)", array($newcourse));
    }

    function DeleteCourse($oldcourse){
        $this->connector->saveData("DELETE FROM Course WHERE Number = ?", array($oldcourse));
    }

    function ChangeCourse($oldcourse, $newcourse){
        $this->connector->saveData("UPDATE Course SET Number = ? WHERE Number = ?", array($newcourse, $oldcourse));
    }
	
    function GetGroups($course){
        $arr = $this->connector->getData("SELECT * FROM Groups g WHERE g.ID_Course = (SELECT ID FROM Course c WHERE c.Number = ?  order by g.Name)", array($course));
        return $arr;
    }
    
    function GetGroup($group, $course){  // Чтобы было полное описание группы
        $arr = $this->connector->getData("SELECT * FROM Groups WHERE Name = ? AND ID_Course = (SELECT ID FROM Course c WHERE c.Number = ?)  order by g.Name", array($group, $course));
        return $arr;
    }

    function AddGroup($course, $newgroup){
        $this->connector->saveData("INSERT INTO Groups (Name, ID_Course) VALUES (?, (SELECT ID FROM Course c WHERE c.Number = ?))", array($newgroup, $course));
    }

    function DeleteGroup($course, $oldgroup){
        $this->connector->saveData("DELETE FROM Groups WHERE Name = ? AND ID_Course = (SELECT ID FROM Course c WHERE c.Number = ?)", array($oldgroup, $course));
    }

    function ChangeGroup($course, $oldgroup, $newgroup){
        $this->connector->saveData("UPDATE Groups SET Name = ? WHERE Name = ? AND ID_Course = (SELECT ID FROM Course c WHERE c.Number = ?)", array($newgroup, $oldgroup, $course));
    }

    function ClearAll(){
        $this->connector->saveData("DELETE FROM Lesson WHERE 1", null);
        $this->connector->saveData("DELETE FROM Subject WHERE 1", null);
        $this->connector->saveData("DELETE FROM Students WHERE 1", null);
        $this->connector->saveData("DELETE FROM Groups WHERE 1", null);
        $this->connector->saveData("DELETE FROM Course WHERE 1", null);
    }


    function GetStudentsByID($studentsid){
        $arr = $this->connector->getData("SELECT * FROM Students WHERE ID = ?", array($studentsid));
        return $arr;
    }

    function GetIDByStudents($students){
        $arr = $this->connector->getData("SELECT ID FROM Students WHERE Name = ?", array($students));
        return $arr;
    }

    function GetIDByDay($day){
        $arr = $this->connector->getData("SELECT ID FROM Day WHERE Name = ?", array($day));
        return $arr;
    }

    function GetSubjectByID($subjid){
        $arr = $this->connector->getData("SELECT * FROM Subject WHERE ID = ?", array($subjid));
        return $arr;
    }

    function GetIDByGroup($group){
        $arr = $this->connector->getData("SELECT ID FROM Groups WHERE Name = ?", array($group));
        return $arr;
    }

    function GetIDBySubject($subj){
        $arr = $this->connector->getData("SELECT ID FROM Subject WHERE Name = ?", array($subj));
        return $arr;
    }

    function GetIDByTimeplace($start, $stop, $oddity){
        $arr = $this->connector->getData("SELECT ID FROM Timeplace WHERE Start = ? AND Stop = ? AND Odd = ?", array($start, $stop, $oddity));
        return $arr;
    }

    function TakeSchedule(){
        $arr = $this->connector->getData("SELECT * FROM Lesson WHERE 1", null);
        return $arr;
    }

    function GetScheduleAdminFull()
    {
        $arr = $this->connector->getData("SELECT DISTINCT CO.Number, G.Name, U.Name FROM Course CO, Groups G, Subject U, Lesson L, Students S WHERE 
		CO.ID=G.ID_Course AND G.ID=S.ID_Groups AND S.ID=L.ID_Students AND L.ID_Subject=U.ID"
		, array());
        return $arr;
    }

    function GetScheduleAdmin1($group, $course, $subj)
    {
        $arr = $this->connector->getData("SELECT DISTINCT CO.Number, G.Name, U.Name FROM Course CO, Groups G, Subject U, Lesson L, Students S WHERE 
		CO.Number=? AND CO.ID=G.ID_Course AND G.Name=? AND G.ID=S.ID_Groups AND S.ID=L.ID_Students AND L.ID_Subject=U.ID AND U.Name=? order by G.Name"
		, array($course, $group, $subj));
        return $arr;
    }

    function GetScheduleAdmin2($course, $subj)
    {
        $arr = $this->connector->getData("SELECT DISTINCT CO.Number, G.Name, U.Name FROM Course CO, Groups G, Subject U, Lesson L, Students S WHERE 
		CO.Number=? AND CO.ID=G.ID_Course AND G.ID=S.ID_Groups AND S.ID=L.ID_Students AND L.ID_Subject=U.ID AND U.Name=? order by G.Name"
		, array($course, $subj));
        return $arr;
    }

    function GetScheduleAdmin3($course)
    {
        $arr = $this->connector->getData("SELECT DISTINCT CO.Number, G.Name, U.Name FROM Course CO, Groups G, Subject U, Lesson L, Students S WHERE 
		CO.Number=? AND CO.ID=G.ID_Course AND G.ID=S.ID_Groups AND S.ID=L.ID_Students AND L.ID_Subject=U.ID order by G.Name"
		, array($course));
        return $arr;
    }

    function GetScheduleAdmin4($subj)
    {
        $arr = $this->connector->getData("SELECT DISTINCT CO.Number, G.Name, U.Name FROM Course CO, Groups G, Subject U, Lesson L, Students S WHERE 
		CO.ID=G.ID_Course AND G.ID=S.ID_Groups AND S.ID=L.ID_Students AND L.ID_Subject=U.ID AND U.Name=? order by G.Name"
		, array($subj));
        return $arr;
    }
	
	function GetScheduleAdmin5($group, $course)
    {
        $arr = $this->connector->getData("SELECT DISTINCT CO.Number, G.Name, U.Name FROM Course CO, Groups G, Subject U, Lesson L, Students S WHERE 
		CO.Number=? AND CO.ID=G.ID_Course AND G.Name=? AND G.ID=S.ID_Groups AND S.ID=L.ID_Students AND L.ID_Subject=U.ID order by G.Name"
		, array($course, $group));
        return $arr;
    }

    function GetSchedule($group, $course, $subj)
    {
	    $arr = $this->connector->getData("SELECT DISTINCT S.Name, L.Att1, L.Att2, L.Att3, L.Itog FROM Course CO, Groups G, Subject U, Lesson L, Students S WHERE 
		CO.Number=? AND CO.ID=G.ID_Course AND G.Name=? AND G.ID=S.ID_Groups AND S.ID=L.ID_Students AND L.ID_Subject=U.ID AND U.Name=? order by S.Name"
		, array($course, $group, $subj));
		return $arr;
    }

    function ChangeAtt1($group, $course, $subj, $stud, $mark)
    {
        $this->connector->saveData("UPDATE Lesson L Set Att1 = ? where L.ID_Students = (Select ID from Students S where S.Name = ? and S.ID_Groups = 
                                            (Select ID from Groups G where G.Name=? and G.ID_Course=
                                            (Select ID from Course CO where CO.Number=?))) 
                                    and L.ID_Subject=(Select ID from Subject U where U.Name =?) ", array($mark,$stud,$group, $course, $subj));
        return array($group, $course, $subj, $stud, $mark);
    }
    function ChangeAtt2($group, $course, $subj, $stud, $mark)
    {
        $this->connector->saveData("UPDATE Lesson L Set Att2 = ? where L.ID_Students = (Select ID from Students S where S.Name = ? and S.ID_Groups = 
                                            (Select ID from Groups G where G.Name=? and G.ID_Course=
                                            (Select ID from Course CO where CO.Number=?))) 
                                    and L.ID_Subject=(Select ID from Subject U where U.Name =?) ", array($mark,$stud,$group, $course, $subj));
        return array($group, $course, $subj, $stud, $mark);
    }
    function ChangeAtt3($group, $course, $subj, $stud, $mark)
    {
        $this->connector->saveData("UPDATE Lesson L Set Att3 = ? where L.ID_Students = (Select ID from Students S where S.Name = ? and S.ID_Groups = 
                                            (Select ID from Groups G where G.Name=? and G.ID_Course=
                                            (Select ID from Course CO where CO.Number=?))) 
                                    and L.ID_Subject=(Select ID from Subject U where U.Name =?) ", array($mark,$stud,$group, $course, $subj));
        return array($group, $course, $subj, $stud, $mark);
    }
    function ChangeItog($group, $course, $subj, $stud, $mark)
    {
        $this->connector->saveData("UPDATE Lesson L Set Itog = ? where L.ID_Students = (Select ID from Students S where S.Name = ? and S.ID_Groups = 
                                            (Select ID from Groups G where G.Name=? and G.ID_Course=
                                            (Select ID from Course CO where CO.Number=?))) 
                                    and L.ID_Subject=(Select ID from Subject U where U.Name =?) ", array($mark,$stud,$group, $course, $subj));
        return array($group, $course, $subj, $stud, $mark);
    }

    function SetSchedule($group, $course, $subj)
    {
	    $students = $this->connector->getData("Select ID from Students s where s.ID_Groups = 
        (Select ID from Groups g where g.Name=? and g.ID_Course=(Select ID from Course Co where Co.Number=?))", array($group, $course));
		foreach ($students as &$stud){
           $this->connector->saveData("INSERT INTO Lesson (ID_Students, ID_Subject) VALUES (?,(Select ID from Subject u where u.Name=?))", array($stud['ID'], $subj));
		}
        return array($group, $course, $subj);
    }

    function DeleteSchedule($group, $course, $subj)
    {
	    $students = $this->GetStudents($course,$group);
		foreach ($students as &$stud){
        $this->connector->saveData("Delete from Lesson where ID_Students=?
        AND ID_Subject=(Select ID from Subject u where u.Name=?)", array($stud, $subj));
		}
        return array($group, $course, $subj);
    }
    
    /*function ChangeSchedule($timeid, $day, $group, $room, $subject)
    {
        $dday = $this->GetIDByDay($day)[0]['ID'];
        $droom = $this->GetIDByRoom($room)[0]['ID'];
        $dsubject = $this->GetIDBySubject($subject)[0]['ID'];

        $this->connector->saveData("UPDATE Lesson SET ID_Room = ?, ID_Subject = ? WHERE ID_Timeplace = ? AND ID_Day = ? AND ID_Group = ?", array($droom, $dsubject, $timeid, $dday, $group));
        return array($timeid, $dday, $group, $droom, $dsubject);
    }*/

    
    
}
$(document).ready ( function(){
    showCourses();
})

var subject;
var course;
var group;

function showCourses() {        
     $.post(
         "./classes/Index/IndexLogic.php",
     {
         indexLogic: "getCourses",
         arguments: []
     },
     function (obj){
         var sel = document.getElementById("Course");
         while (sel.length > 1) {
             sel.remove(sel.length-1);
         }
         console.log(obj);
         var myobj = JSON.parse(obj);
         for(var i = 0; i < myobj.length; i++) {
             var opt = document.createElement('option');
             opt.innerHTML = myobj[i]['Number'];
             opt.value = myobj[i]['Number'];
             sel.appendChild(opt);
         }
     }
     );
}

function onAjaxSuccess(obj){
        console.log(obj);
        ReloadTable();
}

function SelectCourse() {   
    course = document.getElementById("Course")[document.getElementById("Course").selectedIndex].value;
    
     $.post(
         "./classes/Index/IndexLogic.php",
     {
         indexLogic: "getGroups",
         arguments: [course]
     },
     function (obj){
         var sel = document.getElementById("Group");
         while (sel.length > 1) {
             sel.remove(sel.length-1);
         }
         console.log(obj);
         var myobj = JSON.parse(obj);
         for(var i = 0; i < myobj.length; i++) {
             var opt = document.createElement('option');
             opt.innerHTML = myobj[i]['Name'];
             opt.value = myobj[i]['Name'];
             sel.appendChild(opt);
         }
     }
     );
}

function SelectGroup()
{
  course = document.getElementById("Course")[document.getElementById("Course").selectedIndex].value;
  group = document.getElementById("Group")[document.getElementById("Group").selectedIndex].value;
  
  showStudents();
  showSubjects();
}

function showSubjects() {        
     $.post(
         "./classes/Index/IndexLogic.php",
     {
         indexLogic: "getSubjects",
         arguments: [course,group]
     },
     function (obj){
         var sel = document.getElementById("Subject");
         while (sel.length > 1) {
             sel.remove(sel.length-1);
         }
         console.log(obj);
         var myobj = JSON.parse(obj);
         for(var i = 0; i < myobj.length; i++) {
             var opt = document.createElement('option');
             opt.innerHTML = myobj[i]['Name'];
             opt.value = myobj[i]['Name'];
             sel.appendChild(opt);
         }
     }
     );
}
function showStudents(){
     $.post(
         "./classes/Index/IndexLogic.php",
     {
         indexLogic: "getStudents",
         arguments: [course,group]
     },
     function (obj){
         var sel = document.getElementById("Student");
         while (sel.length > 1) {
             sel.remove(sel.length-1);
         }
         console.log(obj);
         var myobj = JSON.parse(obj);
         for(var i = 0; i < myobj.length; i++) {
             var opt = document.createElement('option');
             opt.innerHTML = myobj[i]['Name'];
             opt.value = myobj[i]['Name'];
             sel.appendChild(opt);
         }
     }
     );
}
//$group, $course, $subj, $stud, $mark
function ChangeAtt1(){

    course = document.getElementById("Course")[document.getElementById("Course").selectedIndex].value;
    group = document.getElementById("Group")[document.getElementById("Group").selectedIndex].value;
    subject = document.getElementById("Subject")[document.getElementById("Subject").selectedIndex].value;
    var student = document.getElementById("Student")[document.getElementById("Student").selectedIndex].value;
    var mark = document.getElementById("Att1").value;
    
    $.post(
        "./classes/Index/IndexAtt.php",
        {
            indexAtt: "Att1",
            arguments: [group, course, subject, student, mark]
        },onAjaxSuccess
    );

    document.getElementById("Att1").value = "";
}

function ChangeAtt2(){

    course = document.getElementById("Course")[document.getElementById("Course").selectedIndex].value;
    group = document.getElementById("Group")[document.getElementById("Group").selectedIndex].value;
    subject = document.getElementById("Subject")[document.getElementById("Subject").selectedIndex].value;
    var student = document.getElementById("Student")[document.getElementById("Student").selectedIndex].value;
    var mark = document.getElementById("Att2").value;

    $.post(
        "./classes/Index/IndexAtt.php",
        {
            indexAtt: "Att2",
            arguments: [group, course, subject, student, mark]
        },onAjaxSuccess
    );

    document.getElementById("Att2").value = "";
}

function ChangeAtt3(){

    course = document.getElementById("Course")[document.getElementById("Course").selectedIndex].value;
    group = document.getElementById("Group")[document.getElementById("Group").selectedIndex].value;
    subject = document.getElementById("Subject")[document.getElementById("Subject").selectedIndex].value;
    var student = document.getElementById("Student")[document.getElementById("Student").selectedIndex].value;
    var mark = document.getElementById("Att3").value;

    $.post(
        "./classes/Index/IndexAtt.php",
        {
            indexAtt: "Att3",
            arguments: [group, course, subject, student, mark]
        },onAjaxSuccess
    );

    document.getElementById("Att3").value = "";
}

function ChangeItog(){

    course = document.getElementById("Course")[document.getElementById("Course").selectedIndex].value;
    group = document.getElementById("Group")[document.getElementById("Group").selectedIndex].value;
    subject = document.getElementById("Subject")[document.getElementById("Subject").selectedIndex].value;
    var student = document.getElementById("Student")[document.getElementById("Student").selectedIndex].value;
    var mark = document.getElementById("Itog").value;

    $.post(
        "./classes/Index/IndexAtt.php",
        {
            indexAtt: "Itog",
            arguments: [group, course, subject, student, mark]
        },onAjaxSuccess
    );

    document.getElementById("Itog").value = "";
}

function ReloadTable(){
    course = document.getElementById("Course")[document.getElementById("Course").selectedIndex].value;
    group = document.getElementById("Group")[document.getElementById("Group").selectedIndex].value;
    subject = document.getElementById("Subject")[document.getElementById("Subject").selectedIndex].value;
    if(course != -1 && group != -1 && subject != -1)
	{
        FillCourseDay(course, group,subject);
	}
    else
        document.getElementById("TableDiv").innerHTML = "";
}


function FillCourseDay(course,group,subject){
   if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
			document.getElementById("TableDiv").innerHTML = null;
                document.getElementById("TableDiv").innerHTML = this.responseText;
                this.responseText = "";
            }
        };
        xmlhttp.open("POST","./classes/Index/get_sheet.php", true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
        var body = 'course=' + encodeURIComponent(course)
        + '&group=' + encodeURIComponent(group)
        + '&subj=' + encodeURIComponent(subject);
    
    
        xmlhttp.send(body);
}
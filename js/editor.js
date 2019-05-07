$(document).ready ( function(){
    showCourses();
    showSubjects();
	ReloadTable();
});

var subj;
var course;
var group;

function showCourses() {        
     $.post(
         "./../../classes/Editor/EditorLogic.php",
     {
         editorLogic: "getCourses",
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


function showSubjects(){
    $.post(
         "./../../classes/Editor/EditorLogic.php",
     {
         editorLogic: "getSubjects",
         arguments: []
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



function SelectCourse() {   
    course = document.getElementById("Course")[document.getElementById("Course").selectedIndex].value;
    
     $.post(
         "./../../classes/Editor/EditorLogic.php",
     {
         editorLogic: "getGroups",
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
    ReloadTable();
}


function ReloadTable(){
    course = document.getElementById("Course")[document.getElementById("Course").selectedIndex].value;
    group = document.getElementById("Group")[document.getElementById("Group").selectedIndex].value;
    subj = document.getElementById("Subject")[document.getElementById("Subject").selectedIndex].value;
        FillCourseDay(group, course, subj);
}

function redraw(trd) {
    clearDraw();
    $(trd).css('background', '#ffb934');
    
}

function clearDraw(){
    $("td").each(function() {$(this).css('background', 'white');})
}


function tdclick(ttime, tgrp, tsubj, troom){
    time = ttime;
    group = tgrp;
    subj = tsubj;
    room = troom;
    if(subj != undefined)
        document.getElementById("Subject").value = subj;
    else
        document.getElementById("Subject").value = -1;
    if(room != undefined)
        document.getElementById("Room").value = room;
    else
        document.getElementById("Room").value = -1;
}

function SetSubject(){
    subj = document.getElementById("Subject")[document.getElementById("Subject").selectedIndex].value
}

function saveSubject(){
    $.post(
         "./../../classes/Editor/EditorLogic.php",
     {
         editorLogic: "save",
         arguments: [
             group,
             course,
             subj
         ]
     },
     function (obj){
         console.log(obj);
         ReloadTable();
     });
}

/*function changeSubject(){
    $.post(
         "./../../classes/Editor/EditorLogic.php",
     {
         editorLogic: "change",
         arguments: [
             group,
             course,
             subj
         ]
     },
     function (obj){
         console.log(obj);
         ReloadTable();
     });
}*/

function deleteSubject(){
    $.post(
         "./../../classes/Editor/EditorLogic.php",
     {
         editorLogic: "delete",
         arguments: [
             group,
             course,
             subj
         ]
     },
     function (obj){
         console.log(obj);
         ReloadTable();
     });
}


function FillCourseDay(group, course, subj){
   if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("TableDiv").innerHTML = this.responseText;
                this.responseText = "";
            }
        };
        xmlhttp.open("POST","./../../classes/Editor/get_schedule.php", true);
        xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		var body='';//если что не будет работать, восстановить
		if(course != -1)
		     body = 'course=' + encodeURIComponent(course)+ '&';
        if(group != -1)
            body += 'group=' + encodeURIComponent(group)+ '&';
        if(subj != -1)
            body += 'subj=' + encodeURIComponent(subj)+ '&';
    
    
        xmlhttp.send(body);
}



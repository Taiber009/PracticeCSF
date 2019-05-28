function showTeachers() {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Table").innerHTML = this.responseText;
            }
        };

        xmlhttp.open("GET","./../../classes/Teachers/get_teachers.php",true);
        xmlhttp.send();
    
}


function onAjaxSuccess(obj){
        showTeachers();
        console.log(obj);
}

function addTeachers(){
	var login = document.getElementsByName("AddLogin")[0].value;
	var pass = document.getElementsByName("AddPass")[0].value;
	
    $.post(
        "./../../classes/Teachers/TeachersLogic.php",
        {
            teachersLogic: "add",
            arguments: [login,pass]
        },
        onAjaxSuccess
    );
	document.getElementsByName("AddLogin")[0].value = "";
	document.getElementsByName("AddPass")[0].value = "";
}


/*function changeStudents(){
    var oldStudents = document.getElementsByName("OldName")[0].value;
    var newStudents = document.getElementsByName("NewName")[0].value;

    var co = document.getElementsByName("MyCourse")[0].value;
    var gr = document.getElementsByName("MyGroups")[0].value;
    
    $.post(
        "./../../classes/Students/StudentsLogic.php",
        {
            studentsLogic: "change",
            arguments: [oldStudents, newStudents,co,gr]
        },
        onAjaxSuccess
    );
    
    document.getElementsByName("OldName")[0].value = "";
    document.getElementsByName("NewName")[0].value = "";
}*/

function deleteTeachers(){
	var login = document.getElementsByName("DeleteLogin")[0].value;
	
    $.post(
        "./../../classes/Teachers/TeachersLogic.php",
        {
            teachersLogic: "delete",
            arguments: [login]
        },
        onAjaxSuccess
    );
	document.getElementsByName("DeleteLogin")[0].value = "";
}




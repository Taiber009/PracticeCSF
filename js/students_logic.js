function showStudents() {
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

        var co = document.getElementsByName("MyCourse")[0].value;
        var gr = document.getElementsByName("MyGroups")[0].value;

        xmlhttp.open("GET","./../../classes/Students/get_students.php?co="+ co+"&gr="+ gr,true);
        xmlhttp.send();
    
}
/*
function showStudents() {
    var co = document.getElementsByName("MyCourse")[0].value;
    var gr = document.getElementsByName("MyGroups")[0].value;
    $.post(
        "./../../classes/Students/get_students.php",
        {
            arguments: [co,gr]
        },
        function (obj){
            var sel = document.getElementById("Table");
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
}*/
//проверить, get_students.php чуть изменено


function onAjaxSuccess(obj){
        showStudents();
        console.log(obj);
}

function addStudents(){
    var newStudents = document.getElementsByName("AddName")[0].value;

    var co = document.getElementsByName("MyCourse")[0].value;
    var gr = document.getElementsByName("MyGroups")[0].value;
    $.post(
        "./../../classes/Students/StudentsLogic.php",
        {
            studentsLogic: "add",
            arguments: [newStudents,co,gr]
        },
        onAjaxSuccess
    );
    document.getElementsByName("AddName")[0].value = "";
}


function changeStudents(){
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
}

function deleteStudents(){
    var oldStudents = document.getElementsByName("DeleteName")[0].value;

    var co = document.getElementsByName("MyCourse")[0].value;
    var gr = document.getElementsByName("MyGroups")[0].value;
    
    $.post(
        "./../../classes/Students/StudentsLogic.php",
        {
            studentsLogic: "delete",
            arguments: [oldStudents,co,gr]
        },
        onAjaxSuccess
    );
    document.getElementsByName("DeleteName")[0].value = "";
}
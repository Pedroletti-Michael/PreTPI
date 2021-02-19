flag = 0;
val = "Windows";
var today = new Date();
var flag = 1;

function Sidebar() {
    if(flag == 1){
        document.getElementById("SideBar").style.width = "0px";
        flag = 0;
    }else if(flag == 0){
        document.getElementById("SideBar").style.width = "200px";
        flag = 1;
    }
}


// ------------------- w3schools -------------------------
function openRightMenu() {
    document.getElementById("rightMenu").style.display = "block";
}

function closeRightMenu() {
    document.getElementById("rightMenu").style.display = "none";
}

function openLeftMenu() {
    if (flag == 0){
        document.getElementById("leftMenu").style.width = "200px";
        for(var i = 1 ; i < 19 ; i++){
            document.getElementById('hidden_'+i).style.display = "inline";
        }
        document.getElementsByClassName("bi")
        flag = 1;
    }else{
        document.getElementById("leftMenu").style.width = "52px";
        for(var e = 1 ; e < 19 ; e++){
            document.getElementById('hidden_' + e).style.display = "none";
        }
        flag = 0;
    }
}

function openPhoneMenu() {
    document.getElementById("phoneMenu").style.display = "block";
    document.getElementById("buttonOpen").style.display = "none";
    document.getElementById("buttonClose").style.display = "block";
}

function closePhoneMenu() {
    document.getElementById("phoneMenu").style.display = "none";
    document.getElementById("buttonOpen").style.display = "block";
    document.getElementById("buttonClose").style.display = "none";
}
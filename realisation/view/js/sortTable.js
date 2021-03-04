// These function (sortTable and sortNumberTable) can only be used in table with id == tableInventoryVm
function sortTable(n, whichTable) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0, last_n;

    if(whichTable === 'global'){
        table = document.getElementById("globalListTable");
    }
    else if(whichTable === 'visit'){
        table = document.getElementById("visitListTable");
    }
    else if(whichTable === 'counterInspection'){
        table = document.getElementById("counterInspectionListTable");
    }
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount ++;
        } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
    numberOfClick(n,dir);
}

// Same function as sortTable but for number
function sortNumberTable(n, whichTable) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    if(whichTable === 'global'){
        table = document.getElementById("globalListTable");
    }
    else if(whichTable === 'visit'){
        table = document.getElementById("visitListTable");
    }
    else if(whichTable === 'counterInspection'){
        table = document.getElementById("counterInspectionListTable");
    }
    switching = true;
    //Set the sorting direction to ascending:
    dir = "asc";
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];
            /*check if the two rows should switch place,
            based on the direction, asc or desc:*/
            if (dir == "asc") {
                if (Number(x.innerHTML) > Number(y.innerHTML)) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            } else if (dir == "desc") {
                if (Number(x.innerHTML) < Number(y.innerHTML)) {
                    //if so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            //Each time a switch is done, increase this count by 1:
            switchcount ++;
        } else {
            /*If no switching has been done AND the direction is "asc",
            set the direction to "desc" and run the while loop again.*/
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
    numberOfClick(n,dir);
}

// Count number of click
function numberOfClick(n,dir){
    for (var i = 1; i < 5; i++){
        if(i == n){
            if(dir == "asc"){
                document.getElementById(n + "_none_all").style.display = "none";
                document.getElementById(n + "_up_all").style.display = "none";
                document.getElementById(n + "_down_all").style.display = "inline";
            }
            if(dir == "desc"){
                document.getElementById(n + "_none_all").style.display = "none";
                document.getElementById(n + "_down_all").style.display = "none";
                document.getElementById(n + "_up_all").style.display = "inline";
            }
        }else{
            document.getElementById(i + "_none_all").style.display = "inline";
            document.getElementById(i + "_up_all").style.display = "none";
            document.getElementById(i + "_down_all").style.display = "none";
        }
    }
}
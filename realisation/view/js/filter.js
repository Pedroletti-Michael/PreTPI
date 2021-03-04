function filterByName(valueName, whichRow, whichList) {
    var input, filter, table, tr, td, i, txtValue;
    input = valueName;
    filter = input.toUpperCase();

    //get the good table for get the good tr
    if(whichList === "global"){
        table = document.getElementById("globalListTable");
    }
    else if(whichList === "visit"){
        table = document.getElementById("visitListTable");
    }
    else if(whichList === "counterInspection"){
        table = document.getElementById("counterInspectionListTable");
    }

    tr = table.getElementsByTagName("tr");
    if (whichRow !== 0){
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[whichRow];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    else{
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[whichRow];
            if (td) {
                txtValue = td.style.backgroundColor;
                if (txtValue.toUpperCase() === filter){
                    tr[i].style.display = "";
                }
                else if(filter === 'ALL'){
                    tr[i].style.display = "";
                }
                else{
                    tr[i].style.display = "none";
                }
            }
        }
    }

}
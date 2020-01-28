function addRow_band(tableID, flrprefix) 
{
    //var turl = document.getElementById('temp_url').value;
    var table_band = document.getElementById(tableID);
    var rowCount_band = table_band.rows.length;
    var row_band = table_band.insertRow(rowCount_band);
    
  
    
    var cell1 = row_band.insertCell(0);
    var element1 = document.createElement("label");//element1.for = "cat_order";
    element1.innerHTML="Seasons";
    cell1.appendChild(element1);

    var cell2 =row_band.insertCell(1);
    var element2 = document.createElement("span");
    element2.innerHTML="<input type='text' name='"+flrprefix+"_villa_season[]' value='' id='"+flrprefix+"_villa_season[]' style=\"width:170px;\" />";
    cell2.appendChild(element2);  
    
    var cell3 = row_band.insertCell(2);
    var element3 = document.createElement("label");//element1.for = "cat_order";
    element3.innerHTML="Villa Rate";
    cell3.appendChild(element3);
    
    var cell4 =row_band.insertCell(3);
    var element4 = document.createElement("span");
    element4.innerHTML="<input type='text' name='"+flrprefix+"_villa_rate_def[]' value='' id='"+flrprefix+"_villa_rate_def[]' style=\"width:170px;\" />";
    cell4.appendChild(element4);

    var cell5 = row_band.insertCell(4);
    var element5 = document.createElement("label");//element1.for = "cat_order";
    element5.innerHTML="Start Date";
    cell5.appendChild(element5);
    

    var cell6 =row_band.insertCell(5);
    var element6 = document.createElement("span");
   element6.innerHTML="<input type='date' name='"+flrprefix+"_villa_start_date[]' value='' id='"+flrprefix+"_villa_start_date[]' style=\"width:170px;\" />";
    cell6.appendChild(element6);


    var cell7 = row_band.insertCell(6);
    var element7 = document.createElement("label");//element1.for = "cat_order";
    element7.innerHTML="End Date";
    cell7.appendChild(element7);
    

var cell8 =row_band.insertCell(7);
    var element8 = document.createElement("span");
   element8.innerHTML="<input type='date' name='"+flrprefix+"_villa_end_date' value='' id='"+flrprefix+"_villa_end_date[]' style=\"width:170px;\" />";
    cell8.appendChild(element8);
    

    var cell9 =row_band.insertCell(8);
    var element9 = document.createElement("span");
    element9.innerHTML="<a href=\"javascript:void(0)\" class=\"button\" onclick=\"deleteCurrentRow_band(this)\" style=\"margin-left:5px;\"> - </a>";
    cell9.appendChild(element9);
}
function thisRow(obj) 
{
    var tr1 = obj;
    while ( tr1 && tr1.nodeName != 'TR' ){    tr1 = tr1.parentNode;   }
    return tr1;
}

function deleteCurrentRow_band(obj)
{   
    var delRow = thisRow(obj);
    var tbl = delRow.parentNode.parentNode;
    var rIndex = delRow.sectionRowIndex;
    var rowArray = new Array(delRow);
    deleteRows_band(rowArray);              
}

function deleteRows_band(rowObjArray)
{
    for (var i=0; i<rowObjArray.length; i++) 
    {
        var rIndex = rowObjArray[i].sectionRowIndex;
        rowObjArray[i].parentNode.deleteRow(rIndex);
    }
}

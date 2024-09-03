function zapiszDost(id){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           //document.getElementById("dost").innerHTML = this.responseText
        }
        };
        xmlhttp.open("GET","dost.php?id="+id,true);
        xmlhttp.send();
}


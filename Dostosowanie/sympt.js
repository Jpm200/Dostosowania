function symptomy(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("sympt").innerHTML = this.responseText;
    }
    };
    
    xmlhttp.open("GET","sympt.php?id="+id,true);
    xmlhttp.send();
}
function Wyczysc(){
    document.getElementById("sympt").innerHTML = "";
}
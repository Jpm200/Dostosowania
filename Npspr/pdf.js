function pdf(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        window.onload = function(){
            window.open("Koniec.html");
            window.open("testpdf.php", "_blank"); 
            
        }
    }
    };
    
    uwagi = document.getElementById("uwagi").innerHTML;
    xmlhttp.open("GET","testpdf.php?uwagi="+uwagi,true);
    xmlhttp.send();
}

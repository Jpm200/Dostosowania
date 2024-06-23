function usunZapis(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById(id).remove();
        alert("Zapis został usunięty");
    }
    };
    if (confirm('Czy chcesz usunąc zapis?')) {
        xmlhttp.open("GET","zapisy.php?id="+id,true);
        xmlhttp.send();
    }
}

function wczytajZapis(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location.href = 'testpdf.php';
        }
    };
        xmlhttp.open("GET","zapisy.php?id2="+id,true);
        xmlhttp.send();
   
}
function edytujZapis(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        window.location.href = 'Dostosowania.php';
    }
    };
        xmlhttp.open("GET","zapisy.php?id3="+id,true);
        xmlhttp.send();
   
}
function wczytajZapisArch(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        window.location.href = 'testpdf.php';
        // window.onload = function(){
        //     window.open("Koniec.html");
        //     window.open("testpdf.php", "_blank"); 
        // }
    }
    };
        xmlhttp.open("GET","zapisy.php?id4="+id,true);
        xmlhttp.send();
   
}
function przywroc(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        window.location.reload(true);
        alert("Zapis został przywrócony");
    }
    };
    if (confirm('Czy chcesz przywrócić zapis?')) {
        xmlhttp.open("GET","zapisy.php?id5="+id,true);
        xmlhttp.send();
    }
   
}
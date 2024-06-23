function promujWszystkich(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        window.location.reload(true);
        alert("Wszyscy uczniowie zostali promowani do następnej klasy!");
    }
    };
    if (confirm('Czy napewno chcesz promować wszytskich uczniów?')) {
        xmlhttp.open("GET","promocja.php",true);
        xmlhttp.send();
    }

}
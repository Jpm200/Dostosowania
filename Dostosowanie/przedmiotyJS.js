
    function przedmiotyfunc(przedm){
        if (przedm == "") {
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("przedm").innerHTML = document.getElementById("przedm").innerHTML + this.responseText;
                document.getElementById('przedmiot').value = '';
            }
            };
            xmlhttp.open("GET","przedmioty.php?p="+przedm,true);
            xmlhttp.send();
        }
    }
    function usunPrzedmiot(przedm){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(przedm).remove();
            document.getElementById('przedmiot').value = '';
        }
        };
        xmlhttp.open("GET","przedmioty.php?q="+przedm,true);
        xmlhttp.send();
    }

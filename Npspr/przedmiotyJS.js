
    function przedmiotyfunc(przedm){
        if (przedm == "") {
            // if(isset($_SESSION['przedmiot_id'])){
            //     if($_SESSION['przedmiot_id'] == ""){
            //         document.getElementById("przedm").innerHTML = "Prosze wybrać co najmnej jeden przedmiot!";
            //     }
            // }
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("przedm").innerHTML = document.getElementById("przedm").innerHTML + this.responseText;
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
        }
        };
        xmlhttp.open("GET","przedmioty.php?q="+przedm,true);
        xmlhttp.send();
    }

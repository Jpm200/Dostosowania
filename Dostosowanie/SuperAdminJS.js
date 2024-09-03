function sprawdzRole(a){
    if(a !='superadmin'){
        window.location.replace("Logowanie.php");
    }
}
function dodajUczen(){
    if(document.forms["dodaj"]["imie"].value != "" || document.forms["dodaj"]["nazwisko"].value != "" ){
        if (confirm('Czy napewno chcesz dodać ucznia?')) {
            let formData = new FormData(document.getElementById('dodaj')); 
                $.ajax({ 
                    url: 'UczenSA.php', 
                    method: 'POST', 
                    data: formData, 
                    processData: false, 
                    contentType: false, 
                    success: function () {                       
                        alert('Dodano ucznia!'); 
                    }, 
                    error: function (error) {                        
                        alert('Coś poszło nie tak!'); 
                        console.error(error); 
                    } 
                }); 
            }
    }else{
        alert("Prosze uzupełnić wszystkie dane!");
    }
}
function usunUczen(id){
        if (confirm('Czy napewno chcesz usunąć ucznia?')) {
                $.ajax({ 
                    url: 'UczenSA.php', 
                    method: 'POST', 
                    data: { idusun: id }, 
                    success: function () {                    
                        alert('Usunięto ucznia!'); 
                    }, 
                    error: function (error) {                        
                        alert('Coś poszło nie tak!'); 
                        console.error(error); 
                    } 
                }); 
            }
}
function zapiszUczen(id){
        if (confirm('Czy napewno chcesz edytować ucznia?')) {
            let formData = new FormData(document.getElementById(id)); 
            formData.append('Zapisz', 1);
                $.ajax({ 
                    url: 'UczenSA.php', 
                    method: 'POST', 
                    data: formData, 
                    processData: false, 
                    contentType: false, 
                    success: function () {                       
                        alert('Zedytowano ucznia!'); 
                    }, 
                    error: function (error) {                        
                        alert('Coś poszło nie tak!'); 
                        console.error(error); 
                    } 
                }); 
            }
}
function promuj(id){
    if (confirm('Czy napewno chcesz promować ucznia?')) {
        let formData = new FormData(document.getElementById(id)); 
        formData.append('promocja', 1);
            $.ajax({ 
                url: 'UczenSA.php', 
                method: 'POST', 
                data: formData, 
                processData: false, 
                contentType: false, 
                success: function () {                       
                    alert('Dokonano promocji ucznia ucznia!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
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
function dodajDost(){
    if(document.forms["dodaj"]["text"].value != ""){
        if (confirm('Czy napewno chcesz dodać dostosowanie?')) {
            let formData = new FormData(document.getElementById('dodaj')); 
                $.ajax({ 
                    url: 'DostSA.php', 
                    method: 'POST', 
                    data: formData, 
                    processData: false, 
                    contentType: false, 
                    success: function () {                       
                        alert('Dodano dostosowanie!'); 
                    }, 
                    error: function (error) {                        
                        alert('Coś poszło nie tak!'); 
                        console.error(error); 
                    } 
                }); 
            }
    }else{
        alert("Prosze uzupełnić wszystkie dane!");
    }
}
function usunDost(id){
    if (confirm('Czy napewno chcesz usunąć dostosowanie?')) {
            $.ajax({ 
                url: 'DostSA.php', 
                method: 'POST', 
                data: { idusun: id }, 
                success: function () {                    
                    alert('Usunięto dostosowanie!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function zapiszDost(id){
    if (confirm('Czy napewno chcesz edytować dostoswanie?')) {
        let formData = new FormData(document.getElementById(id)); 
            $.ajax({ 
                url: 'DostSA.php', 
                method: 'POST', 
                data: formData, 
                processData: false, 
                contentType: false, 
                success: function () {                       
                    alert('Zedytowano dostosowanie!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function dodajNpspr(){
    if(document.forms["dodaj"]["nazwa"].value != ""){
        if (confirm('Czy napewno chcesz dodać niepełnosprawność?')) {
            let formData = new FormData(document.getElementById('dodaj')); 
                $.ajax({ 
                    url: 'NpsprSA.php', 
                    method: 'POST', 
                    data: formData, 
                    processData: false, 
                    contentType: false, 
                    success: function () {                       
                        alert('Dodano niepełnosprawność!'); 
                    }, 
                    error: function (error) {                        
                        alert('Coś poszło nie tak!'); 
                        console.error(error); 
                    } 
                }); 
            }
    }else{
        alert("Prosze uzupełnić nazwe!");
    }
}
function usunNpspr(id){
    if (confirm('Czy napewno chcesz usunąć niepełnosprawność?')) {
            $.ajax({ 
                url: 'NpsprSA.php', 
                method: 'POST', 
                data: { idusun: id }, 
                success: function () {                    
                    alert('Usunięto niepełnosprawność!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function zapiszNpspr(id){
    if (confirm('Czy napewno chcesz edytować niepełnosprawność?')) {
        let formData = new FormData(document.getElementById(id)); 
            $.ajax({ 
                url: 'NpsprSA.php', 
                method: 'POST', 
                data: formData, 
                processData: false, 
                contentType: false, 
                success: function () {                       
                    alert('Zedytowano niepełnosprawność!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function dodajUser(){
    if(document.forms["dodaj"]["imie"].value != ""||document.forms["dodaj"]["nazwisko"].value != ""||document.forms["dodaj"]["haslo"].value != ""){
        if (confirm('Czy napewno chcesz dodać użytkownika?')) {
            let formData = new FormData(document.getElementById('dodaj')); 
                $.ajax({ 
                    url: 'UserSA.php', 
                    method: 'POST', 
                    data: formData, 
                    processData: false, 
                    contentType: false, 
                    success: function () {                       
                        alert('Dodano użytkownika!'); 
                    }, 
                    error: function (error) {                        
                        alert('Coś poszło nie tak!'); 
                        console.error(error); 
                    } 
                }); 
            }
    }else{
        alert("Prosze uzupełnić nazwe!");
    }
}
function usunUser(id){
    if (confirm('Czy napewno chcesz usunąć użytkownika?')) {
            $.ajax({ 
                url: 'UserSA.php', 
                method: 'POST', 
                data: { idusun: id }, 
                success: function () {                    
                    alert('Usunięto użytkownika!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function zapiszUser(id){
    if (confirm('Czy napewno chcesz edytować użytkownika?')) {
        let formData = new FormData(document.getElementById(id)); 
            $.ajax({ 
                url: 'UserSA.php', 
                method: 'POST', 
                data: formData, 
                processData: false, 
                contentType: false, 
                success: function () {                       
                    alert('Zedytowano użytkownika!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function dodajKlasy(){
        if (confirm('Czy napewno chcesz przypisać klasę do ucznia?')) {
            let formData = new FormData(document.getElementById('dodaj')); 
                $.ajax({ 
                    url: 'KlasySA.php', 
                    method: 'POST', 
                    data: formData, 
                    processData: false, 
                    contentType: false, 
                    success: function () {                       
                        alert('Przypisano klasę do ucznia!'); 
                    }, 
                    error: function (error) {                        
                        alert('Coś poszło nie tak!'); 
                        console.error(error); 
                    } 
                }); 
            }
}
function usunKlasy(id_klasa,id_user){
    if (confirm('Czy napewno chcesz usunąć przypisaną klasę?')) {
            $.ajax({ 
                url: 'KlasySA.php', 
                method: 'POST', 
                data: {klasa: id_klasa,
                    user: id_user , 
                    idusun:"a"}, 
                success: function () {                    
                    alert('Usunięto przypisaną klasę!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function zapiszKlasy(id){
    if (confirm('Czy napewno chcesz edytować przypisaną klasę?')) {
        let formData = new FormData(document.getElementById(id)); 
            $.ajax({ 
                url: 'KlasySA.php', 
                method: 'POST', 
                data: formData, 
                processData: false, 
                contentType: false, 
                success: function () {                       
                    alert('Zedytowano przypisaną klasę!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function dodajKlasa(){
    if(document.forms["dodaj"]["numer"].value != ""){
        if (confirm('Czy napewno chcesz dodać klase?')) {
            let formData = new FormData(document.getElementById('dodaj')); 
                $.ajax({ 
                    url: 'KlasaSA.php', 
                    method: 'POST', 
                    data: formData, 
                    processData: false, 
                    contentType: false, 
                    success: function () {                       
                        alert('Dodano klase!'); 
                    }, 
                    error: function (error) {                        
                        alert('Coś poszło nie tak!'); 
                        console.error(error); 
                    } 
                }); 
            }
    }else{
        alert("Prosze uzupełnić nazwe!");
    }
}
function usunKlasa(id){
    if (confirm('Czy napewno chcesz usunąć klase?')) {
            $.ajax({ 
                url: 'KlasaSA.php', 
                method: 'POST', 
                data: { idusun: id }, 
                success: function () {                    
                    alert('Usunięto klase!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function zapiszKlasa(id){
    if (confirm('Czy napewno chcesz edytować klase?')) {
        let formData = new FormData(document.getElementById(id)); 
            $.ajax({ 
                url: 'KlasaSA.php', 
                method: 'POST', 
                data: formData, 
                processData: false, 
                contentType: false, 
                success: function () {                       
                    alert('Zedytowano klase!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function dodajPrzedm(){
    if(document.forms["dodaj"]["nazwa"].value != ""){
        if (confirm('Czy napewno chcesz dodać przedmiot?')) {
            let formData = new FormData(document.getElementById('dodaj')); 
                $.ajax({ 
                    url: 'PrzedmSA.php', 
                    method: 'POST', 
                    data: formData, 
                    processData: false, 
                    contentType: false, 
                    success: function () {                       
                        alert('Dodano przedmiot!'); 
                    }, 
                    error: function (error) {                        
                        alert('Coś poszło nie tak!'); 
                        console.error(error); 
                    } 
                }); 
            }
    }else{
        alert("Prosze uzupełnić nazwe!");
    }
}
function usunPrzedm(id){
    if (confirm('Czy napewno chcesz usunąć przedmiot?')) {
            $.ajax({ 
                url: 'PrzedmSA.php', 
                method: 'POST', 
                data: { idusun: id }, 
                success: function () {                    
                    alert('Usunięto przedmiot!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function zapiszPrzedm(id){
    if (confirm('Czy napewno chcesz edytować przedmiot?')) {
        let formData = new FormData(document.getElementById(id)); 
            $.ajax({ 
                url: 'PrzedmSA.php', 
                method: 'POST', 
                data: formData, 
                processData: false, 
                contentType: false, 
                success: function () {                       
                    alert('Zedytowano przedmiot!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function dodajSympt(){
    if(document.forms["dodaj"]["tekst"].value != ""){
        if (confirm('Czy napewno chcesz dodać symptom?')) {
            let formData = new FormData(document.getElementById('dodaj')); 
                $.ajax({ 
                    url: 'SymptSA.php', 
                    method: 'POST', 
                    data: formData, 
                    processData: false, 
                    contentType: false, 
                    success: function () {                       
                        alert('Dodano symptom!'); 
                    }, 
                    error: function (error) {                        
                        alert('Coś poszło nie tak!'); 
                        console.error(error); 
                    } 
                }); 
            }
    }else{
        alert("Prosze uzupełnić nazwe!");
    }
}
function usunSympt(id){
    if (confirm('Czy napewno chcesz usunąć symptom?')) {
            $.ajax({ 
                url: 'SymptSA.php', 
                method: 'POST', 
                data: { idusun: id }, 
                success: function () {                    
                    alert('Usunięto symptom!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function zapiszSympt(id){
    if (confirm('Czy napewno chcesz edytować symptom?')) {
        let formData = new FormData(document.getElementById(id)); 
            $.ajax({ 
                url: 'SymptSA.php', 
                method: 'POST', 
                data: formData, 
                processData: false, 
                contentType: false, 
                success: function () {                       
                    alert('Zedytowano symptom!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function refresh(){
    window.location.reload();
}

function dodaj1(){
    if (confirm('Czy napewno chcesz przypisać niepełnosprawność do ucznia?')) {
        let formData = new FormData(document.getElementById('dodaj')); 
            $.ajax({ 
                url: 'AdminJS.php', 
                method: 'POST', 
                data: formData, 
                processData: false, 
                contentType: false, 
                success: function () {                       
                    alert('Przypisano niepełnosprawność do ucznia!'); 
                }, 
                error: function (error) {                        
                    alert('Coś poszło nie tak!'); 
                    console.error(error); 
                } 
            }); 
        }
}
function usun(id_npspr,id_uczen){
if (confirm('Czy napewno chcesz usunąć przypisaną niepełnosprawność?')) {
        $.ajax({ 
            url: 'AdminJS.php', 
            method: 'POST', 
            data: {npspr: id_npspr,
                uczen: id_uczen , 
                idusun:1}, 
            success: function () {                    
                alert('Usunięto przypisaną niepełnosprawność!'); 
            }, 
            error: function (error) {                        
                alert('Coś poszło nie tak!'); 
                console.error(error); 
            } 
        }); 
    }
}
function zapisz(id){
if (confirm('Czy napewno chcesz edytować przypisaną niepełnosprawność?')) {
    let formData = new FormData(document.getElementById(id)); 
        $.ajax({ 
            url: 'AdminJS.php', 
            method: 'POST', 
            data: formData, 
            processData: false, 
            contentType: false, 
            success: function () {                       
                alert('Zedytowano przypisaną niepełnosprawność!'); 
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
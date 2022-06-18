

// Ha karakter módosítás történik a beviteli mezőben, indítunk egy kérést a szervernek benne a keresési kifejezéssel.
document.getElementById('searchField').onkeyup = function() {
    // Keresési kifejezés
    var searchText = document.getElementById('searchField').value;

    // Küldeni kívánt adat előkészítése
    var dataToSend = new FormData();
    dataToSend.append('searchText', searchText);

    // HTTP kérés küldés, benne az adatokkal
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'search.php');
    xhr.send(dataToSend);

    // HTTP kérésre kapott válasz feldolgozása
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            var productsArray = JSON.parse(xhr.responseText);
            // Az adatok megjelenítése DOM manipulációval
            var HTMLContent = '';
            for(var productObject of productsArray) {
                HTMLContent +=
                '<tr>'+
                    '<td>'+productObject.name+'</td>'+
                    '<td>'+productObject.category+'</td>'+
                    '<td>'+productObject.brand+'</td>'+
                    '<td>'+productObject.country+'</td>'+
                    '<td>'+productObject.weight+' g</td>'+
                    '<td>'+productObject.price+' Ft</td>'+
                '</tr>';
            }
            document.getElementById('content').innerHTML = HTMLContent;
        }
    }
}

// Első betöltésnél egyszer fusson le a keresés, hogy megjelenjen minden termék
document.getElementById('searchField').onkeyup();
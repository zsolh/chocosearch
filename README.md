# chocosearch
A weboldalak online használata során a HTTP protokoll szerint a kliens és a szerver számítógép kommunikál.
HTTP protokoll kérések és válaszokból áll.

Szinkronikus kérés
    A kliens elküldi a kérést és megvárja a választ, amikor az megérkezik akkor betölt az egész oldal újra.

Aszinkronikus kérés
    A kliens elküldi a kérést és nem vár a válaszra, az oldal tovább használható.
    Amikor megérkezik a válasz a kliens nem tölti be újra az egész oldalt, hanem DOM manipuláció segítségével elhelyezi a megjeleníteni kívánt adatokat.

Aszinkron kérésnél is van igény annak egyedi feldolgozására. Ehhez egy szerver oldali nyelvet kell használni, pl.: PHP-t.

Kliens oldal
    HTML, CSS, JS
    A szerver tudja, hogy kliens oldali formátumok, a tartalmukat átküldi a kliensnek.
    A kliens böngészője betölti, megjeleníti és futtatja.
    Ezek tehát a kliens oldalon külön példányok, melyek akár megváltozhatnak ott, az eredeti forrásokhoz képest. (pl.: DOM manipuláció)

Szerver oldal
    PHP
    MySQL
    Ezek soha nem kerülnek a kliens oldalra.
    Ezeket a szerver futtatja és ha az általunk szkript kimenetet ad, akkor az elküldi a kliensnek.

Eddig szinkronikus kéréseket dolgoztunk fel PHP-val, azaz a válaszainkat közvetlen a böngésző jelenítette meg. Ezért HTML szintaxissal válaszoltunk.

Aszinkron kérésnél a JavaScript indítja a kérést, és neki van szüksége az adatra, tehát a PHP-nak ezen kérés szerint kell válaszolni.
Csak az adatról van szó, a megejelenítést a JS átveszi, tehát a HTML szintaxis nem lesz jó.

A kérés küldésekor tudunk adatot is helyezni a kérésbe, ezek ugyanúgy lesznek kezelhetőek, mint egy űrlap GET vagy POST kérése.
Ehhez a JS FormData objektumát fogjuk használni.

Szükség van egy message language-re a válaszhoz, pl.: JSON, XML


1. Kliens XMLHttpRequest objektuma kérést indít GET vagy POST metódussal.
2. Ezt szerver oldalon megkapja a PHP szkript. A küldött hozzáfér a GET vagy POST szuperglobális tömbben.
3. A kérés adatait feldolgozza a szkript és generál egy választ.
4. A válasz adatait JSON szintaxissal visszaküldi a kliensnek (Válasz)
5. Ezt megkapja a kliens XMLHttpRequest obejktuma.
6. A kapott adatot feldolgozza a kliens.
7. Az adatokat DOM manipulációval elhelyezi.

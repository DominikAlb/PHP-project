# PROJEKT TECHNIKI INTERNETU - OKNO PW 2020

# README #

Instrukcja dotycząca instalacji strony internetowej

Do zainstalowania aplikacji potrzbne bedą programy: </br>
-[XAMPP w wersji 8.0.0](https://www.apachefriends.org/pl/download.html) </br>
-[PHP w wersji >= 7.4](https://www.php.net/downloads.php)

Projekt można ściągnąć za pomocą komendy: gh repo clone DominikAlb/php-project
lub użyć innych opcji za pomocą przycisku <b>Code</b>

Projekt powinien się znaleźć w katalogu 'xampp\htdocs\php-project'

Dodany został plik phpproject.sql, utworzony za pomocą komendy: </br>
mysqldump -u[nazwa_konta] -p[hasło_do_konta] --databases [nazwa_bazy_danych] > [katalog_docelowy][plik_docelowy].sql

### Informacje o bazie danych ###

Baza danych ustawiona w aplikacji XAMPP: 10.4.17-MariaDB
lolcalhost został zablokowany hasłem: w celu odblokowania 'localhost' należy dodać hasło do pliku config.inc.php pod linią 
'/* Authentication type and info */' </br>
$cfg['Servers'][$i]['password'] = [hasło] </br>

Dane do połączenia strony z bazą danych znajdują się w pliku DBCredentials.php i to samo hasło jest używane w parametrze $cfg['Servers'][$i]['password']


### Strona Główna ###

Program można uruchomić poprzez uruchomienie Apache i MySQL w XAMPP a następnie przejściem do strony [http://localhost/php-project/Main.php](http://localhost/php-project/Main.php)

### Dodatkowe informacje ###

Dodadtkowe informacje z instrukcją obsługi strony znajdują się w pliku pdf.


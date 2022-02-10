## Restowe API z prostym mechanizmem uwierzytelniającym
## API pozwala tworzyć rekordy z unikalnymi imionami i nazwiskami

1. Po pobraniu repozytormium tworzymy plik *.sqlite
2. .env konfigurujemy w następujący sposób <br>
   DB_CONNECTION=sqlite <br>
   DB_DATABASE=/absolute/path/to/database.sqlite
3. wykonujemy migracje poleceniem <span style="color:yellow">php artisan migrate </span>
4. Dodajemy konfigurację Sanctum poleceniem <span style="color:yellow">php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"</span>
5. Uruchamiamy serwer (<span style="color:yellow">php artisan serve</span>)

POST      | api/register <span style="color:orange">[name, email, password]</span> - tworzy użytkownika <br>
POST      | api/login <span style="color:orange">[name, password]</span> - loguje zarejestrowanego użytkownika <br>

Powyższe metody zwracają Beaer Token, którego należy użyć do uwierzytelnienia w pozostałych endpointach. <br>

GET|HEAD  | api/names <span style="color:orange">[no param]</span> - zwraca wszystkie rekordy. <br>
POST      | api/names <span style="color:orange">[firstname, lastname]</span> - tworzy nowy rekord. <br>
GET|HEAD  | api/names/{id} <span style="color:orange">[no param]</span> - wyświetla rekord o zadanym id. <br>
PUT|PATCH | api/names/{id} <span style="color:orange">[firstname, lastname]</span> - modyfikuje rekord o zadanym id. <br>
DELETE    | api/names/{id} <span style="color:orange">[no param]</span> - usuwa rekord o zadanym id. <br>

POST      | api/logout <span style="color:orange">[no param]</span> - wylogowuje użytkownika. <br>

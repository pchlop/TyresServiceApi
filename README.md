## TyresFittingServiceApi

## Zadanie rekrutacyjne
Api udostępnia endpointy, które pozwalają zarządzać serwisem wulkanizacji opon:

W API powinny się znaleźć następujące funkcje:

### Administracyjne
- dodawanie nowego terminu **[<span style="color:yellow">POST</span>][/tyres-service]**
- usuwanie terminu **[<span style="color:red">DELETE</span>][/tyres-service/{id}]**
- wyświetlenie wszystkich terminów **[<span style="color:green">GET</span>][/tyres-service]**
- wyświetlenie pojedynczego terminu **[<span style="color:green">GET</span>][/tyres-service/{id}]**
- wyświetlenie zajętych terminów **[<span style="color:green">GET</span>][/tyres-service-busy]**

### Użytkowe
- wyświetl wolne terminy **[<span style="color:green">GET</span>][/tyres-service-free]**
- zapisz się na wybrany termin **[<span style="color:white">PATCH</span>][/tyres-service/{id}]**
- zapisz się na pierwszy wolny termin **[<span style="color:white">PATCH</span>][/tyres-service-first-free]**
- zwolnij termin **[<span style="color:white">PATCH</span>][/tyres-service-cancel-visit]**

### Korzystanie z API

Endpointy oraz metody ich użycia przedstawiono powyżej. 
Do wysłania zapytań *Administracyjnych* niezbędne jest wysłanie w nagłówku klucza autoryzacyjnego.
Aby wysłać zapytania *Użytkowe* typu **<span style="color:white">PATCH</span>** należy podać w Body zapytania numer rejestracyjny pojazdu ('*registration_plate*'').

### PRZYKŁADY

> **[<span style="color:yellow">POST</span>][/tyres-service]**

`curl --location --request POST 'http://127.0.0.1:8000/api/tyres-service' \
--header 'Accept: application/json' \
--header 'Authorization: API_TOKEN \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'date=2021-11-23' \
--data-urlencode 'time=12:05:00' \
--data-urlencode '='`

> **[<span style="color:red">DELETE</span>][/tyres-service/{id}]**

`curl --location --request DELETE 'http://127.0.0.1:8000/api/tyres-service/18' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer API_TOKEN'`

>**[<span style="color:green">GET</span>][/tyres-service]**

`curl --location --request GET 'http://127.0.0.1:8000/api/tyres-service' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer API_TOKEN'`

>**[<span style="color:green">GET</span>][/tyres-service/{id}]**

`curl --location --request GET 'http://127.0.0.1:8000/api/tyres-service/11' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer API_TOKEN'`

>**[<span style="color:green">GET</span>][/tyres-service-busy]**

`curl --location --request GET 'http://127.0.0.1:8000/api/tyres-service-busy' \
--header 'Accept: application/json' \
--header 'Authorization: Bearer API_TOKEN'`

>**[<span style="color:green">GET</span>][/tyres-service-free]**

`curl --location --request GET 'http://127.0.0.1:8000/api/tyres-service-free' \
--header 'Accept: application/json'`

>**[<span style="color:white">PATCH</span>][/tyres-service/{id}]**

`curl --location --request PATCH 'http://127.0.0.1:8000/api/tyres-service/9' \
--header 'Accept: application/json' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'registration_plate=ABC11119'`

>**[<span style="color:white">PATCH</span>][/tyres-service-first-free]**

`curl --location --request PATCH 'http://127.0.0.1:8000/api/tyres-service-first-free' \
--header 'Accept: application/json' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'registration_plate=ABC11122'`

>**[<span style="color:white">PATCH</span>][/tyres-service-cancel-visit]**

`curl --location --request PATCH 'http://127.0.0.1:8000/api/tyres-service-cancel-visit' \
--header 'Accept: application/json' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'registration_plate=XYZ11114'`

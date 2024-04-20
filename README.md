# Buscador de CEP - Trade Up

<img src="./image.png"
     align="right" alt="Size Limit logo by Vá de Táxi" width="225" height="129">

### Configuração
Para rodar a aplicação basta ter o PHP na versão 8.2 ou superior.
Basta copiar o arquivo .env com os comandos:

Windows:
**`Copy-Item .\.env.example .\.env`**

Ubuntu:
**`cp .env.example .env`**

Rodar o comand **`php artisan key:generate`** para criar uma chave de descriptografia
Rodar o comando **`php artisan serve`** para iniciar a aplicação na porta 8000
Rodar o comando **`php artisan test --testsuite=Feature`** para iniciar os testes.
Não é necessário migration, nem nada respectivo visto que a aplicação é inteiramente voltada para consumir um serviço externo e expor os dados de acordo com uma rota de GET.

### Requisição HTTP
[Coleção Postman](./CEPProvider.postman_collection.json)
A coleção foi feita com Postman, mas basta importar esse arquivo para seu programa de requisições HTTP preferido.

### Variáveis de Ambiente
As variáveis de Ambiente podem ser encontradas [nesse arquivo](./inputENVs.sh) de configuração.
Basta rodar o comando **`sh inputENVs`** de preferencia no terminal **bash**


### Endpoints
```http
GET http://127.0.0.1:8000/api/cep/01512010
```
```json
{
    "data": {
        "title": "01512-010, São Paulo, SP, Brasil",
        "localityType": "postalCode",
        "address": {
            "label": "01512-010, São Paulo, SP, Brasil",
            "countryCode": "BRA",
            "countryName": "Brasil",
            "stateCode": "SP",
            "state": "São Paulo",
            "city": "São Paulo",
            "district": "Sé",
            "postalCode": "01512-010"
        },
        "position": {
            "lat": -23.55329,
            "lng": -46.62877
        },
        "mapView": {
            "west": -46.6299,
            "south": -23.5543,
            "east": -46.62739,
            "north": -23.55267
        }
    }
}
```
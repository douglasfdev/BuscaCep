#!/bin/bash

CONFIG="ENDPOINT=https://geocode.search.hereapi.com/v1\nAPIKEY=be1hHQrytN0izt1ZAfwMHj5NLwdG0AHGBBb13FUjcGk"

if [ -f .env ]; then
    echo "O arquivo .env já existe. Adicionando as chaves de API."
    echo -e "\n$CONFIG" >> .env
else
    echo "Criando um novo arquivo .env e adicionando as chaves de API."
    echo -e "$CONFIG" > .env
fi

echo "Chaves de API adicionadas com sucesso ao arquivo .env."

#Instalação (ambiente linux)

**Instalações prévias**

- php 7.4
- mysql
- composer 2 (recomendado)

**Instalando**

- clone o projeto do repositório github;

- entre na pasta do projeto;

- instale as dependências

```
composer install
```

- crie um arquivo .env usando como base o .env.example

```
cp .env.example .env
```

- crie um banco de dados chamado eagle_care

- edite o arquivo .env e insira as informações do banco de dados em 

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eagle_care
DB_USERNAME=root
DB_PASSWORD=
```

- execute as migrações para criar as tabelas no banco de dados e popular o banco com os dados

```
php artisan migrate --seed
```

- instale as chaves de acesso da aplicação ao banco de dados com o passport

```
php artisan passport:install
```

- crie a chave a aplicação

```
php artisan key:gen
```

- inicie a aplicação 

```
php artisan serve
```
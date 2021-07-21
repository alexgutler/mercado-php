## Desafio Técnico "Mercado PHP"


### Instalação

Clone o projeto com o código abaixo no terminal.

Usamos o **.** no final do comando para ser clonado na pasta atual.

```c
git clone https://github.com/alexgutler/mercado-php .
```

Após colar o projeto, será necessário instalar as dependências do Composer, execute o comando abaixo no terminal:

```php
composer install
```

Agora crie o banco de dados no `PostgreSQL` e faça a configuração da conexão no arquivo:

```php
app\Utils\config.php
```

Importe a estrutura do banco de dados que se encontra no arquivo `database.sql` localizado na raiz do projeto.

Inicie um servidor nativo do PHP a partir do diretório raiz do projeto para subir a aplicação utilizando o seguinte comando no terminal:

```php
php -S localhost:8080
```



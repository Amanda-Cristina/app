 Pizzaria

## Relatório do projeto

[CLIQUE PARA ABRIR O RELATÓRIO DO PROJETO](https://docs.google.com/document/d/1T7GlLZ8GmShC1bqdgOnr8V6-e0NnflBO8NITUfEsmnQ/edit)

## Informações básicas sobre o projeto:

  - A aplicação baseia-se em um ecommerce de pizzas, com diversos produtos, no qual o usuário precisaria se cadastrar para realizar suas compras;  
  - O objetivo é o desenvolvimento de uma API (Web Service) utilizando o [Laravel](https://laravel.com/);
  - O projeto segue o padrão MVC;
  - Foi implementado o CRUD com o modelo ORM do Laravel na parte de controle de cliente e catálogo de pizzas;
  - A verificação do Banco de Dados, MySQL, foi realizada pela interface phpMyAdmin disponibilizada pelo Xampp;
  - O servidor está configurado localmente no endereço 127.0.0.1:8000;
  - Está sendo utilizado o sistema de autenticação [Laravel Sanctum](https://laravel.com/docs/9.x/sanctum). No registro ou no login é gerado um token que permite acesso as rotas seguras. 
  - Para os testes de rotas e funcionalidades da API foi utilizado o cliente HTTP [Postman](https://www.postman.com). 
  

# Configurações


O projeto foi configurado a partir do framework Laravel na versão `v9.18.0`. A instalação foi feita pelo [Composer](https://getcomposer.org/) `version 2.3.5`, utilizando o seguinte comando:

    composer create-project laravel/laravel <nome projeto>

O servidor da API foi configurado de forma local (127.0.0.1:8000) e utilizando o gerenciador MySQL. A comunicação com o banco ocorre pelo modelo ORM disponibilizado pelo Laravel. 

A pasta do projeto `app` foi criada dentro do `htdocs` no repositório do xampp. As configurações do banco devem ser definidas no arquivo `.env`, principalmente o nome do banco, o usuário e a senha. Neste projeto a base está definida como `aulabd`.

Para o sistema de autenticação com token foi configurado o sistema Laravel Sanctum da seguinte forma:

    composer require laravel/sanctum
    php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
    php artisan migrate


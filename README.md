## Objetivo do Sistema

O sistema consiste no gerenciamento de um congresso fictício onde os participantes submetem seus trabalhos e os corretores e editores avaliam e atribuem uma nota.

## Tecnologias Utilizadas:

 - PHP 8.0;
 - Blade (linguagem nativa utilizada no laravel para construção de views);
 - Laravel 9.0;
 - MySQL versão 10.4.6-MariaDB;
 - JavaScript Vanilla (JavaScript puro);
 - Linguagens de marcação como Bootstrap, HTML e CSS;
 - Composer (gerenciador de dependências);
 - npm (gerenciador de pacotes do node js);

## Instalação do projeto

Após o download do projeto ou clone em sua máquina, fazer uma cópia do arquivo ".env.example" e e editar o arquivo copiado para ".env". Em seguida preencher as informações relacionadas ao banco de dados DB_CONNECTION e ao MAIL_MAILER.

Em seguida, executar os seguintes comandos:

 - php artisan key: generate;
 - npm install;
 - composer install;
 - executar simultaneamente os comandos "npm run dev" e "php artisan serve";
 - php artisan migrate: -- seed;

OBS: talvez apareça alguns erros para a execução do projeto, provavelmente advindo do arquivo php.ini, para corrigí-los, encontre o arquivo php.ini e descomente os comandos: 

  - extension=fileinfo;
  - extension=mbstring;
  - extension=openssl;
  - extension==pdo_mysql;


  
 
 


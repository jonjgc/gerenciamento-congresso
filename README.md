## Objetivo do Sistema

O sistema consiste no gerenciamento de um congresso fictício onde os participantes submetem seus trabalhos e os corretores e editores avaliam e atribuem uma nota.

## O sistema está com as seguintes funcionalidades:

  - O Admin pode deletar usuário, editar permissão do usuário, ver a lista de usuários inscritos, adicionar universidades, e ver a lista de universidades cadastradas;
  - Login para inscrição de participantes, Editores e Corretores, sendo que essas permissões são concedidas pelo admin;
  - Os usuários do tipo Corretor e Editor tem as mesmas permissões, onde ao logar no sistema, eles podem visualizar os trabalhos que foram submetidos, avaliar e          atribuir uma nota, e automaticamente vai aparecer a nota atribuída ao participante que submeteu o trabalho;
  - O usuário Participante ao fazer o login, pode anexar o trabalho, bem como tambem pode editar o mesmo antes que seu trabalho seja avaliado pelo editor ou corretor. Tambem pode ver a nota que foi dada para o seu trabalho.

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

 - php artisan key: generate  (informações relacionadas a criptografia)
 - npm install
 - composer install
 - executar simultaneamente os comandos "npm run dev" e "php artisan serve"
 - php artisan migrate: -- seed

OBS: talvez apareça alguns erros para a execução do projeto, provavelmente advindo do arquivo php.ini, para corrigí-los, encontre o arquivo php.ini e descomente os comandos: 

 - extension=fileinfo;
 - extension=mbstring;
 - extension=openssl;
 - extension==pdo_mysql;

## Status do projeto

- O projeto se encontra 90% completo, faltando apenas fazer a veinculação dos participantes à uma Universidade, mas todas as outras funcionalidades estão concluídas como descrito no início deste documento.

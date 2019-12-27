
Após a instalação e configuração do servidor, alterar as configurações do servidor de banco de dados, dos arquivos abaixo:
C:\Apache24\htdocs\PRODFLAVIS\flavis\projeto-php\app\config\parameters.yml  
C:\Apache24\htdocs\PRODFLAVIS\flavis\projeto-php\app\cache\prod\appProdProjectContainer.php		=> Arquivo contendo o endereço do logo do menu
C:\Apache24\htdocs\PRODFLAVIS\flavis\projeto-php\app\cache\dev\appDevDebugProjectContainer.php
C:\Apache24\htdocs\PRODFLAVIS\flavis\projeto-php\app\cache\dev\appDevDebugProjectContainer.xml

Alterado de "postgres.logics.com.br" para "localhost".
Criando e restaurando o banco "flavis_prod".

Após baixar projeto em uma pasta nova do git, esta apresentado o seguinte erro:
Fatal error: Class 'Nelmio\ApiDocBundle\NelmioApiDocBundle' not found in C:\Apache24\htdocs\PRODFLAVIS_teste\flavis\projeto-php\app\AppKernel.php on line 42

=>Valida os requisitos do PHP no servidor
http://localhost/PRODFLAVIS/app/check.php

****************************************************************************************************************

https://prod.flavis.com.br/login

http://localhost:80/PRODFLAVIS/web/app.php/login

http://192.169.40.113:80/PRODFLAVIS/web/app.php/login

usuário: marconi@flavis.com.br
senha: 123456

****************************************************************************************************************

DataSource: PostgreSQL
Host: localhost
Porta: 5432
Database: flavis_prod
User: postgres
Passord: admin




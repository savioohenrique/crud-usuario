<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Crud de usuário utilizando Yii²</h1>
    <br>
</p>

<h2>Importe o projeto</h2>
<p>Importe o projeto na pasta desejada.</p>

<h2>Configure o vhost no servidor</h2>
<p>Para esse projeto, foi utilizado o Xampp.Para adicionar um vhost, edite o arquivo "C:\xampp\apache\conf\extra\httpd-vhosts.conf", no caso do windows, e adicione o seguinte código.</p>

```
<VirtualHost *:80>
    ServerName admin.localhost
    DocumentRoot "C:\xampp\htdocs\_nome_do_projeto_\backend\web"
       
    <Directory "C:\xampp\htdocs\_nome_do_projeto_\backend\web">
        # Utilize o mod_rewrite para suporte a URL amigável
        RewriteEngine on
        # Se um diretório ou arquivo existe, usa a requisição diretamente
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        # Caso contrário, encaminha a requisição para index.php
        RewriteRule . index.php

        # usar index.php com arquivo index
        DirectoryIndex index.php

        # ...outras configurações...
    </Directory>
</VirtualHost>
```

<p>Obs: para esse projeto foi utilizado a o template advanced do framework Yii², normalmente seria necessesário configurar um vhost para o frontend, mas para esse projeto 
foi utilizado apenas o módulo de backend.</p>


<h2>Configure o banco de dados</h2>
<p>Para esse projeto, foi utilizado um banco de dados mysql, caso queira continuar utilizando um banco de dados mysql apenas configure os dados de conexão do banco, 
    nos arquivos "C:\xampp\htdocs\_nome_do_projeto\environments\dev\common\config\main-local.php" para o ambiente de desenvolvimento e "C:\xampp\htdocs\_nome_do_projeto\environments\prod\common\config\main-local.php" para o ambiente de produção.</p>
    
```
'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=_nome_do_banco_de_dados',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
```

<h2>Executando o projeto</h2>

<p>Após ter configurado o vhost e adicionado as informações do banco de dados, podemos colocar o projeto para rodar.</p>

<p>Dentro da pasta do projeto, com o auxílio de um terminal, e certificando-se que o servidor apache já está rodando, digite o comando "php init", selecione entre desenvolvimento e produção e confirme as alterações.</p>

<h2>Acessando a página web</h2>
<p>No browser de sua preferência digite o endereço que foi cadastrado no vhosts, nesse projeto foi utilizado o admin.localhost</p>

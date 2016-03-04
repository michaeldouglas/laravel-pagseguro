---
title: Documentação oficial Laravel PagSeguro
subtitle: Integração com o gateway de pagamento pagseguro. Uma maneira fácil e simples com Laravel
layout: main
---

## Documentação Laravel PagSeguro

Essa é a documentação oficial para a utilização da laravel-pagseguro. Aqui você encontrará todas as informações necessárias para utilizar e até contribuir com o projeto.

## O que preciso para utilizar a laravel-pagseguro ?

A primeira coisa que você precisa é uma conta ativa no PagSeguro, se você ainda não tem acesse <a href="https://pagseguro.uol.com.br" target="_blank">aqui</a>.

Esse cadastro é necessário pois vamos utilizar o token de API, a URL de retorno e algns otros itens para realizar a nossa compra.

A segunda coisa é claro é que você irá precisar ter uma instalação do Laravel >= 5.1. Nos passos seguintes vamos assumir que a nossa instalação do Laravel está em **/var/www/laravel**

## Começando

Vamos então criar o nosso projeto laravel através do composer no diretório **/var/www**. Navegue até esse diretório com o seguinte comando:

```
cd /var/www/
```

Após isso precisamos instalar o laravel e para isso apenas copie e cole o seguinte comando

```
composer create-project --prefer-dist laravel/laravel laravel
```

> Se você não possui o composer ou não sabe o que é acesse https://getcomposer.org/

Aguarde alguns minutos até que a seguinte mensagem seja exibida no seu terminal:

```
Writing lock file
Generating autoload files

> post-install-cmd: php artisan clear-compiled
Executing command (CWD): php artisan clear-compiled

> post-install-cmd: php artisan optimize
Executing command (CWD): php artisan optimize
Generating optimized class loader

> post-create-project-cmd: php artisan key:generate
Executing command (CWD): php artisan key:generate
Application key [41vG4hUX4ZDvi2I2POMjSRUo5KYCeZqf] set successfully.
```

A sua Application key irá ser diferente da nossa, mas não se preocupe pois para cada aplicação o Laravel gera uma.

E você terá uma estrutura como a imagem a baixo

<img src="images/index/estrutura-laravel.png"/>

## Adicionando o laravel-pagseguro

A primeira coisa que vamos fazer é adicionar a dependência do laravel-pagseguro ao composer.json, para isso execute o seguinte comando:

```
composer require michael/laravelpagseguro:1.*
```



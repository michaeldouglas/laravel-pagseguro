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

Se tudo ocorrer conforme o esperado você verá uma saída bem parecida com a seguinte:

```
Loading composer repositories with package information
Updating dependencies (including require-dev)
  - Installing michael/laravelpagseguro (1.0.0)
    Downloading: 100%         

Writing lock file
Generating autoload files
> php artisan optimize
Generating optimized class loader
```

## Criando o [ServiceProvider](https://laravel.com/docs/master/providers)

Agora o que precisamos fazer é simplesmente adicionar o nosso serviço na lista de **service providers** do laravel, e fazemos isso editando o arquivo **config/app.php**

Precisamos adicionar duas linhas nesse arquivo, a primeira deve ser adicionada o valor `laravel\pagseguro\Platform\Laravel5\ServiceProvider::class` no final do array que possui a chave **providers**, veja :

```
'providers' => [
    /*
     * Laravel Framework Service Providers...
     */
    Illuminate\Auth\AuthServiceProvider::class,
    Illuminate\Broadcasting\BroadcastServiceProvider::class,
    Illuminate\Bus\BusServiceProvider::class,
    Illuminate\Cache\CacheServiceProvider::class,
    Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
    Illuminate\Cookie\CookieServiceProvider::class,
    Illuminate\Database\DatabaseServiceProvider::class,
    Illuminate\Encryption\EncryptionServiceProvider::class,
    Illuminate\Filesystem\FilesystemServiceProvider::class,
    Illuminate\Foundation\Providers\FoundationServiceProvider::class,
    Illuminate\Hashing\HashServiceProvider::class,
    Illuminate\Mail\MailServiceProvider::class,
    Illuminate\Pagination\PaginationServiceProvider::class,
    Illuminate\Pipeline\PipelineServiceProvider::class,
    Illuminate\Queue\QueueServiceProvider::class,
    Illuminate\Redis\RedisServiceProvider::class,
    Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
    Illuminate\Session\SessionServiceProvider::class,
    Illuminate\Translation\TranslationServiceProvider::class,
    Illuminate\Validation\ValidationServiceProvider::class,
    Illuminate\View\ViewServiceProvider::class,

    /*
     * Application Service Providers...
     */
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    
    // Adicione essa linha abaixo
    laravel\pagseguro\Platform\Laravel5\ServiceProvider::class,
],
```

E a segunda linha que devemos adicionar é para criar uma **alias** para utilizarmos e dessa vez o valor `'PagSeguro' => laravel\pagseguro\Platform\Laravel5\PagSeguro::class` deve ser adicionado no final do array que possui a chave **aliases**, veja :

```
'aliases' => [

    'App'       => Illuminate\Support\Facades\App::class,
    'Artisan'   => Illuminate\Support\Facades\Artisan::class,
    'Auth'      => Illuminate\Support\Facades\Auth::class,
    'Blade'     => Illuminate\Support\Facades\Blade::class,
    'Cache'     => Illuminate\Support\Facades\Cache::class,
    'Config'    => Illuminate\Support\Facades\Config::class,
    'Cookie'    => Illuminate\Support\Facades\Cookie::class,
    'Crypt'     => Illuminate\Support\Facades\Crypt::class,
    'DB'        => Illuminate\Support\Facades\DB::class,
    'Eloquent'  => Illuminate\Database\Eloquent\Model::class,
    'Event'     => Illuminate\Support\Facades\Event::class,
    'File'      => Illuminate\Support\Facades\File::class,
    'Gate'      => Illuminate\Support\Facades\Gate::class,
    'Hash'      => Illuminate\Support\Facades\Hash::class,
    'Lang'      => Illuminate\Support\Facades\Lang::class,
    'Log'       => Illuminate\Support\Facades\Log::class,
    'Mail'      => Illuminate\Support\Facades\Mail::class,
    'Password'  => Illuminate\Support\Facades\Password::class,
    'Queue'     => Illuminate\Support\Facades\Queue::class,
    'Redirect'  => Illuminate\Support\Facades\Redirect::class,
    'Redis'     => Illuminate\Support\Facades\Redis::class,
    'Request'   => Illuminate\Support\Facades\Request::class,
    'Response'  => Illuminate\Support\Facades\Response::class,
    'Route'     => Illuminate\Support\Facades\Route::class,
    'Schema'    => Illuminate\Support\Facades\Schema::class,
    'Session'   => Illuminate\Support\Facades\Session::class,
    'Storage'   => Illuminate\Support\Facades\Storage::class,
    'URL'       => Illuminate\Support\Facades\URL::class,
    'Validator' => Illuminate\Support\Facades\Validator::class,
    'View'      => Illuminate\Support\Facades\View::class,
    
    // Adicione essa linha abaixo
    'PagSeguro' => laravel\pagseguro\Platform\Laravel5\PagSeguro::class

],
```

Logo em seguida precisamos executar um comando através do artisan para que as configurações bases sejam adicionadas em nossa instalação

```
php artisan vendor:publish
```

Após executar esse comando a seguinte mensagem deve aparecer em seu terminal

```
Copied File [/vendor/michael/laravelpagseguro/src/laravel/pagseguro/Config/laravelpagseguro.php] To [/config/laravelpagseguro.php]
```

E com isso estamos pronto com as configuração mínima para ter o Laravel Pag Seguro, vamos então passar para a parte do Laravel onde definimos algumas configurações bem básicas

## Possíveis problemas

1. `Can't locate path: </var/www/laravel/vendor/michael/laravelpagseguro/src/laravel/pagseguro/Platform/Laravel5/config/laravelpagseguro.php>
`
Esse problema ocorre quando o Laravel Pag Seguro não consegue localizar o arquivo necessário de configuração e move-lo para o destino correto, para corrigir esse erro é muito simples, basta mudar a versão que você utiliza no composer.json.

Recomendamos que utilize a última versão (**dev-master**):

```
composer require michael/laravelpagseguro:dev-master
```
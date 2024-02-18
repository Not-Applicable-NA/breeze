
## 環境構築手順

**WSL2上での環境構築を想定しています。また、Sailを利用するためDockerのインストールも必要です。<br>WSL2とDockerのインストール手順については省略します。**

**リポジトリのクローン**<br>
以下のコマンドで本リポジトリをクローンします。<br>
`git clone https://github.com/Not-Applicable-NA/breeze`<br>
カレントディレクトリを**breeze**に変更します。<br>
`cd breeze`<br>

**Composerのパッケージのインストール**<br>
クローン直後は、vendorフォルダが存在しませんので、以下のコマンドでComposerのパッケージのインストールを行います。<br>
```
docker run --rm \　
    -u "$(id -u):$(id -g)" \　
    -v $(pwd):/var/www/html \　
    -w /var/www/html \　
    laravelsail/php82-composer:latest \　
    composer install --ignore-platform-reqs
```

**.envファイルの作成**<br>
以下のコマンドで.env.exampleをコピーして、.envファイルを作成します。<br>
`cp .env.example .env`<br>
コンテナのMySQLに接続するため、DB_HOSTを次のように変更します。
```
DB_HOST=127.0.0.1
↓
DB_HOST=mysql
```

**APP_KEYの生成**<br>
Sailをバッググランドで起動します。<br>
`./vendor/bin/sail up -d`<br>
以下のコマンドでAPP_KEYを生成します。<br>
`sail artisan key:generate`<br>

**テーブルの作成**<br>
以下のコマンドでテーブルを作成します。<br>
`sail artisan migrate`<br>

**npmパッケージのインストール**<br>
以下のコマンドでnpmパッケージをインストールします。<br>
`sail npm install`<br>

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

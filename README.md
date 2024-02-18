
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
`DB_USERNAME=`、および`DB_PASSWORD=`については、`breeze.zip`の`env.txt`からコピーしてください。<br>

**アプリが使用するGoogleカレンダーのカレンダーIDの取得**<br>
本アプリはGoogleカレンダーAPIを利用します。<br>
APIに使用させたいカレンダーを作成し、そのカレンダーIDを`.env`の`GOOGLE_CALENDAR_ID=`に記入してください。<br>
カレンダーIDは、カレンダーの設定画面から取得できます。詳しい手順については省略します。<br>

**OAuth認証情報とAPIキー設定**<br>
本アプリの利用するGoogleカレンダーAPIでは、OAuth認証とAPIキーの両方が必要です。<br>
まず、`breeze.zip`の`google-calendar`ディレクトリを`storage/app/`内にコピーしてください。<br>
その後、ディレクトリ内の`oauth-credentials.json`を開き、`client_id`と`client_secret`を`.env`の`GOOGLE_CLIENT_ID=`と`GOOGLE_CLIENT_SECRET=`にコピーしてください。<br>
次に、`breeze.zip`の`env.txt`に記載されている`GOOGLE_CALENDAR_API_KEY=`を、`.env`の`GOOGLE_CALENDAR_API_KEY=`にコピーしてください。

**APP_KEYの生成**<br>
Sailをバッググランドで起動します。<br>
`./vendor/bin/sail up -d`<br>
以下のコマンドでAPP_KEYを生成します。<br>
`sail artisan key:generate`<br>

**テーブルの作成**<br>
以下のコマンドでテーブルを作成します。<br>
`sail artisan migrate`<br>
`Nothing to migrate`と返された場合、すでにマイグレーション済みとなっていますが、念のため、`sail artisan migrate:refresh`で作成し直してください。<br>
作成されたテーブルに学部、学科、クラス、学期データを挿入するため、シーディングを行います。<br>
`sail artisan db:seed`<br>

**npmパッケージのインストール**<br>
以下のコマンドでnpmパッケージをインストールします。<br>
`sail npm install`<br>

**viteの起動**<br>
以下のコマンドでviteを起動します。<br>
`sail npm run dev`<br>

**Localhostへアクセス**<br>
[Localhost](http://localhost)へアクセスし、次のようなページが表示されたら構築完了です。
![top-page](images/top-page.png)

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

# Rese

Reseはある企業のグループ会社の飲食店予約サービスです

<img width="1423" alt="shop_all" src="https://github.com/user-attachments/assets/2f1a6797-0c91-41b3-88aa-8a36d41a0435">

## 作成した目的

外部の飲食店予約サービスは手数料を取られるので自社で予約サービスを持ちたい

## アプリケーション URL

- 開発環境：http://localhost/
- phpMyAdmin:：http://localhost:8080/
- MailHog：http://localhost:8025/

## 他のリポジトリ

なし

## 機能一覧

- 会員登録機能
- メール認証機能
- ログイン機能
- ログアウト機能
- ユーザー情報取得機能
- ユーザー飲食店お気に入り一覧取得機能
- ユーザー飲食店予約情報取得機能
- 飲食店一覧取得機能
- 飲食店詳細取得機能
- 飲食店お気に入り追加機能
- 飲食店お気に入り削除機能
- 飲食店予約情報追加機能
- 飲食店予約情報削除機能
- 飲食店予約情報変更機能
- 飲食店予約情報リマインダー機能
- 飲食店評価機能
- QRコード発行機能
- 決済機能
- エリアで検索する機能
- ジャンルで検索する機能
- 店名で検索する機能
- 管理者登録機能
- 管理者ログイン機能
- 管理者ログアウト機能
- 店舗代表者一覧取得機能
- 店舗代表者登録機能
- 店舗代表者ログイン機能
- 店舗代表者ログアウト機能
- 店舗情報作成機能
- 店舗情報更新機能
- 店舗代表者飲食店予約情報取得機能

### 補足説明

- メール認証機能、飲食店予約情報リマインダー機能では、MailHogを使用しています

## 使用技術(実行環境)

- PHP8.3.2
- Laravel8.83.8
- MySQL8.0.26

## テーブル設計

<img width="491" alt="table1" src="https://github.com/user-attachments/assets/cc1b8171-53b7-4e2f-b182-c5a84faa6132">
<img width="492" alt="table2" src="https://github.com/user-attachments/assets/1100cb5f-8d8f-430d-a18a-504e059751b1">

## ER 図

<img width="680" alt="er" src="https://github.com/user-attachments/assets/cd3c4b50-494b-45a7-8c2d-302ea29ec884">

## 環境構築

**Docker ビルド**

1. `git clone git@github.com:Naganuma-Mai/rese.git`
2. DockerDesktop アプリを立ち上げる
3. `docker-compose up -d --build`

> MySQL等は、OSによって起動しない場合があるのでそれぞれのPCに合わせて docker-compose.ymlファイルを編集してください。

**Laravel 環境構築**

1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.env ファイルを作成
4. .env に以下の環境変数を追加

```text
APP_NAME=Rese
```

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

```text
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=test
MAIL_PASSWORD=pass
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=test@example.com
MAIL_FROM_NAME="${APP_NAME}"
```

> 以下のSTRIPE_KEY・STRIPE_SECRETはご自身のものを入力してください。

```text
STRIPE_KEY=****
STRIPE_SECRET=****
```

5. アプリケーションキーの作成

```bash
php artisan key:generate
```

6. マイグレーションの実行

```bash
php artisan migrate
```

7. シーディングの実行

```bash
php artisan db:seed
```

8. シンボリックリンクの作成

```bash
php artisan storage:link
```

9. スケジュールをローカルで実行

```bash
php artisan schedule:work
```
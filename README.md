# 商品管理アプリ（確認テスト）

## 概要

本アプリは、商品の登録・編集・削除・一覧表示を行うことができる商品管理システムです。
Laravelを用いてCRUD機能を実装しています。

---

## 機能一覧

* 商品一覧表示
* 商品検索機能（キーワード検索）
* 商品登録機能
* 商品編集機能
* 商品削除機能
* 商品画像表示機能

---

## 使用技術

* PHP 8.1.12
* Laravel 8.83.27
* MySQL 8.0.34
* HTML / CSS

---

## ER図

![ER図](./docs/er.png)

※ products と seasons は多対多の関係であり、product_seasonテーブルで管理しています。

---

## テーブル構成

### products

* id
* name
* price
* image
* description
* created_at
* updated_at

### seasons

* id
* name

### product_season

* id
* product_id
* season_id

---

## 環境構築

### ① リポジトリをクローン

```bash
git clone <リポジトリURL>
cd red-cat
```

---

### ② 依存関係インストール

```bash
composer install
```

---

### ③ 環境ファイル作成

```bash
cp .env.example .env
```

---

### ④ アプリケーションキー生成

```bash
php artisan key:generate
```

---

### ⑤ データベース設定（.env）

```env
DB_DATABASE=データベース名
DB_USERNAME=ユーザー名
DB_PASSWORD=パスワード
```

---

### ⑥ マイグレーション

```bash
php artisan migrate
```

---

### ⑦ サーバー起動

```bash
php artisan serve
```

---

### ⑧ アクセス

```
http://127.0.0.1:8000
```

---

## 画像について

商品画像は指定された画像素材を使用し、以下のディレクトリに配置しています。

```
public/images/
```

データベースには画像のファイル名のみを保存し、Bladeで以下のように表示しています。

```blade
<img src="{{ asset('images/' . $product->image) }}">
```

---

## 工夫した点

* 商品と季節を多対多で管理し、中間テーブルで柔軟に対応
* 画像はpublicディレクトリで管理し、シンプルに表示
* 新規登録・編集の両方で画像表示ができるよう実装

---

## 注意点

* 画像アップロード機能ではなく、指定画像の表示機能を実装
* 画像パスに「public」は含めず、asset関数を使用

---

## 作者

横田 憲治

# 🍎 商品管理アプリ（Laravel + Docker）

## 📌 概要

Laravelで作成した商品管理アプリです。
商品一覧・追加・編集・削除機能（CRUD）を実装しています。

---

## 🚀 使用技術

- PHP 8.4
- Laravel 13
- MySQL 8.0
- Docker / Docker Compose
- Blade（テンプレート）

---

## 🛠️ 環境構築方法

### ① リポジトリをクローン

```
git clone https://github.com/yokotakenji0413-bot/red-cat
cd red-cat
```

---

### ② Docker起動

```
docker compose up -d --build
```

---

### ③ マイグレーション実行

```
docker compose exec app php artisan migrate
```

---

### ④ Seeder実行（初期データ）

```
docker compose exec app php artisan db:seed
```

---

### ⑤ ストレージリンク作成

```
docker compose exec app php artisan storage:link
```

---

## 🌐 アクセスURL

<http://localhost:8000>

---

## ✨ 主な機能

### 📝 商品一覧

* 商品名
* 価格
* 季節表示
* 画像表示

---

### ➕ 商品追加

* 商品名・価格・説明・画像・季節を登録可能

---

### ✏️ 商品編集

* 登録済みデータの更新

---

### ❌ 商品削除

* ワンクリックで削除可能

---

## 📷 画像について

画像は以下のディレクトリに保存されています：

storage/app/public/products

例：

- banana.png
- orange.png
- grapes.png
- melon.png
- kiwi.png

画像は Laravel の storage:link により、以下のURLで表示されます：

/storage/products/banana.png

---

## ⚠️ 注意点

* `.env` ファイルは含まれていません
* 初回は必ず `migrate` と `db:seed` を実行してください

---

## 👨‍💻 作成者

横田憲治

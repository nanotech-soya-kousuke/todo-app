# todo-app
## 起動方法
### STEP 1: 必須アプリケーションの確認
- Docker Desktop
- Git
- ブラウザ(Firefoxなど)

### STEP 2: GitHubからtodo-appをクローン

任意のディレクトリでコマンドプロンプトを開き、以下を実行する。
```
git clone https://github.com/nanotech-soya-kousuke/todo-app
```

### STEP 3: Dockerで仮想サーバを立ち上げる

コマンドプロンプトで STEP2 で clone したディレクトリ(todo-app)に移動
```
cd ./todo-app
```
dockerで仮想サーバを立ち上げる。docker desktopが起動しているのを確認し、以下のコマンドを実行する。
```
docker compose up -d
```

### STEP 4: Dockerの前提準備
PostgreSQLのドライバを適用させるため、再ビルドする。
```
docker compose build --no-cache
```
その後、再度立ち上げる。(STEP 3 と同様)
```
docker compose up -d
```
データベースに接続する
```
docker compose exec db psql -U user -d todo_app
```
todos テーブルを作成する
```
CREATE TABLE todos (id SERIAL PRIMARY KEY,title VARCHAR(200) NOT NULL,is_done BOOLEAN DEFAULT FALSE, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
```

### STEP 5: ブラウザから接続
ブラウザ(Firefoxなど)を開き、以下に接続する。
```
http://localhost:8080
```

### STEP 6: 終了手順
コマンドプロンプトで以下を実行する。
```
docker compose down
```
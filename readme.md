# インスタグラムもどき

## 画面仕様書の中で実装できたもの
全て実装しました。


## 画面仕様書の中で実装できなかったもの
ありません。

ただし、herokuで動作させたときに投稿するファイルのサイズが大きすぎるとDBに書き込めないという問題が発生しました。

自分でいろいろ確かめてみましたが、2MBあたりを境にエラーが発生します。
後述のサムネイル画像保存の仕様上、1度に元画像とサムネイル画像をどっちも保存しているので、このあたりを改良すればもう少しサイズの上限は増やせそうな気はしますが…

ちなみに、ローカルの開発環境では大きなファイルサイズでも投稿できることを確認しています。


## 工夫したところ
### レイアウトの継承
ベースとなるレイアウト(base.blade.php)を作成し、それを継承することで各ページを構成しています。（ログインページは除く）

### レスポンシブデザイン
PC、スマートフォン、タブレットの各端末で表示されることを想定して作成しました。
各端末の識別には「Agent」というライブラリを用いています。

スマートフォン、タブレットについてはmetaタグで表示する横幅を固定しており、スマートフォンは750px、タブレットは850pxとなっています。

Agent
https://github.com/jenssegers/agent


## 難しかったところ
- DBの設計。各テーブルのリレーションをER図で表現することが難しかったです。未だに自信がありません。
- Gitでコミットするタイミング。Gitの概念は知っていましたが、利用するのは初めてでした。これといった正解がないので仕方ないのですが、コミットを行うべきタイミングがいまいちわからず、最後の方はかなりの頻度でコミットしていました。一応、作業の区切りを意識はしていました。
- ページ遷移時にどの方法でパラメータを送るか。ページ遷移時のパラメータの送り方としては、「ルートパラメータ」「クエリー文字列」「formによるpost」などが挙げられるかと思いますが、それらの使い分けに悩みました。（例えば削除したい投稿のidを送るとき）


## 追加した機能
### 動画対応
mp4形式の動画のアップロードに対応しています。

### サムネイル用画像の作成
ホーム画面、プロフィール画面では投稿された画像をそのまま表示せずに、ファイルサイズが小さいサムネイル画像を表示することで、ページの読み込みを早くしています。

画像を投稿する際に元画像にリサイズ処理を行い、サムネイル画像を生成しています。
DBに保存する際は元画像とサムネイル画像をどっちも保存しています。

リサイズではサムネイル画像の横幅が700pxとなるように処理されます。（サムネイル画像を表示する際の最大幅が700pxのため）
その際、アスペクト比は元画像の比率を維持するようにしています。
また、元画像の横幅が700px未満の場合はリサイズ処理を行わず、元画像をそのままサムネイル画像として利用します。

リサイズ処理にはPHP拡張モジュールのGDを利用しました。
ローカル環境ではそのまま使えましたが、Herokuにはデフォルトで用意されてなかったので、自分でインストールしました。

動画のリサイズですが、今回は作業時間が足りず間に合いませんでした。
動画のリサイズはFFmpegを用いる予定だったので、インストールはしてあります。
また、FFmpegをLaravelで動作させるために、Laravel-FFMpegもインストール済みです。

FFmpeg
https://ffmpeg.org/

Laravel-FFMpeg
https://github.com/pascalbaljetmedia/laravel-ffmpeg

###　元画像の表示
ホーム画面、プロフィール画面で表示される画像は全てリサイズされているので、元画像を表示できるページをつくりました。
サムネイル画像をクリックすると、別タブで元画像のみ読み込まれます。

### その他
自分がやるべき作業を細かく分割して、限られた時間の中でどのような優先順位で取り組んでいくかをひたすら考えていた一か月間でした。

今までここまで複雑なシステムは作ったことがなかったので、とてもやりがいがあり、この課題を通していろいろな技術が身についた気がします。
また機会があればこのような課題をやってみたいです。
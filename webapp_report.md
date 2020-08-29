##  1. 目的
近年、Webブラウザ上で動作する検索サービスやオンラインショッピングサービスなどのアプリケーションが広く利用されている。これらはWebアプリケーションといい、様々なプログラミング言語や開発環境で開発されている。Web アプリケーションの開発をサポートする技術の一つに、Web アプリケーションフレームワークというものがある。第3学年の実験「Web アプリケーション開発」では、PHPとMySQL(MariaDB)を直接用いてWebアプリケーションの開発を行った。しかし、実際のWebアプリケーション開発では、Webアプリケーションフレームワークを用いて開発を行うことが多い。Webアプリケーションフレームワークは Webアプリケーション開発で必要となる共通の機能をまとめたもので、これを利用して開発すると開発期間を短縮したり、不具合を減らしたりできる利点がある。PHP 環境で動作する Web アプリケーションフレームワークの一つが「Laravel」である。PHPもLaravelも無料で公開されており、誰でも自由に使うことができる。本実験では、Laravelを用いて簡単な Web アプリケーションを作成することで、Web アプリケーションフレームワークの仕組みや特徴を理解し、効率的な Web アプリケーション開発方法を修得することを目的とする。

## 2. 実験環境
本実験で使用したOS,DB,CPU,言語のバージョンを以下の表に示す。
<div style="text-align: center;">
表1 実験環境
</div>

|    ツール | ツール名 | バージョン|
|:----|:----|:----|
|    プログラミング言語 | PHP | PHP 7.3.10 (cli) (built: Sep 24 2019 11:59:22)    ウェブアプリケーションフレームワーク | Laravel | Laravel Framework 7.13.0    データベース | MariaDB | Ver 15.1 Distrib 10.4.8-MariaDB| for Win64 (AMD64)|
|    OS | Windows10 Home | 1909|
|    CPU | Intel(R) Core(TM) i5-8250U CPU @ 1.60GHz 1.80GHz | -|
|    メモリ | 8.0GB | -|
|    ウェブブラウザ | Google Chrome | 83.0.4103.116（Official Build） （64 ビット）|
|    データベース管理ツール | phpMyadmin | phpMyadmin4.9.5 |

## 3.課題1
本指導書の「4. Laravel アプリのコーディング」と「5. 投稿の追加」に示すコードを実装して、「5.4 動作確認」に示す追加機能を各自の環境で確認すること。レポートには、「5.4 動作確認」を実施した結果をスクリーンショットも含めて記述すること。  
### 3.1 手順
1. ``app/Http/Controllers/PostsController.php`` (以下、``PostsController``)に、投稿の追加フォームを表示する insert メソッドと、フォームに入力された投稿データを DB に登録する do_insert メソッドを追加する。  
    ``PostContoroller.php``
    ```
    public function insert(){
    return view('posts.insert');
    }
    public function do_insert(Request $request){
    $post = new Post();
    $post->author = 1;
    $post->title = $request->title;
    $post->content = $request->content;
    $post->comments = 0;
    $post->save();
    return redirect('/');
    }
    ```
1. ``resources/views/posts/insert.blade.php``(以下、``insert.blade.php``)を作成。  
    ``article.blade.php``
    ```
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="UTF-8" />
    <title>新規投稿</title>
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    </head>
    <body>
    <div>
    <h1 class="bg-success"><a href="/">Laravel Sample Blog</a></h1>
    </div>
    <h2>新規投稿</h2>
    <form method="POST" action="/post/insert">
    @csrf
    タイトル<br>
    <input name="title" value="" placeholder="タイトルを入力してください。"><br><br>
    本文<br>
    <textarea cols="50" value="" rows="15" name="content" placeholder="本文を入力してください。"></textarea><br>
    <input type="submit" class="btn btn-primary btn-sm" value="送信">
    </form>
    </body>
    </html>
    ```

### 3.2 動作確認
![](..\webapp実験スクショ\toukoumae.png)
<div style="text-align: center;">
図3.1 投稿する前の画面 
</div>

<br>

![](..\webapp実験スクショ\toukouato.png)
<div style="text-align: center;">
図3.2 投稿した後の画面 
</div>
<br>
<br>

```
MariaDB [blog]> select * from posts  where created_at = (select max(created_at) from posts);
+----+--------+------------+------------------+----------+---------------------+---------------------+
| id | author | title      | content          | comments | created_at          | updated_at          |
+----+--------+------------+------------------+----------+---------------------+---------------------+
| 17 |      1 | テスト投稿 | テストの投稿です |        0 | 2020-06-27 02:21:44 | 2020-06-27 02:21:44 |
+----+--------+------------+------------------+----------+---------------------+---------------------+
1 row in set (0.013 sec)
```
<div style="text-align: center;">
図3.3 最新の投稿を表示するsqlの出力結果 
</div>
<br>
<br>

図3.1,3.2,3.3より本アプリケーションがユーザの投稿を入力、格納、表示ができることがわかる。

### 3.3 説明
#### web.phpについて
laravelは``routes\web.php``(以下``web.php``)というところで入力されたurlに対する処理を書き込んでいる。課題1で関係してくるrouteは以下の通りである。

``routes\web.php``
```
Route::get('/post/insert', 'PostsController@insert');
Route::post('/post/insert', 'PostsController@do_insert');

//この行より前に記述
Route::get('/post/{id}', 'PostsController@show');
```
#### @insertについて
``web.php``のPostsController@insertの記述は``PostsController``にあるfunction insertを呼び出す処理に相当する。
この処理ではurlで/post/insertのgetリクエストが来た場合に ``insert.blade.php``をただ呼び出すだけの処理である。
#### @do_insertについて
``web.php``のPostsController@do_insertの記述も前述の通り``PostsController``にあるfunction do_insertを呼び出す処理に相当する。この処理の場合``web.php``の記述ではRoute::postとなっている。これは/post/insertへのpost通信が来た時の処理を表しており、``PostsController``側で入力されたリクエストをデータベースに格納する処理を行っている。
#### web.phpの修正 
指導書通りの``web.php``の記述ではurlで/post/insertと入力しても、ページが表示されなかった。この理由は``web.php``の記述である``Route::get('/post/{id}', 'PostsController@show');``という部分に問題があったと考えられる。{id}という記述が変数として存在してしまっていることでinsertという文字列も{id}の変数として認識されてしまったことが原因であると考えられる。``web.php``を修正し、routeの順番を変えることで、正しく表示することができた。このことからurlのリクエストを受け取ったときにweb.phpの頭から処理がされていくのであると考えられる。
#### @csrfについて
また、``insert.blade.php``の入力する部分の上に@csrfという記述がある。これはwebの脆弱性であるCSRF(クロスサイトリクエストフォージェリ)に対策するためのトークンである。webの性質上、どのurlに対してもpost通信を行うことが可能である。その仕組みを悪用したのがCSRFで、あらかじめurlに不正なリクエストを送信するscriptを含ませておき、被害者がurlをクリックすると不正なpostが送信されてしまう。すると、脆弱なブログアプリ等では勝手に投稿が書き込まれてしまったり、脆弱な通販サイトだは勝手に商品をかわされてしまうようなことが起こる。このような被害をなくすため、webサイトでは送られてきたリクエストが正しいリクエストであるかを確認する必要がある。これにより考案されたのがCSRFトークンであり、入力部が存在するwebサイトにユーザが遷移するときあらかじめそのユーザに対し文字列(トークン)を送っておき、それをユーザが入力したpostの中に含ませることで、そのトークンが存在するかどうか、またそのトークンが正しいトークンかどうかを判別して正しいリクエストかどうかを判断するという仕組みである。そのため@csrfという記述が``insert.blade.php``のformタグの中身にされていることが確認できる。今回の場合は/post/insertというurlに向けてpost送信している。
## 4.課題2
DBからすべての投稿を「最新投稿順(created_atカラムの降順)」に取得するように 、
``app/Http/Controllers/PostsController.php`` の list メソッドを修正せよ。正しく修正すると、より新しい投稿が上に表示されるようになる。レポートには、修正したソースコードと実行結果のスクリーンショットも含めて記述すること。
### 4.1手順
1. ``app/Http/Controllers/PostsController.php``の内容を変更
```
class PostsController extends Controller
{
    public function list(){
     $posts = Post::orderBy('created_at', 'desc')->simplePaginate(10);//投稿日時の降順で取得
     return view('posts.list', ['posts' => $posts]);
    }
```
2. ``resoureces/views/posts/list.blade.php``(以下list.vlade.php)の内容を記述
```
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<title>投稿</title>
<link rel="stylesheet" href="/css/app.css">
<link rel="stylesheet"
href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div>
 <h1><a href="/">Laravel Sample Blog</a></h1>
</div>
<table class="table">
<tr>
 <th>著者</th>
 <th>タイトル</th>
 <th>コメント数</th>
 <th>投稿日時</th>
 <th><a href="/post/insert" class="btn btn-primary btn-xs">追加</a></th>
</tr>
@foreach ($posts as $post)
 <tr>
 <td>{{ $post->author }}</td>
 <td><a href="/post/{{ $post->id }}">{{ $post->title }}</a></td>
 <td>{{ $post->comments }}</td>
 <td>{{ date("Y/m/d H:i:s",strtotime($post->created_at)) }}</td>
 <td>
 <a href="/post/{{ $post->id }}/update" class="btn btn-primary btn-xs">編集</a>
<a href="/post/{{ $post->id }}/delete" class="btn btn-danger btn-xs">削除</a>
 </td>
 </tr>
@endforeach
</table>
{!! $posts->links()  !!}
</body>
</html>
```
### 4.2動作確認

![](..\webapp実験スクショ\toukouato.png)
<div style="text-align: center;">
図4.1 投稿日時の降順にソートされたページの画像
</div>
図4.1を見てわかると通り投稿日時の降順になっていることがわかる。

### 4.3 説明
#### ORMとElouent
urlで/を入力することでlistメソッドが呼び出されている。``PostsController``内の処理のlistという部分で、ORM(Object Relational Mapping)というデータベースのレコードをプログラミング言語のオブジェクトとして使える仕組みを利用しています。LaravelではEloquentというORMがデフォルトで内蔵されています。今回はあらかじめデータベースにあるpostsというテーブルと関係づけられるモデルを作成し、コントローラの上部にあるuse App\Postという記述によって呼び出されています。またはじめに作成したモデル自動的にはデータベースのテーブル名の単数形になるということにも注意が必要です。
#### Eloquentの説明
前述の通り本実験ではmodelを使用することでデータベースと接続をしている。list内の処理の1行目ははpostsテーブルの中身をcreated_atというカラムで降順(descending)で取得した配列を$postsという変数に代入するという意味で、2行目はその配列をpostsという配列として``list.blade.php``という場所に遷移するという意味である。``list.blade.php``の処理として
#### blade側の処理の説明
@foreach(＄posts as ＄post)という記述で送られてきた＄postsという複数の配列のうちの一配列を＄postという変数として扱う処理が書かれている。この中から{{ $post->??? }}という形で配列の要素を呼び出してhtml側に表示させている。{{  }}で囲むのはbladeでphp側の変数を使用する際につかう書き方でこれにより送られてきた配列を表示したりすることができる。

## 5.課題3
### 5.1 ハッシュ値に関して調査し説明せよ
ハッシュ値は元のデータの長さによらず一定の長さとなっており、同じデータからは必ず同じハッシュ値が得られる。実用上は数バイトから数十バイト程度の長さとすることが多い。計算過程で情報の欠損が起きる不可逆な変換が含まれ、ハッシュ値から元のデータを復元することはできない。すなわち不可逆な暗号化(複合化できない)ということである。ハッシュ関数のうち、暗号などに適した性質を持つものを「暗号学的ハッシュ関数」という。
ハッシュ関数は非常に有用であり、暗号化や認証、デジタル署名など様々なセキュリティ技術の基礎的な要素技術として応用されている。算出法についての標準規格も定められ、古くはMD5やSHA-1などが広く普及したが、これらは現在では十分安全でないことが知られ、SHA-2（SHA-256など）への置き換えが進んでいる。phpにバージョンによっては使えないハッシュ関数もあるため注意が必要である。
### 5.2 代表的なハッシュ関数を3つあげそれらを説明せよ
- SHA-1  
    SHA-1とは発表されてからすぐに欠点が発表されたSHA-0の改良版である。National Security Agency（NSA）が開発を行った。SHA-0のSHAはSecure Hash Algorithmの略であり、前述の通りある文字列を160ビットのハッシュ値の長さを持つ。ハッシュ値の性質上、ある文字列をハッシュ化したとき、と別の文字列をハッシュ化したときに出力の結果が同じ(衝突)してしまったときに仕組みとしてそれが破綻してしまう。実際の事例として2017年に衝突攻撃の実例が発表されており、大企業などではこのハッシュ関数を使っている企業は先ずないといえるだろう。
    昔のphpの記事などを見ると使っているサイトなども多々ある。
- SHA-256   
    SHA-256とは現在最も使用頻度が高いといってもいいハッシュ関数である。前述の通りSHA-256のSHAもSecure Hash Algorithmである。SHA-1の改良版であるSHA-2の一つである。これがSHA-1と何が違うのかというとハッシュ長は256である。またSHA-256の兄弟分としてSHA-2シリーズは6つの種類があるSHA-224、SHA-256、SHA-384、SHA-512、SHA-512/224、SHA-512/256の6つである。National Security Agency（NSA）が開発にかかわっている。
- SHA-3
    SHA-3とは元はKeccakとして知られていた暗号学的ハッシュ関数のことである。その内部構造は従来のハッシュ関数とは全く異なっていて入力が一定の比率で内部状態に吸収され出力では同じ分だけ絞り出す、というスポンジ構造を採用している。このハッシュ関数は初めてNational Security Agency（NSA）が開発に携わっていないものである。
### 5.3 ダウンロードしたファイルのハッシュ値を確認してからファイルを使用する理由とを説明せよ
ダウンロードが正常に行われたかを確認するため、ダウンロード元のファイルとダウンロードしたファイルのハッシュ値を比較することでファイルの同一性を確認する。
これによりダウンロードが正常に行われていればハッシュ値は同じ結果を出力するが違う結果を出力した場合ダウンロードは正常に行われていないということを示す。

## 6.課題4
### 6.1 Webアプリケーションフレームワークの特徴について説明せよ
WebアプリケーションフレームワークはWebアプリケーションを作成する際に作業に伴う労力を軽減することができる枠組みのことである。phpでは本来dbに接続する際にいろいろな記述を施す必要があるがlaravelではenvファイルへの書き込みをし、関数を一つ書くだけで実装することができる。またPHPでは実装に時間がかかるCSRFトークン実装もbladeファイルに@csrfという記述を追加するだけで実装することができる。また今回はアプリケーションに検索画面などがなかったために気にする必要はなかったが、sqlインジェクションの脆弱性にもデフォルトの機能でサニタイズ(不正な操作が行われないように意味の持たない文字列として認識する)された状態で実行されるため、対策が施されている。またxssの対策もされていてbladeの記述で{{  }}の中身は自動的にサニタイズされるようになっている。今はLaravelの機能で例を挙げたが、Laravel以外のフレームワークにもセキュリティを意識した仕組みが施されていることが多い。また、最も脆弱になりやすい認証機能等もフレームワーク側から提供されることが多い。Laravelや後述するFuelPHP、サーバーサイド言語RubyのフレームワークであるRuby on Railsなどは認証機能を素早く取り入れることができる点もフレームワークの利点といえる。
しかし、フレームワークを使用するWeb開発の欠点として自由度に欠ける点があげられる。そういった場合などは他言語をWebサーバにマウントするなど少し遠回りした開発になることがある。
### 6.2 Laravel以外のPHPフレームワークを3つ挙げてその特徴をまとめよ
- CakePHP
    MVCアーキテクチャを採用。現実の食べ物であるケーキを作ることをイメージして作られている。コマンドラインでbake(焼くという意味)と打ち込むことでmodelの作成やcontrollerの作成を行う。習得までの時間が短くMVCのviewの部分などではLaravelとは違い純粋なPHPを使用して記述する。より純粋なPHPの書き方に近いというのがCakePHPの特徴である。環境設定の必要量が多いことが欠点である。小規模の開発に向いている。
- FuelPHP
    MVCアーキテクチャを採用しているが、このフレームワークはHMVC(Hierarchical Model-View-Controller)という階層型のMVCを採用していることが特徴である。一つのMVCをModuleとして扱い、それらをディレクトリ構造をとることでアプリケーションとして機能している。fuelは燃料を意味し、高速な処理をすることが特徴である。また主に使用するコマンドはoil(油)であることも特徴であるといえる。
- Symfony
    MVCアーキテクチャを採用。今までに紹介したフレームワークはフレームワークによって予め用意されたファイルに自分で設定を書き、それをフレームワークを介することで動くような仕組みになっていたが、Symfonyは作成したプロジェクトを自動で生成する機能があり、自動化ということを重きにおいたフレームワークである。大規模で堅牢な開発に向いている。

## 7.課題5
Web アプリケーション開発では、MVC アーキテクチャが使用されることが多い。MVC アーキテクチャと
は何か調査し解説せよ。  
<br>
MVCアーキテクチャのMVCというのはModel View Controllerの3つに分割しコーディングを行うモデルのことである。大規模の開発などで体裁を整えるために採用される仕組み。modelはシステム内のビジネスロジックを担当する。システムの設計や機能をどうするかがここで行われる。viewは実際に表示したり、入力する機能の処理を行う。controllerは、モデルとビューを制御する役割を担っています。サービス利用者とmodelとviewの橋渡しをする。これらをファイルを分けてコーディングを行っていくのがMVCアーキテクチャである。 

## 8.まとめ
Laravel を用いて簡単な Web アプリケーションを作成することで、Webアプリケーションフレームワークの仕組みや特徴を理解し、効率的なWebアプリケーション開発方法を修得することができた。
## 参考文献
1. 「PHPフレームワークLaravel入門第2版」、掌田津耶乃、秀和システム
1. 「PHPフレームワークLaravel実践開発」、掌田津耶乃、秀和システム

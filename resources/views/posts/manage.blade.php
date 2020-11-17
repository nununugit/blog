<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>chkREST</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
</head>

<body>
    <p>リクエスト：ベースのURL<input type="text" value="http://localhost:8000/api/post" id="baseurl" size="50"></p>
    <table border="1">
        <tr>
            <th>HTTPメソッド</th>
            <td id="method"></td>
        </tr>
        <tr>
            <th>URL</th>
            <td id="url"></td>
        </tr>
        <tr>
            <th>データ</th>
            <td id="data"></td>
        </tr>
    </table>
    </p>
    <p>レスポンス：
        <table border="1">
            <tr>
                <th>HTTPステータスコード</th>
                <td><span id="status"></span></td>
            </tr>
            <tr>
                <th>受信したJSON</th>
                <td><span id="json"></span></td>
            </tr>
            <tr>
                <th>エラーメッセージ</th>
                <td id="message"></td>
            </tr>
        </table>
    </p>
    <hr> 【１】
    <p><input type="button" value="すべてのデータを取得(index)" id="button1"></p>
    <hr> 【２】
    <p>タイトル <input type="text" value="" id="title2" size="20"><br> 本文 <textarea id="content2" rows="4" cols="40"></textarea></p>
    <p><input type="button" value="新しいデータを追加(store)" id="button2"></p>
    <hr> 【３】
    <p>id <input type="text" value="" id="id3" size="5"></p>
    <p><input type="button" value="指定したidのデータを取得(show)" id="button3"></p>
    <hr> 【４】
    <p>id <input type="text" value="" id="id4" size="5"><br> タイトル <input type="text" value="" id="title4" size="20"><br> 本文 <textarea id="content4" rows="4" cols="40"></textarea></p>
    <p><input type="button" value="指定したidのデータを更新(update)" id="button4"></p>
    <hr> 【５】
    <p>id <input type="text" value="" id="id5" size="5"></p>
    <p><input type="button" value="指定したidのデータを削除(destroy)" id="button5"></p>
    <hr>
    <script>
        $(function() {
      $("#button1").click(function() {
          var url = $('#baseurl').val();
          var method = "GET";
          $.ajaxSetup({
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
          })
          $.ajax({
                  url: url,
                  type: method,
                  timeout: 5000,
                  beforeSend: function(jqXHR, settings) {
                      $("#method").text(method);
                      $("#url").text(url);
                      $("#data").text(settings.data);
                  },
              })
              .done(function(data, textStatus, jqXHR) {
                  $("#status").text(jqXHR.status);
                  $("#json").text(JSON.stringify(data));
                  $("#message").text("");
              })
              .fail(function(jqXHR, textStatus, errorThrown) {
                  $("#status").text("err:" + jqXHR.status);
                  $("#json").text(textStatus);
                  $("#message").text(errorThrown);
              })
              .always(function() {});
      });
  
      $("#button2").click(function() {
          var url = $('#baseurl').val();
          var method = "POST";
          var json = {
              title: $('#title2').val(),
              content: $('#content2').val(),
          };
            $.ajaxSetup({
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
          })
          $.ajax({
                  url: url,
                  type: method,
                  timeout: 5000,
                  contentType: "application/json",
                  data: JSON.stringify(json),
                  dataType: "json",
                  beforeSend: function(jqXHR, settings) {
                      $("#method").text(method);
                      $("#url").text(url);
                      $("#data").text(settings.data);
                  },
              })
              .done(function(data, textStatus, jqXHR) {
                  $("#status").text(jqXHR.status);
                  $("#json").text(JSON.stringify(data));
                  $("#message").text("");
              })
              .fail(function(jqXHR, textStatus, errorThrown) {
                  $("#status").text("err:" + jqXHR.status);
                  $("#json").text(textStatus);
                  $("#message").text(errorThrown);
              })
              .always(function() {});
      });
  
      $("#button3").click(function() {
          var url = $('#baseurl').val() + "/" + $('#id3').val();
          var method = "GET";
          $.ajaxSetup({
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
          })
          $.ajax({
                  url: url,
                  type: method,
                  timeout: 5000,
                  beforeSend: function(jqXHR, settings) {
                      $("#method").text(method);
                      $("#url").text(url);
                      $("#data").text(settings.data);
                  },
              })
              .done(function(data, textStatus, jqXHR) {
                  $("#status").text(jqXHR.status);
                  $("#json").text(JSON.stringify(data));
                  $("#message").text("");
              })
              .fail(function(jqXHR, textStatus, errorThrown) {
                  $("#status").text("err:" + jqXHR.status);
                  $("#json").text(textStatus);
                  $("#message").text(errorThrown);
              })
              .always(function() {});
      });
  
      $("#button4").click(function() {
          var url = $('#baseurl').val() + "/" + $('#id4').val();
          var method = "PUT";
          var json = {
              "title": $('#title4').val(),
              "content": $('#content4').val(),
          };
          $.ajaxSetup({
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
          })
          $.ajax({
                  url: url,
                  type: method,
                  timeout: 5000,
                  contentType: "application/json",
                  data: JSON.stringify(json),
                  dataType: "json",
                  beforeSend: function(jqXHR, settings) {
                      $("#method").text(method);
                      $("#url").text(url);
                      $("#data").text(settings.data);
                  },
              })
              .done(function(data, textStatus, jqXHR) {
                  $("#status").text(jqXHR.status);
                  $("#json").text(JSON.stringify(data));
                  $("#message").text("");
              })
              .fail(function(jqXHR, textStatus, errorThrown) {
                  $("#status").text("err:" + jqXHR.status);
                  $("#json").text(textStatus);
                  $("#message").text(errorThrown);
              })
              .always(function() {});
      });
  
      $("#button5").click(function() {
          var url = $('#baseurl').val() + "/" + $('#id5').val();
          var method = "DELETE";
          $.ajaxSetup({
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
          })
          $.ajax({
                  url: url,
                  type: method,
                  timeout: 5000,
                  beforeSend: function(jqXHR, settings) {
                      $("#method").text(method);
                      $("#url").text(url);
                      $("#data").text(settings.data);
                  },
              })
              .done(function(data, textStatus, jqXHR) {
                  $("#status").text(jqXHR.status);
                  $("#json").text(JSON.stringify(data));
                  $("#message").text("");
              })
              .fail(function(jqXHR, textStatus, errorThrown) {
                  $("#status").text("err:" + jqXHR.status);
                  $("#json").text(textStatus);
                  $("#message").text(errorThrown);
              })
              .always(function() {});
      });
  });
      </script>
</body>

</html>
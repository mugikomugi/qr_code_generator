<?php
  //クロスサイトスクリプト
  function html_esc($word){
    return htmlspecialchars($word,ENT_QUOTES,'UTF-8');
  }

  $err = [];
  $err['text'] = '';
  $err['size'] = '';
  $err['color'] = '';
  $err['type'] = '';
  $cheked1 = '';
  $cheked6 = '';
  $cheked8 = '';
  $cheked10 = '';
  $cheked12 = '';
  $cheked15 = '';
  $cheked20 = '';
  $cheked_bla = '';
  $cheked_red = '';
  $cheked_blu = '';
  $cheked_ore = '';
  $cheked_cus = '';

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $qr_text = html_esc($_POST['qr_text']);
    //radionのチェックはissetで有無を調べないとnoticeが出る
    if(isset($_POST['qr_size'])){
      $qr_size = html_esc($_POST['qr_size']);
    }
    if(isset($_POST['qr_color'])){
      $qr_color = html_esc($_POST['qr_color']);
    }
    if(isset($_POST['qr_type'])){
      $qr_type = html_esc($_POST['qr_type']);
    }

    //カスタムサイズとカラー
    if(isset($_POST['all_size'])){
      $all_size = html_esc($_POST['all_size']);
    }
    if(isset($_POST['in_size'])){
      $in_size = html_esc($_POST['in_size']);
    }
    if(isset($_POST['r_color'])){
      $r_color = html_esc($_POST['r_color']);
    }
    if(isset($_POST['g_color'])){
      $g_color = html_esc($_POST['g_color']);
    }
    if(isset($_POST['b_color'])){
      $b_color = html_esc($_POST['b_color']);
    }

    //エラーチェック
    if($qr_text === '' || mb_strlen($qr_text) > 200){
      $err['text'] = '<p class="err"><span class="material-icons-outlined">error_outline</span>未入力か字数制限を超えています</p>';
    } else {
      $err['text'] = '';
    }
    //radioのエラーはemptyで確認しないと検出できない
    if(empty($qr_size)){
      $err['size'] = '<p class="err"><span class="material-icons-outlined">error_outline</span>未選択です</p>';
    } else {
        switch($qr_size){
          case '60': $cheked6 = 'checked'; break;
          case '80': $cheked8 = 'checked'; break;
          case '100': $cheked10 = 'checked'; break;
          case '120': $cheked12 = 'checked'; break;
          case '150': $cheked15 = 'checked'; break;
          case '200': $cheked20 = 'checked'; break;
          case 'custam_size': $cheked1 = 'checked';
          if($_POST['all_size'] === '' || $_POST['in_size'] === ''){
            $err['size'] = '<p class="err"><span class="material-icons-outlined">error_outline</span>カスタムサイズの指定がありません</p>';
            }
           break;
          default;
          $cheked1 = '';
        }
        //var_dump($qr_size);
        $err['size'] = '';
      }

    if(empty($qr_color)){
      $err['color'] = '<p class="err"><span class="material-icons-outlined">error_outline</span>未選択です</p>';
    } else {
      switch($qr_color){
        cace 'black': $cheked_bla = 'checked'; break;
        cace 'blue': $cheked_blu = 'checked'; break;
        cace 'red': $cheked_red = 'checked'; break;
        cace 'green': $cheked_gre = 'checked'; break;
        cace 'orenge': $cheked_ore = 'checked'; break;
        cace 'custam_color': $cheked_cus = 'checked';
        if($_POST['r_color'] === '' || $_POST['g_color'] === '' || $_POST['b_color'] === ''){
          $err['color'] = '<p class="err"><span class="material-icons-outlined">error_outline</span>RGB値の指定がありません</p>';
        }
        break;
        default;
        $cheked_cus = '';
      }
      var_dump($qr_color);
      $err['color'] = '';
    }

    if(empty($qr_type)){
      $err['type'] = '<p class="err"><span class="material-icons-outlined">error_outline</span>未選択です</p>';
    } else {
      $err['type'] = '';
    }

  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QRコードジェネレーター</title>
  <meta name="format-detection" content="telephone=no">
  <!--webフォント-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
  <!-- Outlined -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined"
rel="stylesheet">
  <link rel="stylesheet" href="sanitize.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <!--お気に入りアイコン152x152-->
  <link rel="apple-touch-icon-precomposed" href="apple-touch-icon.png">
  <!--ファビコン32x32-->
  <link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon">
  <noscript>JavaScriptが非対応になっています</noscript>
</head>
<body>
  <div class="wrapper">

    <header class="header">
      <h1 class="topH1"><span class="material-icons-outlined">qr_code</span>QR CODE<span class="subH1">GENERATER</span></h1>
    </header>

    <main class="main">
      <section class="intro">
        <h2 class="subH2">Annotation<span></span></h2>
        <p class="mb20">endroid/qr-codeのライブラリを使ってQRコードジェネレーターを作りました。<br>
          URL、メール、地図などご自由にお使い下さい。<br>
          サイズは60px〜カスタムサイズも入力できるようにしています。色はデフォルトで黒にしていますがカラーも選べます。<br>
          画像形式は推奨されているPNGと、カスタマイズ向きのSVGを生成できるようにしました。
        </p>
        <p class="center"><a href="https://github.com/endroid/qr-code">https://github.com/endroid/qr-code</a><br><span class="smallText">※使用バージョンは4.4.7です</span></p>
      </section>

      <!-- form送信 -->
      <form id="qrForm" method="post" action="">
        <div class="formGroup">
          <p class="groupNum"><span>1</span>テキストを入力して下さい(200文字以内)</p>
          <?php echo $err['text']; ?>
          <input type="text" class="inputText" name="qr_text">
        </div>

        <div class="formGroup">
          <p class="groupNum"><span>2</span>サイズを選んでください(余白は10px程取っています)</p>
          <?php echo $err['size']; ?>
          <div class="qrImg">
            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code60.svg" alt="60pxサイズ">
              <input type="radio" class="qrSize" name="qr_size" value="60" <?php echo $cheked6; ?>>60px
            </label>

            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code80.svg" alt="80pxサイズ">
              <input type="radio" class="qrSize" name="qr_size" value="80" <?php echo $cheked8; ?>>80px
            </label>

            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code100.svg" alt="100pxサイズ">
              <input type="radio" class="qrSize" name="qr_size" value="100" <?php echo $cheked10; ?>>100px
            </label>

            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code120.svg" alt="120pxサイズ">
              <input type="radio" class="qrSize" name="qr_size" value="120" <?php echo $cheked12; ?>>120px
            </label>

            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code150.svg" alt="150pxサイズ">
              <input type="radio" class="qrSize" name="qr_size" value="150" <?php echo $cheked15; ?>>150px
            </label>

            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code200.svg" alt="200pxサイズ">
              <input type="radio" class="qrSize" name="qr_size" value="200" <?php echo $cheked20; ?>>200px
            </label>
          </div>
          <!-- //.qrImg -->

          <div class="custam">
            <p>※上記以外のサイズはカスタムサイズを選んで数値を入力してください。</p>
            <label class="qrRadioCustam">
              <input type="radio" class="qrSize" name="qr_size" value="custam_size" <?php echo $cheked1; ?>>カスタムサイズ
            </label>
            <label class="allSize">全体枠
              <input type="number" name="all_size" min="40">px
            </label>
            <label class="allSize">余白
              <input type="number" name="in_size" min="4">px
            </label>
          </div>
          <!-- //.custam -->
        </div>
        <!-- //.formGroup -->

        <div class="formGroup">
          <p class="groupNum"><span>3</span>カラーを選んでください</p>
          <?php echo $err['color']; ?>
          <div class="qrImg">
            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code80.svg" alt="黒">
              <input type="radio" class="qrSize" name="qr_color" value="black" <?php echo $cheked_bla; ?>>黒
            </label>
            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code80red.svg" alt="赤">
              <input type="radio" class="qrSize" name="qr_color" value="red" <?php echo $cheked_red; ?>>赤
            </label>
            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code80bl.svg" alt="青">
              <input type="radio" class="qrSize" name="qr_color" value="blue" <?php echo $cheked_blu; ?>>青
            </label>
            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code80gree.svg" alt="緑">
              <input type="radio" class="qrSize" name="qr_color" value="green" <?php echo $cheked_gre; ?>>緑
            </label>
            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code80ore.svg" alt="オレンジ">
              <input type="radio" class="qrSize" name="qr_color" value="orenge" <?php echo $cheked_ore; ?>>オレンジ
            </label>
          </div>
          <!-- //.qrImg -->

          <div class="custam">
            <p>※上記以外のカラーはカスタムカラーを選んでRGB値を入力してください。</p>
            <label class="qrRadioCustam">
              <input type="radio" class="qrSize" name="qr_color" value="custam_color" <?php echo $cheked_cus; ?>>カスタムカラー
            </label>
            <label class="allSize">R
              <input type="number" name="r_color" min="0" max="255">
            </label>
            <label class="allSize">G
              <input type="number" name="g_color" min="0" max="255">
            </label>
            <label class="allSize">B
              <input type="number" name="b_color" min="0" max="255">
            </label>
          </div>
          <!-- //.custam -->
        </div>
        <!-- //.formGroup -->

        <div class="formGroup">
          <p class="groupNum"><span>4</span>画像形式を選んでください</p>
          <?php echo $err['type']; ?>
          <label class="qrMold">
            <input type="radio" class="qrSize" name="qr_type" value="png">PNG(推奨形式)
          </label>
          <label class="qrMold">
            <input type="radio" class="qrSize" name="qr_type" value="svg">SVG(カスタマイズ向)
          </label>
        </div>
        <!-- //.formGroup -->

        <input type="submit" value="QRコードを作る" id="submibtn">
      </form>

      <!-- 生成コード表示 -->
      <div id="qr_panel">
        <p>ここにQRコードが表示されます</p>
        <!-- <p><img src="image/qr_code80.svg" alt="黒"></p> -->
      </div>

      <!-- DLボタン -->
      <a href="#" id="dlBtn">ダウンロードする</a>
      <p class="center">※ダウンロード後はQRコードの読み込みを確認してください</p>

      <section class="infoBox">
        <h3 class="infoBoxH3">動作確認について</h3>
        ブラウザはChromeかFirefox、Safariの最新バージョンを推奨いたします。<br>
        Microsoft IEとWindows10以降標準ブラウザであるEdgeは動作確認をしていません。<br>
        スマホにおいてはiPhoneのみ確認できています。（Androidは持っていないので…）
      </section>

    </main>

    <footer class="footer">
      <a class="footerImg" href="#"><img src="image/github.svg" alt=""></a>
      <small>Copyright 2022 Mugikomugi All Rights Reserved.</small>
    </footer>

  </div>
</body>
</html>
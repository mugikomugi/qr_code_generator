<?php
  //クロスサイトスクリプト
  function html_esc($word){
    return htmlspecialchars($word,ENT_QUOTES,'UTF-8');
  }
//初期値
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
  $cheked_gre = '';
  $cheked_ore = '';
  $cheked_cus = '';
  $cheked_png = '';
  $cheked_svg = '';
  $qr_text = '';
  $all_size = '';
  $in_size = '';
  $r_color = '';
  $g_color = '';
  $b_color = '';
  $qr_show = 'ここにQRコードが表示されます';
  $qr_id = 'dlBtnNon';
  $qr_img = 'javascript:void(0);';

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $qr_text = html_esc($_POST['qr_text']);
    //radioのチェックはissetで有無を調べないとnoticeが出る
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

    //エラーチェックと値変換
    if($qr_text === '' || mb_strlen($qr_text) > 200){
      $err['text'] = '<p class="err"><span class="material-icons-outlined">error_outline</span>未入力か字数制限を超えています</p>';
    } else {
      $err['text'] = '';
    }
    //radioのエラーはemptyで確認しないと検出できない
    if(empty($qr_size)){
      $err['size'] = '<p class="err"><span class="material-icons-outlined">error_outline</span>未選択です</p>';
    } else {
        //サイズと余白設定
        switch($qr_size){
          case '60': $cheked6 = 'checked';
          $all_size_set = 58; $in_size_set = 6;
           break;
          case '80': $cheked8 = 'checked';
          $all_size_set = 84; $in_size_set = 6;
          break;
          case '100': $cheked10 = 'checked';
          $all_size_set = 110; $in_size_set = 6;
          break;
          case '120': $cheked12 = 'checked';
          $all_size_set = 128; $in_size_set = 10;
          break;
          case '150': $cheked15 = 'checked';
          $all_size_set = 150; $in_size_set = 10;
          break;
          case '200': $cheked20 = 'checked';
          $all_size_set = 180; $in_size_set = 10;
          break;
          case 'custam_size': $cheked1 = 'checked';
          break;
        }
        $err['size'] = '';
      }
    //カスタムサイズのチェック
    if(!empty($qr_size)){
      if($qr_size === 'custam_size'){
        if($all_size === '' || $in_size === ''){
          $err['size'] = '<p class="err"><span class="material-icons-outlined">error_outline</span>カスタムサイズの指定がありません</p>';
          } else {
          $all_size_set = (int)$all_size;
          $in_size_set = (int)$in_size;
          $err['size'] = '';
        }
      } else {
        //カスタムサイズのチェックが外れた時、数値を空に
        $all_size = '';
        $in_size = '';
      }
    }
    //var_dump($all_size_set); var_dump($in_size_set);

    if(empty($qr_color)){
      $err['color'] = '<p class="err"><span class="material-icons-outlined">error_outline</span>未選択です</p>';
    } else {
      switch($qr_color){
        case 'black': $cheked_bla = 'checked';
        $rgb_r = 0; $rgb_g = 0; $rgb_b = 0;
        break;
        case 'blue': $cheked_blu = 'checked';
        $rgb_r = 0; $rgb_g = 0; $rgb_b = 255;
        break;
        case 'red': $cheked_red = 'checked';
        $rgb_r = 255; $rgb_g = 0; $rgb_b = 0;
        break;
        case 'green': $cheked_gre = 'checked';
        $rgb_r = 23; $rgb_g = 185; $rgb_b = 17;
        break;
        case 'orenge': $cheked_ore = 'checked';
        $rgb_r = 255; $rgb_g = 128; $rgb_b = 0;
        break;
        case 'custam_color': $cheked_cus = 'checked';
        break;
      }
      $err['color'] = '';
    }
    //RGB値のチェック
    if(!empty($qr_color)){
      if($qr_color === 'custam_color'){
        if($r_color === '' || $g_color === '' || $b_color === ''){
          $err['color'] = '<p class="err"><span class="material-icons-outlined">error_outline</span>RGB値の指定がありません</p>';
        } else {
          $rgb_r = (int)$r_color;
          $rgb_g = (int)$g_color;
          $rgb_b = (int)$b_color;
          $err['color'] = '';
        }
      } else {
        $r_color = '';
        $g_color = '';
        $b_color = '';
      }
    }
    //var_dump($rgb_r); var_dump($rgb_g); var_dump($rgb_b);

    if(empty($qr_type)){
      $err['type'] = '<p class="err"><span class="material-icons-outlined">error_outline</span>未選択です</p>';
    } else {
      switch($qr_type){
        case 'png': $cheked_png = 'checked'; break;
        case 'svg': $cheked_svg = 'checked'; break;
      }
      $err['type'] = '';
    }

    if($qr_text !== '' && mb_strlen($qr_text) < 200 && $err['size'] === '' && $err['color'] === '' && !empty($qr_type)){
      //JSONに入れる為、配列へ
      $qr_data = [$qr_text,$all_size_set,$in_size_set,$rgb_r,$rgb_g,$rgb_b];
      //JSON形式に変換
      $json = json_encode($qr_data,JSON_UNESCAPED_UNICODE);
      //JSONへ格納
      file_put_contents('qr_data.json',$json);

      if($qr_type === 'png'){
        $qr_show = '<img src="qr_code_png.php" alt="QRコード">';
        $qr_img = 'qr_code_png.php';
        $qr_id = 'dlBtn';
      } elseif ($qr_type === 'svg'){
        $qr_show = '<img src="qr_code_svg.php" alt="QRコード">';
        $qr_img = 'qr_code_svg.php';
        $qr_id = 'dlBtn';
      }
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
  <!-- ogptag -->
  <meta name="og:url" content="https://spica.okamechan.com/qrcode/" />
  <meta name="og:title" content="QRコードジェネレーター" />
  <meta property="og:site_name" content="QRコードジェネレーター" />
  <meta name="og:image" content="https://spica.okamechan.com/qrcode/image/ogp.jpg" />
  <meta name="og:description" content="PHPで開発中のQRコードジェネレーターです" />
  <meta name="og:type" content="website" />
  <!-- //ogptag -->
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
          サイズは70px〜カスタムサイズも入力できるようにしています。色はデフォルトで黒にしていますがカラーも選べます。<br>
          画像形式は推奨されているPNGと、カスタマイズ向きのSVGを生成できるようにしました。
        </p>
        <p class="center"><a href="https://github.com/endroid/qr-code">https://github.com/endroid/qr-code</a><br><span class="smallText">※使用バージョンは4.4.7です</span></p>
      </section>

      <!-- form送信 -->
      <form id="qrForm" method="post" action="">
        <div class="formGroup">
          <p class="groupNum"><span>1</span>テキストを入力して下さい(200文字以内)</p>
          <?php echo $err['text']; ?>
          <input type="text" class="inputText" name="qr_text" value="<?php echo $qr_text; ?>">
        </div>

        <div class="formGroup">
          <p class="groupNum"><span>2</span>サイズを選んでください(余白は10px程取っています)</p>
          <?php echo $err['size']; ?>
          <div class="qrImg">
            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code70.svg" alt="70pxサイズ">
              <input type="radio" class="qrSize" name="qr_size" value="60" <?php echo $cheked6; ?>>70px
            </label>

            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code96.svg" alt="96pxサイズ">
              <input type="radio" class="qrSize" name="qr_size" value="80" <?php echo $cheked8; ?>>96px
            </label>

            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code122.svg" alt="122pxサイズ">
              <input type="radio" class="qrSize" name="qr_size" value="100" <?php echo $cheked10; ?>>122px
            </label>

            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code148.svg" alt="148pxサイズ">
              <input type="radio" class="qrSize" name="qr_size" value="120" <?php echo $cheked12; ?>>148px
            </label>

            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code170.svg" alt="170pxサイズ">
              <input type="radio" class="qrSize" name="qr_size" value="150" <?php echo $cheked15; ?>>170px
            </label>

            <label class="qrBox">
              <img class="sizeImg" src="image/qr_code200.svg" alt="200pxサイズ">
              <input type="radio" class="qrSize" name="qr_size" value="200" <?php echo $cheked20; ?>>200px
            </label>
          </div>
          <!-- //.qrImg -->

          <div class="custam">
            <p>※上記以外のサイズはカスタムサイズを選んで数値を入力してください。<br>
            <span class="smallText">小さいサイズは多少誤差が出るようです。</span></p>
            <label class="qrRadioCustam">
              <input type="radio" class="qrSize" name="qr_size" value="custam_size" <?php echo $cheked1; ?>>カスタムサイズ
            </label>
            <label class="allSize">コード枠
              <input type="number" name="all_size" min="40" max="300" value="<?php echo $all_size; ?>">px
            </label>
            <label class="allSize">余白
              <input type="number" name="in_size" min="2" max="20" value="<?php echo $in_size; ?>">px
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
              <input type="number" name="r_color" min="0" max="255" value="<?php echo $r_color; ?>">
            </label>
            <label class="allSize">G
              <input type="number" name="g_color" min="0" max="255" value="<?php echo $g_color; ?>">
            </label>
            <label class="allSize">B
              <input type="number" name="b_color" min="0" max="255" value="<?php echo $b_color; ?>">
            </label>
          </div>
          <!-- //.custam -->
        </div>
        <!-- //.formGroup -->

        <div class="formGroup">
          <p class="groupNum"><span>4</span>画像形式を選んでください</p>
          <?php echo $err['type']; ?>
          <label class="qrMold">
            <input type="radio" class="qrSize" name="qr_type" value="png" <?php echo $cheked_png; ?>>PNG(推奨形式)
          </label>
          <label class="qrMold">
            <input type="radio" class="qrSize" name="qr_type" value="svg" <?php echo $cheked_svg; ?>>SVG(カスタマイズ向)
          </label>
        </div>
        <!-- //.formGroup -->

        <input type="submit" value="QRコードを作る" id="submibtn">
      </form>

      <!-- 生成コード表示 -->
      <div id="qr_panel">
        <p><?php echo $qr_show; ?></p>
      </div>

      <!-- DLボタン -->
      <a href="<?php echo $qr_img; ?>" id="<?php echo $qr_id; ?>">ダウンロードする</a>
      <p class="center">※ダウンロード後はQRコードの読み込みを確認してください</p>

      <section class="infoBox">
        <h3 class="infoBoxH3">動作確認について</h3>
        ブラウザはChromeかFirefox、Safariの最新バージョンを推奨いたします。<br>
        Microsoft IEとWindows10以降標準ブラウザであるEdgeは動作確認をしていません。<br>
        スマホにおいてはiPhoneのみ確認できています。
      </section>

    </main>

    <footer class="footer">
      <a class="footerImg" href="#"><img src="image/github.svg" alt=""></a>
      <small>Copyright 2022 Mugikomugi All Rights Reserved.</small>
    </footer>

  </div>
</body>
</html>
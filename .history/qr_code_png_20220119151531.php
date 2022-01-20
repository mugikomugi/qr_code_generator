<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Endroid\QrCode\QrCode;

//jsonファイルを取得
$json =file_get_contents('./qr_data.json');
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$json = json_decode($json,true);

//jsonデータを変数に格納
$qr_text = $json[0]; print_r($qr_text);
$all_size_set = $json[1]; print_r($all_size_set);
$in_size_set = $json[2]; print_r($in_size_set);
$rgb_r = $json[3]; print_r($rgb_r);
$rgb_g = $json[4]; print_r($rgb_g);
$rgb_b = $json[5]; print_r($rgb_b);

//$qrCodeData = $qr_text;
// QRコードに埋め込む文字列の指定
//$qrCode = new QrCode($qrCodeData);

// QRコードのサイス（単位：ピクセル）
//$qrCode->setSize($all_size_set);

// QRコードの周囲の余白（単位：ピクセル）
//$qrCode->setMargin($in_size_set);

// QRコードの色（RGBAで指定）
//$qrCode->setForegroundColor(['r' => $rgb_r, 'g' => $rgb_g, 'b' => $rgb_b, 'a' => 1]);

// 背景の色（RGBAで指定）
//$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 1]);

//DLファイルとしない場合
//header('Content-Type: '.$qrCode->getContentType());

//echo $qrCode->writeString();
 $file = 'qr_code.png';

// 2.コンテンツタイプを「ダウンロード」にする
//header('Content-Type: application/force-download');
// 3.ファイルサイズを取得して設定する
//header('Content-Length: '.filesize($file));
// 4.ダウンロードする「ファイル名」を指定する。
//header('Content-Disposition: attachment; filename="'.$file.'"');
 
// 5.ファイルを読み込む
//readfile($file);

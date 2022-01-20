<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Endroid\QrCode\QrCode;

//jsonファイルを取得
$json =file_get_contents('./qr_data.json');
$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$json = json_decode($json,true);

//jsonデータを変数に格納
$qr_text = $json[0];
$all_size_set = $json[1];
$in_size_set = $json[2];
$rgb_r = $json[3]; 
$rgb_g = $json[4];
$rgb_b = $json[5];

$qrCodeData = $qr_text;
// QRコードに埋め込む文字列の指定
$qrCode = new QrCode($qrCodeData);

$qrCode ->setEncoding('UTF-8');
// QRコードのサイス（単位：ピクセル）
$qrCode->setSize($all_size_set);

// QRコードの周囲の余白（単位：ピクセル）
$qrCode->setMargin($in_size_set);

// QRコードの色（RGBAで指定）
$qrCode->setForegroundColor(['r' => $rgb_r, 'g' => $rgb_g, 'b' => $rgb_b, 'a' => 1]);

// 背景の色（RGBAで指定）
$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 1]);

//SVGで画像化
$qrCode -> setWriterByExtension('svg');

//DLファイル名
$file = 'qr_code.svg';

// Directly output the QR code
header('Content-Type: '.$qrCode->getContentType());
//ダウンロードする「ファイル名」を指定する。
header('Content-Disposition: attachment; filename="'.$file.'"');
//画像表示、最後に置かないと表示されなかった
echo $qrCode->writeString();
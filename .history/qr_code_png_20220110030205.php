<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Endroid\QrCode\QrCode;


$qrCodeData = 'https://goo.gl/maps/eJuB9HZm9HVErRGEA';
// QRコードに埋め込む文字列の指定
$qrCode = new QrCode($qrCodeData);

// QRコードのサイス（単位：ピクセル）
$qrCode->setSize(100);

// QRコードの周囲の余白（単位：ピクセル）
$qrCode->setMargin(10);

// QRコードの色（RGBAで指定）
$qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 1]);

// 背景の色（RGBAで指定）
$qrCode->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255, 'a' => 1]);

// QRコードの中央に配置するロゴファイルのパス
//$qrCode->setLogoPath('logo.png');

// ロゴサイズ（単位：ピクセル）大きくしすぎるとQRコードが読み取りできないので注意
//$qrCode->setLogoSize(20, 20);

//DLファイルとしない場合
//header('Content-Type: '.$qrCode->getContentType());

echo $qrCode->writeString();
 $file = 'qr_code.png';

// 2.コンテンツタイプを「ダウンロード」にする
header('Content-Type: application/force-download');
// 3.ファイルサイズを取得して設定する
header('Content-Length: '.filesize($file));
// 4.ダウンロードする「ファイル名」を指定する。
header('Content-Disposition: attachment; filename="'.$file.'"');
 
// 5.ファイルを読み込む
readfile($file);

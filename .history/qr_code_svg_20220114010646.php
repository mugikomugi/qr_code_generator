<?php
require_once(__DIR__ . '/vendor/autoload.php');

use Endroid\QrCode\QrCode;

$qrCodeData = 'https://gallery.okamechan.com/';
// QRコードに埋め込む文字列の指定
$qrCode = new QrCode($qrCodeData);

$qrCode ->setEncoding('UTF-8');
// QRコードのサイス（単位：ピクセル）
$qrCode->setSize(100);

// QRコードの周囲の余白（単位：ピクセル）
$qrCode->setMargin(10);

// QRコードの色（RGBAで指定）
$qrCode->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0, 'a' => 1]);

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
//画像表示
echo $qrCode->writeString();



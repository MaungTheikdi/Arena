<?php
include('phpqrcode/qrlib.php');
$text = 'adfsfsf';
$file = 'qrcode.png';
QRcode::png($text, $file);
QRcode::png($text);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    <img src="qrcode.png" alt="QR Code">
</body>
</html>

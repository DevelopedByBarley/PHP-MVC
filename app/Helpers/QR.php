<?php

namespace App\Helpers;

use chillerlan\QRCode\QrCode;
use chillerlan\QRCode\QROptions;

class QR
{
    public function generate(): void
    {
        $qr_id = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT); // 8 számjegy

        $qr_code_path = 'public/assets/images/qr_codes/qr_code_' . $qr_id . '.svg';
        $options = new QROptions();
        $options->outputBase64 = false;
        $options->cachefile = $qr_code_path;

        $qrcode = new QRCode($options);
        $qrcode->render($qr_id);
    }
}

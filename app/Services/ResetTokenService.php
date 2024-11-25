<?php

namespace App\Services;

class ResetTokenService
{

    public function createResetUrl($tokenData)
    {
        return APP_URL . '/reset?token=' . urlencode($tokenData['token']) . '&expires=' . urlencode($tokenData['expires']);
    }

    public function generateExpiresTokenByDays($days)
    {
        $token = bin2hex(random_bytes(16));
        $expires = time() + ($days * 24 * 60 * 60);
        return [
            'token' => $token,
            'expires' => $expires,
        ];
    }

    public function generateExpiresTokenByHours($hours)
    {
        $token = bin2hex(random_bytes(16));
        $expires = time() + ($hours * 60 * 60);
        return [
            'token' => $token,
            'expires' => $expires,
        ];
    }
}

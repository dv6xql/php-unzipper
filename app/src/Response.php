<?php

namespace app\src;

class Response
{
    public static function success(string $message, ?array $data = null): string
    {
        return json_encode([
            'success' => 1,
            'message' => $message,
            'data' => $data
        ]);
    }

    public static function error(string $message): string
    {
        return json_encode([
            'success' => 0,
            'message' => $message,
        ]);
    }
}
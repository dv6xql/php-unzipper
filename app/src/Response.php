<?php

namespace app\src;

class Response
{
    public static function success(string $message, ?array $data = null): array
    {
        return [
            'success' => 1,
            'message' => $message,
            'data' => $data
        ];
    }

    public static function error(string $message): array
    {
        return [
            'success' => 0,
            'message' => $message,
        ];
    }

    public static function render(array $response): void
    {
        echo json_encode($response);
    }
}
<?php

use Illuminate\Http\Response;
use App\Constants\ResponseType;

if (!function_exists("res")) {
    /**
     * @param array $type get from App\Constants\ResponseType
     * @param string $message
     * @param array $data
     * @return Response
     */
    function res($type, $message = null, $data = null)
    {
        $response = [
            "status" => $type["status"],
            "rc" => $type["rc"],
            "rm" => $message ?? $type["message"],
            "data" => $data,
        ];

        return response()
            ->json($response, $type["code"])
            ->setEncodingOptions(JSON_UNESCAPED_SLASHES);
    }
}

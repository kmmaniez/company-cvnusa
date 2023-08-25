<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /* 
    * array $data, data yang akan dikirim
    * string $type, menandakan aksi yang terjadi
    * int $code, kode response dari server
    */
    public function sendResponse(array $data, string $type = 'created', int $code = 200)
    {
        $response = [
            ...$data,
            'message'   => 'Data '.$type.' successfully!',
            'code'      => $code,
        ];

        switch ($type) {
            case 'created':
                return response()->json([
                    ...$response,
                ]);
                break;
                
            case 'updated':
                return response()->json([
                    ...$response,
                ]);
                break;

            case 'deleted':
                return response()->json([
                    ...$response,
                ]);
                break;
            default:
                break;
        }
    }
}

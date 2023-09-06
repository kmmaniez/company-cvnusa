<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /* 
    * array $data, data yang akan dikirim
    * string $type, menandakan aksi yang terjadi
    * int $code, kode response
    */
    public function successResponse(array $data = null, string $type = 'created', int $code = 200)
    {
        $response = array(
            'status'    => 'success',
            'message'   => 'Data ' . $type . ' successfully!',
            'code'      => $code
        );
        
        // jika ada array data, maka menambah key data dengan value dari data parameter
        if ($data) {
            $response['data'] = $data;
        }

        return response()->json([
            ...$response
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function response($status, $message = [], $data = []): array
    {
        if($message['type'] == 'success'){
            $message = $message;
            $message['code'] = 200;
        }else if($message['type'] == 'warning'){
            $message = $message;
            $message['code'] == 300;
        }else if($message['type'] == 'error'){
            $message = $message;
            $message['code'] = 500;
        }else{
            return abort(500);
        }

        return ['transaccion' => ['status' => $status], 'data' => $data, 'message' => $message];
    }
}

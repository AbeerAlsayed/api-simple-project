<?php

namespace App\Http\Controllers\Api;

trait ApiResponseTrait
{
    public function apiRespons($data=null,$message=null,$status=null){
        $array=[
            'data'=>$data,
            'message'=>$message,
            'status'=>$status,
        ];
        return response($array,$status);
    }
}

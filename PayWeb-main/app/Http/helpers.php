<?php
if (! function_exists('convert_to_devvio')) {
    function convert_to_devvio($amount)
    {
        return $amount * pow(10,2);
    }
}

if (! function_exists('convert_balance')) {
    function convert_balance($amount)
    {
        return $amount / pow(10,2);
    }
}

function getJSONErrorResponse ($errorCode, $message) {
    return response()->json([
        'status'=>'fail',
        'error_code'=>$errorCode,
        'message'=>$message
    ], 422);
}

function getJSONSuccessResponse($data = []) {
    return response()->json([
        'status'=>'success',
        'data'=>$data,
        'error_code'=>null
    ], 200);
}
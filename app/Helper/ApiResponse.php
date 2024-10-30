<?php
namespace   App\Helper;

class ApiResponse{

    public static function sendresponse($code = 200,$message = null ,$data = null)
    {
        $response = [
            'status' =>$code,
            'message' => $message,
            'data' =>$data,
        ];
        return response()->json($response,$code);
    }
}

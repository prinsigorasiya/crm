<?php

use App\Models\ApiCallLog;
use App\Utility\Common;
use Carbon\Carbon;


if (!function_exists('dateFormatChange')) {
    function dateFormatChange($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)
            ->format('d-m-Y');
    }
}

if (!function_exists('api_call_log')) {
    function api_call_log($request_data, $response, $request_call)
    {
        $api_call_log = new ApiCallLog();
        $api_call_log->request_call = $request_call;
        $api_call_log->request_fields = $request_data;
        $api_call_log->response = $response;
        $api_call_log->user_id = auth()->user()->id;
        $api_call_log->ip_address = request()->ip();
        $api_call_log->url = request()->url();

        $api_call_log->save();
    }
}

if (!function_exists('sendJsonResponse')) {
    function sendJsonResponse($response)
    {
        return Common::sendJsonResponse($response);
    }
}
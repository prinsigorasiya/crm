<?php

namespace App\Http\Middleware;

use App\Models\ApiCallLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class LogRoute
{
    /**
     * Handle an incoming request.
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $apiCallLog = config('services.api_call_log.is_enable');

        if ($apiCallLog) {
            ApiCallLog::create([
                'request_call' => URL::current(),
                'request_fields' => json_encode($request->all()),
                'ip_address' => $request->ip(),
                'url' => $request->url(),
                'response' => json_encode($response),
                'user_id' => (isset($request->user->id) && ! empty($request->user->id)) ? $request->user->id : null,
            ]);
        }

        return $response;
    }
}

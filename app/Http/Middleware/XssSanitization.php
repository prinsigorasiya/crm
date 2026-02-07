<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class XssSanitization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $input = $request->all();
        foreach ($input as $key => $value) {
            $explode = explode('_', $key);
            if ($explode[0] == 'html') {
                $value = preg_replace('/<script\b[^>]*>(.*?)<\/script>|<figure\b[^>]*>(.*?)<\/figure>/is', '', $value);
                unset($input[$key]);
            } elseif ($key == 'registration_form_data') {
                $value = json_decode($value, true);
                foreach ($value as &$field) {
                    if (isset($field['type']) && $field['type'] === 'textarea') {
                        if (!empty($field['value'])) {
                            $field['value'] = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $field['value']);
                        }
                    } else {
                        foreach ($field as &$fieldValue) {
                            if (!is_array($fieldValue)) {
                                $fieldValue = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $fieldValue);
                                $fieldValue = strip_tags($fieldValue);
                            }
                        }
                    }
                }
                $input[$key] = json_encode($value);
            }
        }
        array_walk_recursive($input, function (&$input, $key) {
            if ($key !== 'registration_form_data') {
                $input = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $input);
                $input = strip_tags($input);
            }
        });
        $request->merge($input);

        return $next($request);
    }
}

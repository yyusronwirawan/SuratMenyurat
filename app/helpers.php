<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

if (!function_exists('is_current_route')) {
    /**
     * Compare the full URL of the given named route with the current full URL.
     *
     * @param  string  $routeName
     * @return bool
     */
    function is_current_route($routeName, $parameter = null)
    {
        try {
            // Get the full URL from the named route
            $fullUrlFromRoute = $parameter ? route($routeName, $parameter) : route($routeName);

            // Get the current full URL
            $currentFullUrl = Request::fullUrl();

            // Compare the URLs and return the result
            return $currentFullUrl === $fullUrlFromRoute ? "active" : null;
        } catch (\Exception $e) {
            // Return false if there is any error (e.g., the route name does not exist)
            return false;
        }
    }
}

<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
   /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies = '**';

    /**
     * The current proxy header mappings.
     *
     * @var array
     */
    
    protected $headers = [

            Illuminate\Http\Request::HEADER_FORWARDED    => null,
            Illuminate\Http\Request::HEADER_CLIENT_IP    => 'X_FORWARDED_FOR',
            Illuminate\Http\Request::HEADER_CLIENT_HOST  => null,
            Illuminate\Http\Request::HEADER_CLIENT_PROTO => 'X_FORWARDED_PROTO',
            Illuminate\Http\Request::HEADER_CLIENT_PORT  => 'X_FORWARDED_PORT',

    ];
}

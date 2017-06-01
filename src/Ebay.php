<?php

namespace Hkonnet\LaravelEbay;

class Ebay
{
    private $sdk;
    private $config;

    function __construct()
    {
        $sandbox = config('ebay.mode') == 'sandbox'?true:false;
        $config = [
            'credentials' => config('ebay.'.config('ebay.mode').'.credentials'),
            'siteId'     => config('ebay.siteId'),
            'sandbox' => $sandbox
        ];

        $this->config = $config;
    }

    function __call($name, $arguments)
    {
        if (strpos($name, 'create') === 0) {
            $service = 'create'.substr($name, 6);
            $configuration = isset($args[0]) ? $args[0] : [];
            return $this->sdk->$service($configuration);
        }
    }

    public function getAuthToken(){
        return config('ebay.'.config('ebay.mode').'.authToken');
    }

    public function getConfig(){
        return $this->config;
    }
}
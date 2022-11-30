<?php
namespace Ajung;

class Api
{
    protected $base_url = "https://asia.ajung.site/api";
    protected $app_key;

    public function __construct($app_key)
    {
        $this->app_key = $app_key;
    }

    public function call($method, $endpoint, $data = [])
    {
        $url = $this->base_url . $endpoint;

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'appKey: ' . $this->app_key,
            ],
        ];

        $ch = curl_init();
        curl_setopt_array($ch, $options);
        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output);
    }
}
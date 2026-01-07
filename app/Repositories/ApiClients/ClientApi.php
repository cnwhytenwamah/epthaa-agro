<?php

namespace App\Repositories\ApiClients;

use stdClass;
use Exception;

class ClientApi
{
    protected $config;
    protected $curl;
    protected $headers;
    

    /**
     * Make an API request
     *
     * @param string $method HTTP method (GET, POST, etc.)
     * @param string $endpoint API endpoint
     * @param array $data Request payload (optional)
     * @return stdClass
     */
    public function makeRequest(string $method, string $url, string|array $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, $method === "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);    
  
        if(!empty($data)){
            if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
        }

        try{
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if ($response === false) {
                return (object)['status'=>true, 'message'=>curl_error($ch), 'data'=>null, 'code'=>$httpCode];
            }
            
            $data = json_decode($response);
            if($httpCode >= 200 && $httpCode < 300){
                return (object)['status'=>true, 'message'=>'processed succesfully', 'data'=>$data, 'code'=>$httpCode];
            }
            return (object)['status'=>false, 'message'=>'', 'data'=>$data, 'code'=>$httpCode];
            
        }catch(Exception $e){
            return (object)['status'=>false, 'message'=>$e->getMessage(), 'code'=>500];
        }
    }

    /**
     * Shortcut for GET request
     * @return stdClass
     */
    public function get(string $url): stdClass
    {
        return $this->makeRequest('GET', $url);
    }

    /**
     * Shortcut for POST request
     * @return stdClass
     */
    public function post(string $url, string|array $data): stdClass
    {
        $url = $this->config->base_url.'/'.$url;
        return $this->makeRequest('POST', $url, $data);
    }
}
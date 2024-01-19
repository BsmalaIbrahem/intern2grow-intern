<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ProxyService
{
    public function getUrlResponse($data)
    {
        $header = $this->getData($data['header']);
        $body   = $this->getData($data['body']);
        $response = Http::withHeaders($header);
        return $this->getResponse($response, $data, $body);
    }

    private function getData($request)
    {
        if(!$request){
            return [];
        }
        return $request;
    }

    private function getResponse($response, $data, $body)
    {
        $type = $data['key']; $url = $data['url'];
        if($type === 'get'){
            return $response->get($url, $body);
        }
        if($type === 'post'){
            return $response->post($url, $body);
        }
        if($type === 'put'){
            return $response->put($url, $body);
        }
        return $response->delete($url, $body);
    }

}

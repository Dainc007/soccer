<?php

namespace App\APIs;

use Illuminate\Support\Facades\Http;

class Youtube extends Api implements \App\Interfaces\ApiInterface
{
    protected string $apiKey   = 'AIzaSyAC0gtykjQdzIft1GcFtMja4Gt2lZkT_EA';
    protected string $chanelId = 'UCpryVRk_VDudG8SHXgWcG0w';

    private static Youtube $instance;
    private mixed $response;

    private function __construct()
    {
        //
    }


    /**
     * @return Youtube
     */
    public static function getInstance(): Youtube
    {
        if(empty(self::$instance))
        {
            self::$instance = new Youtube();
        }
        return self::$instance;
    }

    public function getVideos()
    {
        $url = "https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId=$this->chanelId&maxResults=10&key=$this->apiKey";

        $this->response = Http::get($url);
        if($this->response->successful())
        {
            return $this->processResponse();
        }
    }

    private function processResponse()
    {
        return ($this->response->body());
    }
}

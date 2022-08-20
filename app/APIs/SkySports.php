<?php

namespace App\APIs;

use Illuminate\Support\Facades\Http;

class SkySports extends Api implements \App\Interfaces\ApiInterface
{
    private static SkySports $instance;
    private mixed $response;

    private function __construct()
    {
        //
    }


    /**
     * @return SkySports
     */
    public static function getInstance(): SkySports
    {
        if(empty(self::$instance))
        {
            self::$instance = new SkySports();
        }
        return self::$instance;
    }

    public function getArticles($teamName = '')
    {
        $url = "https://skysportsapi.herokuapp.com/sky/football/getteamnews/$teamName/v1.0/";
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

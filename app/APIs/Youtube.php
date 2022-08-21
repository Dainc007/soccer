<?php

namespace App\APIs;

use Illuminate\Support\Facades\Http;

class Youtube extends Api implements \App\Interfaces\ApiInterface
{
    protected string $apiKey     = 'AIzaSyAC0gtykjQdzIft1GcFtMja4Gt2lZkT_EA';
    protected string $baseUrl    = 'https://www.googleapis.com/youtube/v3/search?order=date&part=snippet';
    protected string $channelId  = 'UCpryVRk_VDudG8SHXgWcG0w';
    protected string $maxResults = '10';
    protected const CHANNELS_ID = [
        'arsenal'         =>  'UCpryVRk_VDudG8SHXgWcG0w',
        'manchester-city' => 'UCkzCjdRMrW2vXLx8mvPVLdQ',
        'liverpool'       => 'UC9LQwHZoucFT94I2h6JOcjw',
        'chelsea'         => 'UCU2PacFf99vhb3hNiYDmxww',
        'tottenham'       => 'UCEg25rdRZXg32iwai6N6l0w',
        'west-ham'        => 'UCCNOsmurvpEit9paBOzWtUg',
        'fulham'          => 'UC2VLfz92cTT8jHIFOecC-LA',
        'brentford'       => 'UCAalMUm3LIf504ItA3rqfug',
        'newcastle'       => 'UCywGl_BPp9QhD0uAcP2HsJw',
        'leeds'           => 'UCyQcJHDN4uYfPa1DHzKVSnw',
        'brighton'        => 'UCf-cpC9WAdOsas19JHipukA',
        'cristal-palace'  => 'UCWB9N0012fG6bGyj486Qxmg',
        'everton'         => 'UCtK4QAczAN2mt2ow_jlGinQ',
        'southampton'     => 'UCxvXjfiIHQ2O6saVx_ZFqnw',
        'aston-villa'     => 'UCICNP0mvtr0prFwGUQIABfQ',
        'bournemouth'     => 'UCeOCuVSSweaEj6oVtJZEKQw',
        'wolverhampton-wanderers' => 'UCQ7Lqg5Czh5djGK6iOG53KQ',
        'leicester-city'  => 'UCBkRQtxofyXr09mWtgoUUqw',
        'manchester-united' => 'UC6yW44UGJJBvYTlfC7CRg2Q',
        'nottingham-forrest' => 'UCyAxjuAr8f_BFDGCO3Htbxw',
    ];

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

    public function getVideos(string $teamName = '')
    {
        $channelId = Youtube::CHANNELS_ID[$teamName];
        $url = "$this->baseUrl&channelId=$channelId&maxResults=$this->maxResults&key=$this->apiKey";

        $this->response = Http::get($url);
        if($this->response->successful())
        {
            return $this->processResponse();
        }
    }

    public function processResponse()
    {
        return ($this->response->body());
    }

    public static function getAvailableTeams(): array
    {
         $teamNames = array_keys(self::CHANNELS_ID);
         sort($teamNames);
         return $teamNames;
    }
}

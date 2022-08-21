<?php

namespace App\Http\Controllers;

use App\APIs\SkySports;
use App\APIs\Youtube;


use Goutte\Client;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        if($request['teamName'])
        {
            $skySportsApi = SkySports::getInstance();
            $articles     = $skySportsApi->getArticles($request['teamName']);
            $articles     = json_decode($articles, true);

            $youtubeApi = Youtube::getInstance();
            $videos     = $youtubeApi->getVideos($request['teamName']);
            $videos     = json_decode($videos);
        }

        return view('index', [
                'data'   => $articles ?? [],
                'videos' => $videos ?? [],
            'availableTeams' => Youtube::getAvailableTeams() ?? []
            ]);
    }
}

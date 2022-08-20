<?php

namespace App\Http\Controllers;

use App\APIs\SkySports;
use App\APIs\Youtube;


use Goutte\Client;

class PageController extends Controller
{
    public function index()
    {
        $skySportsApi = SkySports::getInstance();
        $articles     = $skySportsApi->getArticles('arsenal');
        $articles     = json_decode($articles, true);

        $youtubeApi = Youtube::getInstance();
        $videos     = $youtubeApi->getVideos();
        $videos     = json_decode($videos);

        return view('index', ['data' => $articles ?? [], 'videos' => $videos ?? []]);
    }
}

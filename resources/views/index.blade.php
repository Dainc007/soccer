@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <form action="{{route('index')}}">
                @csrf
                @method('get')
                <select name="teamName" onchange="this.form.submit()" class="form-select" aria-label="Default select example">
                    <option selected>Who You want to watch?</option>
                    @foreach($availableTeams as $teamName)
                        <option value="{{$teamName}}">{{ ucwords((str_replace('-', ' ', $teamName)))}}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="row">
            @foreach($data as $record)
                <div class="col-lg-4">
                    <div class="card h-100 my-1 shadow mt-1">
                        <img class="card-img" src="{{$record['imgsrc']}}" title="{{$record['title']}}">
                        <a href="{{$record['link']}}}" target="_blank">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{$record['title']}}</h5>
                                <p class="card-text">{{$record['shortdesc']}}</p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            @if($videos)
                @foreach($videos->items as $item)
                    @if(isset($item->id->videoId))
                        <div class="col-lg-4">
                            <div class="card h-100 my-1 shadow mt-1">
                                <div class=" text-center h-100 w-100 embed-responsive embed-responsive-16by9">
                                    <iframe height="300" class="w-100 embed-responsive-item"
                                            src="https://www.youtube.com/embed/{{$item->id->videoId}}"
                                            allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif

        </div>
    </div>
@endsection

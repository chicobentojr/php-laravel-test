@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Favorites</div>

                <div class="panel-body">
                    <a href="{{route('favorites.artists')}}">Artists</a>
                    <br />
                    <a href="{{route('favorites.albums')}}">Albums</a>
                    <br />
                    <a href="{{route('favorites.tracks')}}">Tracks</a>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

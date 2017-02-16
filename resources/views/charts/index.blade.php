@extends('layouts.app')
@section('content')
@verbatim
<div class="container" ng-app="mySpotify" ng-controller="chartsController as vm">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Charts</div>
        <div class="panel-body">
          <p>Search any <b>Artist</b> from Spotify Api</p>
            <form class="form-horizontal" role="form">
                <div class="col-lg-12">
                  <label for="query">Artist:</label>
                  <div class="input-group">
                    <input ng-model="vm.search" ng-change="vm.change()" type="text" class="form-control" autofocus>
                    <span class="input-group-btn">
                      <button class="btn btn-primary" ng-click="vm.searchClick()">Search</button>
                    </span>
                  </div>
                </div>
            </form>
        </div>
			</div>
      <div class="row">
  			<div class="col-md-4">
  				<div ng-if="vm.artists" class="panel panel-default">
  					<div class="panel-heading">
  						Results for "{{ vm.query }}" at "Artist"
  					</div>
  					<div class="panel-body">
  						<div ng-repeat="artist in vm.artists" class="media">
  							<div class="media-left">
  								<a href="#">
  									<img width="100" height="100" class="media-object" src="{{artist.images[0].url}}">
  								</a>
  							</div>
  							<div class="media-body">
  								<h4 class="media-heading"><a href="#" ng-click="vm.selectArtist(artist)">{{ artist.name }}</a></h4>
  								<h5>Popularity: {{ artist.popularity }}</h4>
  							</div>
  						</div>
  					</div>
  				</div>
  			</div>
  			<div class="col-md-8">
  				<div ng-show="vm.chartLoaded" class="panel panel-default">
            <div class="panel-heading">
  					  	{{ vm.chartHeader }}
  					</div>
  					<div ng-show="vm.isChartComplete" class="panel-body">
  						<div id="albumChart" style="min-height:400px;"></div>
  					</div>
  				</div>
        </div>
      </div>
    </div>
  </div>
</div>
@endverbatim
@endsection

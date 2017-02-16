@extends('layouts.app')
@section('content')
@verbatim
<div class="container" ng-app="mySpotify" ng-controller="chartsController as vm">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
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
			<div class="col-md-6">
				<div ng-if="vm.results" class="panel panel-default">
					<div class="panel-heading">
						Results for "{{ vm.query }}" at "Artist"
					</div>
					<div class="panel-body">
						<div ng-repeat="item in vm.results" class="media">
							<div class="media-left">
								<a href="#">
									<img width="100" height="100" class="media-object" src="{{item.images[0].url}}">
								</a>
							</div>
							<div class="media-body">
								<h4 class="media-heading"><a href="#" ng-click="vm.selectItem(item)">{{ item.name }}</a></h4>
								<h5>Popularity: {{ item.popularity }}</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div ng-if="vm.selectedItem" class="panel panel-default">
					<div class="panel-heading">
						{{ vm.selectedItem.name }} Selected!
					</div>
				</div>
			</div>
    </div>
  </div>
</div>
@endverbatim
@endsection

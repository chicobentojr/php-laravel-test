(function(){
  'use strict';

  angular
    .module('mySpotify', [])
    .controller('chartsController', function($http) {

      const chartDataDefault = {
        limit: 3,
        albums: {
          tracks: [],
          titles: []
        }
      };

      let vm = this;
      vm.search = 'coldplay';
    	vm.query = '';
      vm.artists = false;
      vm.albums = false;
      vm.loading = false;
      vm.chartLoaded = false;
      vm.chartData = {};

      vm.searchClick = function() {
        if (vm.search) {

          vm.query = vm.search;
          vm.selectedArtist = false;
          vm.chartLoaded = false;
          vm.chartData = {
            limit: 3,
            albums: {
              tracks: [],
              titles: []
            }
          };
          vm.myChart.setOption(vm.chartData);

          $http.get('https://api.spotify.com/v1/search',{
            params: {
              q: vm.search,
              type: 'artist'
            }
          }).then(function(result) {
            vm.artists = result.data.artists.items;
          }, function(erro){
            console.log('erro');
          });
        }
      }

      vm.getAlbumData = function(index = 0){
        if (index < vm.chartData.limit){
          var album = vm.albums[index];
          $http.get('https://api.spotify.com/v1/albums/'+album.id)
          .then(function(result) {
            vm.chartData.albums.tracks.push(result.data.tracks.total);
            vm.chartData.albums.titles.push(result.data.name);
            vm.getAlbumData(index + 1);
          }, function(erro){

          });
        }
        else {
          vm.updateChart();
          return;
        }
      }

      vm.selectArtist = function(artist){
        vm.selectedArtist = artist;
        vm.loading = true;
        $http.get('https://api.spotify.com/v1/artists/'+artist.id+'/albums')
        .then(function(result) {
          vm.albums = result.data.items;
          console.log(vm.albums, vm.albums.length);
          if (vm.albums.length >= vm.chartData.limit) {
            vm.getAlbumData();
          }
          else {
            vm.albums = false;
            vm.updateChart();
          }
        }, function(erro){
          console.log('erro');
        });
      }

      vm.updateChart = function() {
        vm.chartLoaded = true;
        if (vm.albums && vm.chartData) {
          vm.isChartComplete = true;
          vm.chartHeader = "Number of tracks from "+ vm.selectedArtist.name +"'s albums";
          vm.myChart.setOption({
            tooltip: {
              formatter: function(params){
                return params.name + ' | ' + params.data;
              }
            },
            legend: {
                data:['Number of tracks']
            },
            xAxis: {
                data: vm.chartData.albums.titles
            },
            yAxis: {},
            series: [{
                name: 'Number of tracks',
                type: 'bar',
                data: vm.chartData.albums.tracks
            }]
          });
        }
        else {
          vm.chartHeader = "The selected Artist doesn't have albums enough!";
          vm.isChartComplete = false;
        }
      }

      vm.myChart = echarts.init(document.getElementById('albumChart'));
  });
})();

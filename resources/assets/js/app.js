(function(){
  'use strict';

  angular
    .module('mySpotify', [])
    .controller('chartsController', function($http) {

      let vm = this;
      vm.search = '';
    	vm.query = '';
      vm.artists = false;
      vm.albums = false;
      vm.loading = false;
      vm.chartLoaded = false;
      vm.chartData = {};

      vm.clearChartData = function() {
        vm.chartData = {
          limit: 10,
          albums: {
            tracks: [],
            titles: []
          }
        };
      }

      vm.searchClick = function() {
        if (vm.search) {
          vm.clearChartData();
          vm.query = vm.search;
          vm.selectedArtist = false;
          vm.chartLoaded = false;
          vm.myChart.setOption(vm.chartData);

          $http.get('https://api.spotify.com/v1/search',{
            params: {
              q: vm.search,
              type: 'artist'
            }
          }).then(function(result) {
            vm.artists = result.data.artists.items;
          }, function(erro){
            vm.error = true;
          });
        }
      }

      vm.selectArtist = function(artist){
        vm.clearChartData();
        vm.selectedArtist = artist;
        vm.myChart.showLoading();
        vm.loading = true;
        $http.get('https://api.spotify.com/v1/artists/'+artist.id+'/albums')
        .then(function(result) {
          vm.albums = result.data.items;
          vm.getAlbumData();
        }, function(erro){
          vm.error = true;
        });
      }

      vm.getAlbumData = function(index = 0, quantity = 0){
        if (quantity < vm.chartData.limit && index < vm.albums.length){
          var album = vm.albums[index];
          $http.get('https://api.spotify.com/v1/albums/'+album.id)
          .then(function(result) {
            if (vm.chartData.albums.titles.indexOf(result.data.name) < 0){
              quantity++;
              vm.chartData.albums.tracks.push(result.data.tracks.total);
              vm.chartData.albums.titles.push(result.data.name);
            }
            vm.getAlbumData(index + 1, quantity);
          }, function(erro){
            vm.error = true;
          });
        }
        else {
          vm.updateChart();
          return;
        }
      }

      vm.updateChart = function() {
        if (vm.albums && vm.chartData) {
          vm.chartError = false;
          vm.chartHeader = "Number of tracks of "+ vm.selectedArtist.name +"'s albums";
          vm.myChart.setOption({
            tooltip: {
              formatter: function(params){
                return params.name + ' | ' + params.data + ' Tracks';
              }
            },
            legend: {
                data:['Number of tracks']
            },
            xAxis: { },
            yAxis: {
              data: vm.chartData.albums.titles,
              axisLabel: {
                show: false
              }
            },
            series: [{
                name: 'Number of tracks',
                type: 'bar',
                minBarHeight: 30,
                data: vm.chartData.albums.tracks,
                itemStyle: {
                  normal: {
                    label : {
                      show: true,
                      position: 'insideLeft',
                      formatter: '{b} | {c} Tracks'
                    }
                  }
                }
            }]
          });
        }
        else {
          vm.chartHeader = "The selected Artist doesn't have albums enough!";
          vm.chartError = true;
        }
        vm.myChart.hideLoading();
      }

      vm.myChart = echarts.init(document.getElementById('albumChart'));
  });
})();

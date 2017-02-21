/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.l = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };

/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};

/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};

/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "./";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

(function () {
  'use strict';

  angular.module('mySpotify', []).controller('chartsController', function ($http) {

    var vm = this;
    vm.search = '';
    vm.query = '';
    vm.artists = false;
    vm.albums = false;
    vm.loading = false;
    vm.chartLoaded = false;
    vm.chartData = {};

    vm.clearChartData = function () {
      vm.chartData = {
        limit: 10,
        albums: {
          tracks: [],
          titles: []
        }
      };
    };

    vm.searchClick = function () {
      if (vm.search) {
        vm.clearChartData();
        vm.query = vm.search;
        vm.selectedArtist = false;
        vm.chartLoaded = false;
        vm.myChart.setOption(vm.chartData);

        $http.get('https://api.spotify.com/v1/search', {
          params: {
            q: vm.search,
            type: 'artist'
          }
        }).then(function (result) {
          vm.artists = result.data.artists.items;
        }, function (erro) {
          vm.error = true;
        });
      }
    };

    vm.selectArtist = function (artist) {
      vm.clearChartData();
      vm.selectedArtist = artist;
      vm.myChart.showLoading();
      vm.loading = true;
      $http.get('https://api.spotify.com/v1/artists/' + artist.id + '/albums').then(function (result) {
        vm.albums = result.data.items;
        vm.getAlbumData();
      }, function (erro) {
        vm.error = true;
      });
    };

    vm.getAlbumData = function () {
      var index = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      var quantity = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;

      if (quantity < vm.chartData.limit && index < vm.albums.length) {
        var album = vm.albums[index];
        $http.get('https://api.spotify.com/v1/albums/' + album.id).then(function (result) {
          if (vm.chartData.albums.titles.indexOf(result.data.name) < 0) {
            quantity++;
            vm.chartData.albums.tracks.push(result.data.tracks.total);
            vm.chartData.albums.titles.push(result.data.name);
          }
          vm.getAlbumData(index + 1, quantity);
        }, function (erro) {
          vm.error = true;
        });
      } else {
        vm.updateChart();
        return;
      }
    };

    vm.updateChart = function () {
      if (vm.albums && vm.chartData) {
        vm.chartError = false;
        vm.chartHeader = "Number of tracks of " + vm.selectedArtist.name + "'s albums";
        vm.myChart.setOption({
          tooltip: {
            formatter: function formatter(params) {
              return params.name + ' | ' + params.data + ' Tracks';
            }
          },
          legend: {
            data: ['Number of tracks']
          },
          xAxis: {},
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
                label: {
                  show: true,
                  position: 'insideLeft',
                  formatter: '{b} | {c} Tracks'
                }
              }
            }
          }]
        });
      } else {
        vm.chartHeader = "The selected Artist doesn't have albums enough!";
        vm.chartError = true;
      }
      vm.myChart.hideLoading();
    };

    vm.myChart = echarts.init(document.getElementById('albumChart'));
  });
})();

/***/ }),
/* 1 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 2 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(0);
module.exports = __webpack_require__(1);


/***/ })
/******/ ]);
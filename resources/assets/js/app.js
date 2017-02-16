(function(){
  'use strict';

  angular
    .module('mySpotify', [])
    .controller('chartsController', function($http) {
      let vm = this;
      vm.search = '';
    	vm.query = '';
      vm.results = false;
    	vm.loading = false;

    	vm.init = function() {
    	}

      vm.searchClick = function() {
        if (vm.search) {
          vm.loading = true;
          vm.query = vm.search;
          vm.selectedItem = false;
          $http.get('https://api.spotify.com/v1/search',{
            params: {
              q: vm.search,
              type: 'artist'
            }
          }).then(function(result) {
            vm.results = result.data.artists.items;
            vm.loading = false;
          }, function(erro){
            console.log('erro');
          });
        }
      }

      vm.selectItem = function(item){
        vm.selectedItem = item;
      }

    	vm.addTodo = function() {
    	  vm.loading = true;
        vm.todos.push({
          title: vm.todo.title,
          done: vm.todo.done
        });
        vm.todo = '';
    	  vm.loading = false;
    	};

    	vm.updateTodo = function(todo) {
    		vm.loading = true;
    		let data = {
    			title: todo.title,
    			done: todo.done
    		};
        console.log(todo, data);
    		todo = data;
    		vm.loading = false;
    	};

    	vm.deleteTodo = function(index) {
    		vm.loading = true;

    		var todo = vm.todos[index];

    		vm.todos.splice(index, 1);
    		vm.loading = false;
    	};

    	vm.init();
  });
})();

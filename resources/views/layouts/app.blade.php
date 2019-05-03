<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Logarse') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.11/lodash.core.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/2.5.0/ui-bootstrap-tpls.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.7.8/angular-animate.js"></script>

    <script>
        angular.module('app', ['ui.bootstrap'], function ($interpolateProvider) {
            $interpolateProvider.startSymbol('[[');
            $interpolateProvider.endSymbol(']]');
        })
        .controller('userListsController', function ($scope, $http) {
            var endpoint = '/api/users';

            $scope.users = [];
            $scope.editUserId = null;
            $scope.createUserForm = false;
            $scope.createUser = {
                name: '',
                lastname: '',
                ci: '',
                role: '',
                password: ''
            };

            $scope.init = function (users) {
                $scope.users = users;
            }

            $scope.edit = function (id) {
                $scope.editUserId = _.findIndex($scope.users, function (o) {
                    return o.id === id
                });
            }

            $scope.save = function (id, editUserId) {
                $http.put(`${endpoint}/${id}`, $scope.users[editUserId])
                .then(function (response) {
                    $scope.close('edit');
                })
            }

            $scope.delete = function (id) {
                $http.delete(`${endpoint}/${id}`)
                .then(function (response) {
                    _.remove($scope.users, function(o) {
                        return o.id === id;
                    });
                });
            }

            $scope.create = function () {
                $http.post(endpoint, $scope.createUser)
                .then(function (response) {
                    $scope.close('create');
                })
            }
            
            $scope.close = function (string) {
                switch (string) {
                    case 'edit':
                        $scope.editUserId = null;
                    break;

                    case 'create':
                        $scope.createUserForm = null
                    break;
                }
            }
        });
    </script>
</body>
</html>

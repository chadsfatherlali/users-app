@extends('layouts.app')

@section('content')
<div class="container" ng-app="app">
    <div class="row justify-content-center" ng-controller="userListsController" ng-init="init({{ json_encode($users) }})">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Panel de usuarios</div>

                <button type="button" class="btn btn-primary" ng-click="createUserForm = true">Crear usuario</button>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul ng-if="users" class="list-group">
                    
                        <li ng-repeat="user in users" class="list-group-item d-flex justify-content-between align-items-center">
                            [[ user.name ]]

                            @if($user->role === "ADMIN")
                            <div ng-if="user.role === 'USER'" class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-success" ng-click="edit(user.id)">Editar</button>
                                <button type="button" class="btn btn-danger"ng-click="delete(user.id)">Borrar</button>
                            </div>
                            @endif
                        </li>                            
                    </ul>
                </div>
            </div>

            <div ng-if="editUserId" class="card">
                <div class="card-header">Crear usuario</div>

                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" ng-model="users[editUserId].name" value="[[ users[editUserId].name ]]" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="test" class="form-control" name="lastname" ng-model="users[editUserId].lastname" value="[[ users[editUserId].lastname ]]" required autocomplete="lastname" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ci" class="col-md-4 col-form-label text-md-right">{{ __('Cédula de identidad') }}</label>

                            <div class="col-md-6">
                                <input id="ci" type="text" class="form-control" name="ci" ng-model="users[editUserId].ci" value="[[ users[editUserId].ci ]]" required autocomplete="ci" autofocus>
                            </div>
                        </div>
                        
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-success" ng-click="save(users[editUserId].id, editUserId)">Guardar</button>
                            <button type="button" class="btn btn-danger"ng-click="close('edit')">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div ng-if="createUserForm" class="card">
                <div class="card-header">Modificar datos</div>

                <div class="card-body">
                    <form>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" ng-model="createUser.name" value="" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="test" class="form-control" name="lastname" ng-model="createUser.lastname" value="" required autocomplete="lastname" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="test" class="form-control" name="email" ng-model="createUser.email" value="" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ci" class="col-md-4 col-form-label text-md-right">{{ __('Cédula de identidad') }}</label>

                            <div class="col-md-6">
                                <input id="ci" type="text" class="form-control" name="ci" ng-model="createUser.ci" value="" required autocomplete="ci" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>

                            <div class="col-md-6">
                            <select id="role" name="role" ng-model="createUser.role">
                                <option value="USER" selected="selected">User</option>
                                <option value="ADMIN">Admin</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" ng-model="createUser.password" value="" required autocomplete="password" autofocus>
                            </div>
                        </div>
                        
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-success" ng-click="create()">Guardar</button>
                            <button type="button" class="btn btn-danger"ng-click="close('create')">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

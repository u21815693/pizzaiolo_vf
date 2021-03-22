@extends('layouts.app')

@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Ajouter un nouveau utilisateur</h2>
                    </div>
                    <div style="text-align: end" class="pull-right">
                        <a class="btn btn-primary" href="{{ route('user.index') }}"> Back</a>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input required type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Login:</strong>
                            <input required type="text"
                                   name="login" class="form-control" placeholder="Enter Login">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Mot de passe:</strong>
                            <input required type="password" name="password" class="form-control"
                                   placeholder="********">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Type:</strong>
                            <select required
                                    name="type" class="form-control">
                                <option value="user">
                                    User
                                </option>
                                <option value="admin">
                                    Admin
                                </option>
                                <option value="pizza">
                                    Pizza
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

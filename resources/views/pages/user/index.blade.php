@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Utilisateurs</h2>
                    </div>
                    <div style="text-align: end" class="pull-right">
                        <a class="btn btn-success" href="{{ route('user.create') }}"> Créer un nouveau utilisateurs</a>
                    </div>
                </div>
            </div>
            <br>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <table class="table table-bordered">
                <tr>
                    <th>Num</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Login</th>
                    <th>Type</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->nom }}</td>
                        <td>{{ $user->prenom }}</td>
                        <td>{{ $user->login }}</td>
                        <td>{{ $user->type }}</td>
                        <td>
                            <form action="{{ route('user.destroy',$user->id) }}" method="POST">

                                @if($user->type != 'user')
                                    <a class="btn btn-primary" href="{{ route('user.edit',$user->id) }}">Modifier</a>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {!! $users->links() !!}
        </div>
    </div>
@endsection

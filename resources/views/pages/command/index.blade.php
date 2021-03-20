@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Commandes</h2>
                    </div>
                    {{--<div style="text-align: end" class="pull-right">
                        <a class="btn btn-success" href="{{ route('commande.create') }}"> Create New commande</a>
                    </div>--}}
                </div>
            </div>
            <br>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
                <form action="{{url('/commande/search')}}" method="post" role="search">
                    @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <strong>Date:</strong>
                                <input class="form-control" type="date" name="date" value="{{$searchData['date']}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <strong>Status:</strong>
                                <select
                                    name="status" class="form-control">
                                    <option value="">
                                        Choose status
                                    </option>
                                    @if($searchData['status'] == 'en traitement')
                                        <option value="traitées">
                                            Traitées
                                        </option>
                                        <option value="envoyé">
                                            Envoyé
                                        </option>
                                        <option selected value="en traitement">
                                            En traitement
                                        </option>
                                        <option value="prête">
                                            Prête
                                        </option>
                                        <option value="récupérée">
                                            Récupérée
                                        </option>
                                    @elseif($searchData['status']  == 'prête')
                                        <option value="traitées">
                                            Traitées
                                        </option>
                                        <option value="envoyé">
                                            Envoyé
                                        </option>
                                        <option value="en traitement">
                                            En traitement
                                        </option>
                                        <option selected value="prête">
                                            Prête
                                        </option>
                                        <option value="récupérée">
                                            Récupérée
                                        </option>
                                    @elseif($searchData['status']  == 'traitées')
                                        <option selected value="traitées">
                                            Traitées
                                        </option>
                                        <option value="envoyé">
                                            Envoyé
                                        </option>
                                        <option value="en traitement">
                                            En traitement
                                        </option>
                                        <option value="prête">
                                            Prête
                                        </option>
                                        <option value="récupérée">
                                            Récupérée
                                        </option>
                                    @elseif($searchData['status']  == 'envoyé')
                                        <option value="traitées">
                                            Traitées
                                        </option>
                                        <option selected value="envoyé">
                                            Envoyé
                                        </option>
                                        <option value="en traitement">
                                            En traitement
                                        </option>
                                        <option value="prête">
                                            Prête
                                        </option>
                                        <option value="récupérée">
                                            Récupérée
                                        </option>
                                    @elseif($searchData['status']  == 'récupérée')
                                        <option value="traitées">
                                            Traitées
                                        </option>
                                        <option value="envoyé">
                                            Envoyé
                                        </option>
                                        <option value="en traitement">
                                            En traitement
                                        </option>
                                        <option value="prête">
                                            Prête
                                        </option>
                                        <option selected value="récupérée">
                                            Récupérée
                                        </option>
                                    @else
                                        <option value="traitées">
                                            Traitées
                                        </option>
                                        <option value="envoyé">
                                            Envoyé
                                        </option>
                                        <option value="en traitement">
                                            En traitement
                                        </option>
                                        <option value="prête">
                                            Prête
                                        </option>
                                        <option value="récupérée">
                                            Récupérée
                                        </option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <button style="margin-top: 6%;" title="Recheche" type="submit"
                                        class="margin pull-right tooltips btn btn-info">
                                    <span class="glyphicon glyphicon-search"></span> Recherche
                                </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Status</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($commande as $command)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $command->user->name }}</td>
                        <td>{{ $command->status }}</td>
                        <td>

                            <a class="btn btn-info" href="{{ route('commande.show',$command->id) }}">Show</a>
                            @if(\Illuminate\Support\Facades\Auth::user()->type == 'pizzaiolo')
                                <a class="btn btn-primary" href="{{ route('commande.edit',$command->id) }}">Edit</a>

                                <form action="{{ route('commande.destroy',$command->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
            {!! $commande->links() !!}
        </div>
    </div>
@endsection

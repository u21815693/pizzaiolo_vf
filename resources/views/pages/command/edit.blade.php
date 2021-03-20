@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit Commande</h2>
                    </div>
                    <div style="text-align: end" class="pull-right">
                        <a class="btn btn-primary" href="{{ route('commande.index') }}"> Back</a>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('commande.update',$commande->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>
                                User : {{ $commande->user->name }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-group">
                            <strong>Status:</strong>
                            <select required
                                    name="status" class="form-control">
                                @if($commande->status == 'en traitement')
                                    <option value="traitées">
                                        Traitées
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
                                @elseif($commande->status == 'prête')
                                    <option value="traitées">
                                        Traitées
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
                                @elseif($commande->status == 'récupérée')
                                    <option value="traitées">
                                        Traitées
                                    </option>
                                    <option value="en traitement">
                                        En traitement
                                    </option>
                                    <option value="prête">
                                        Prête
                                    </option>
                                    <option selected value="récupérée">
                                        Récupérée
                                    </option>@elseif($commande->status == 'traitées')
                                    <option selected value="traitées">
                                        Traitées
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
                                @else
                                    <option value="traitées">
                                        Traitées
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
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-start">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

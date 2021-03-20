@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Recette du jour</h2>
                    </div>
                    <div style="text-align: end" class="pull-right">
                        <a class="btn btn-primary" href="{{ route('commande.index') }}"> Back</a>
                    </div>
                </div>
            </div>
            <form action="{{url('/recette/search')}}" method="post" role="search">
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
                            <button style="margin-top: 6%;" title="Recheche" type="submit"
                                    class="margin pull-right tooltips btn btn-info">
                                <span class="glyphicon glyphicon-search"></span> Recherche
                            </button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="form-group">
                        <strong>
                            Recette : {{ $sum}}€
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Pizzaiolo</h2>
                    </div>
                    <div style="text-align: end" class="pull-right">
                        <a class="btn btn-success" href="{{ route('pizza.create') }}"> Creer une nouvelle pizza</a>
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
                    <th>Prix</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($pizzas as $pizza)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $pizza->nom }}</td>
                        <td>{{ $pizza->prix }}</td>
                        <td>{{ $pizza->description }}</td>
                        <td><img src="{{ asset('/uploads/images/'.$pizza->url)  }}" style="width: 40px; height: 40px; border-radius: 50%;">
                        </td>
                        <td>
                            <form action="{{ route('pizza.destroy',$pizza->id) }}" method="POST">

                              {{--  <a class="btn btn-info" href="{{ route('pizza.show',$pizza->id) }}">Show</a>--}}

                                <a class="btn btn-primary" href="{{ route('pizza.edit',$pizza->id) }}">Modifier</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            {!! $pizzas->links() !!}
        </div>
    </div>
@endsection

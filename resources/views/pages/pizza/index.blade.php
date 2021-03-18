@extends('layouts.app_template')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Pizzaiolo</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('pizza.create') }}"> Create New pizza</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($pizzas as $pizza)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $pizza->name }}</td>
            <td>{{ $pizza->detail }}</td>
            <td>
                <form action="{{ route('pizza.destroy',$pizza->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('pizza.show',$pizza->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('pizza.edit',$pizza->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $pizzas->links() !!}
      
@endsection
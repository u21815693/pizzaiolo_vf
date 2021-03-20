
@extends('layouts.app')
@section('content')
    <div class="card" style="margin: 2%;">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit Pizza</h2>
                    </div>
                    <div style="text-align: end" class="pull-right">
                        <a class="btn btn-primary" href="{{ route('pizza.index') }}"> Back</a>
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
            <form action="{{ route('pizza.update',$pizza->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="name" value="{{ $pizza->name }}" class="form-control"
                                   placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Price:</strong>
                            <input type="decimal" name="name" value="{{ $pizza->price }}" class="form-control"
                                   placeholder="Price">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Description:</strong>
                            <textarea class="form-control" style="height:150px" name="description"
                                      placeholder="Detail">{{ $pizza->description }}</textarea>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        @if ($pizza->url)
                            <img src="{{ asset('/uploads/images/'.$pizza->url) }}"
                                 style="width: 150px; height: 150px; border-radius: 50%;">
                        @endif
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div style="margin-top: 18%;" class="form-group">
                            <input accept="image/png, image/jpeg" id="image" type="file" name="image">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

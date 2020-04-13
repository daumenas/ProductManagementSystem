@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($categories as $category)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <div class="card-title"><h3>{{ $category->name }}</h3></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')

    <div class="breadcrumb">
        <div class="breadcrumbs-container container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="{{url('/categories')}}">Categories</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$categories->title}}</li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach($results as $result)
                <div class="col-sm-3 text-center">
                    <img src="/img/mac.png" class="rounded" alt="...">
                    <h6>{{$result->name}}</h6>
                    <h5>{{$result->price}}</h5>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('footer-scripts')

@endsection
@extends('layouts.app')

@section('content')

    <div class="breadcrumb">
        <div class="breadcrumbs-container container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item">Categories</li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @foreach($categories as $category)
                <div class="col-sm-3">
                    {{--<a href="" class="href"><img src="/img/logo.jpg" alt="Logo"></a>--}}
                    <a href="{{url('/showProdbyCat/'.$category->id)}}">{{$category->title}}</a>
                </div>
            @endforeach
        </div>
    </div>
w


@endsection

@section('footer-scripts')

@endsection
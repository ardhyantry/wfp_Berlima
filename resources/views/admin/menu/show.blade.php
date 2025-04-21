@extends('layout.adminSB')

@section('title','Menu Show')

@section('content')
<a class="btn btn-primary" href="{{url()->previous()}}"> Go Back </a>
<div class="container">
    <h1>{{ $food->name }}</h1>
    <h2>{{ $food->nutrition_fact }}</h2>
    <h3>{{ $food->category->name }}</h3>
    <h4>{{ $food->description }}</h4>
    <h5>{{ $food->price }}</h5>
</div>
@endsection
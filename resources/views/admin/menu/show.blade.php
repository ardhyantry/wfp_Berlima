@extends('layouts.adminSB')


@section('title','Menu Show')

@section('content')
<a class="btn btn-primary" href="{{url()->previous()}}"> Go Back </a>
<div class="container">
    <h1>{{ $menu->name }}</h1>
    <h2>{{ $menu->nutrition_fact }}</h2>
    <h3>{{ $menu->category->name }}</h3>
    <h4>{{ $menu->description }}</h4>
    <h5>{{ $menu->price }}</h5>
</div>
@endsection
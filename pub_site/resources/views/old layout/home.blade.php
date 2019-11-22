@extends('layout.app1')
@section('header')

<h1>menu</h1>
@if(count($menu))
    <ul>
    @foreach($menu as $item)
        <li>{{$item}}</li>
    @endforeach
    </ul>
@endif
@section('content')

@section('footer')

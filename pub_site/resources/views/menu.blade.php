@extends('layout.app')
@section('header')


<main class="page">
    <div id="space"></div>
    <div class="row">
        <div class="col">
            <ul class="list-unstyled text-center">
                <li>Products we sell</li>
                @if(count($menu))
                    <ul>
                        @foreach($menu as $item)
                            <li>{{$item}}</li>
                        @endforeach
                    </ul>
                @endif
            </ul>
        </div>
    </div>
</main>
@section('footer')

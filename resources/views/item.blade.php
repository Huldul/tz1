@extends('layouts/layout')

@section('content')
<div class="card" style="width: 100%">
    <img src="/img/{{$item->image}}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$item->title}}</h5>
      <p class="card-text text-bg-success">{{$item->price}}</p>
      <p class="card-text">{{$item->description}}</p>
      <p class="card-text">{{$item->category}}</p>
      <p class="card-text">{{$item->subcategory}}</p>
      <a href="/item/bucket/{{$item->id}}" class="btn btn-primary">Добавить в корзину</a>
    </div>
</div>
@if(session('message'))
    <script>
        alert("{{ session('message') }}");
    </script>
@endif

@endsection
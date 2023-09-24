@extends('layouts/layout')

@section('content')
@if ($nullB == 0)
  @if (count($items) > 1)
  @foreach ($items as $item)
  {{-- {{dd($item)}} --}}
  <h1>{{$item->title}}</h1>
    <div class="card mb-3">
        <img src="img/{{ $item->image}}" class="card-img-top" style="width: 300px; height: 200px;" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$item->title}}</h5>
          <p class="card-text">{{$item->category}}</p>
          <p class="card-text"><small class="text-muted">{{$item->uncategory}}</small></p>
          @if ($item->inValue = 1)
              <p class="badge bg-primary text-wrap">Есть в наличии</p>
              @else 
            <p class="badge bg-warning text-wrap">Нет в наличии</p>
          @endif
        </div>
        <a href="/bucket/delete/{{$item->id}}" class="btn btn-danger">Удалить из корзины</a>
      </div>
  @endforeach
      
  @else
  @if (empty($items))
  <h1>Корзина пуста</h1>
  @else
  <h1>{{$items[0]->title}}</h1>
  <div class="card mb-3">
      <img src="img/{{ $items[0]->image}}" class="card-img-top" style="width: 300px; height: 200px;" alt="...">
      <div class="card-body">
        <h5 class="card-title">{{$items[0]->title}}</h5>
        <p class="card-text">{{$items[0]->category}}</p>
        <p class="card-text"><small class="text-muted">{{$items[0]->uncategory}}</small></p>
        @if ($items[0]->inValue = 1)
            <p class="badge bg-primary text-wrap">Есть в наличии</p>
            @else 
          <p class="badge bg-warning text-wrap">Нет в наличии</p>
        @endif
      </div>
      <a href="/bucket/delete/{{$items[0]->id}}" class="btn btn-danger">Удалить из корзины</a>
    </div>
@endif
  @endif

@else
    <h1>Корзина пуста</h1>
@endif
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@endsection
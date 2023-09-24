@extends('layouts/layout')

@section('content')
    @foreach ($items as $item)
        {{-- {{dd($item)}} --}}
        <h1>{{$item->title}}</h1>
        <a href="/item/{{$item->id}}" class="list-group-item list-group-item-action" aria-current="true">
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
            </div>
        </a>
    @endforeach
@endsection
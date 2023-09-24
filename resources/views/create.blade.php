@extends('layouts/layout')

@section('content')
<form action="{{ route('admin.items.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="title">Название товара:</label>
        <input type="text" name="title" id="title" required>
    </div>

    <div>
        <label for="price">Цена:</label>
        <input type="number" name="price" id="price" min="0" step="0.01" required>
    </div>

    <div>
        <label for="image">Изображение:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
    </div>

    <div>
        <label for="description">Описание:</label>
        <textarea name="description" id="description" rows="4" required></textarea>
    </div>

    <div>
        <label for="inValue">В наличии:</label>
        <input type="checkbox" name="inValue" id="inValue" value="1">
    </div>

    <div>
        <p>Категория</p>
        <select class="form-select w-50" id="category" name="cat" aria-label="Пример выбора по умолчанию">
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{ $category->name }}</option>
            @endforeach
          </select>
    </div>

    <div>
        <p>Подкатегория</p>
        <select class="form-select w-50" id="subcategory" name="subcat" aria-label="Пример выбора по умолчанию">
            @foreach($subcategories as $subcategory)
                @if ($subcategory->parent_id > 0)
                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                @endif
            @endforeach
          </select>
    </div>

    <button type="submit">Создать товар</button>
</form>

<form action="/admin/create/category" method="POST">
    <h1>Создание категории</h1>
    @csrf
        <div>
            <label for="category_name">Название категории:</label>
            <input type="text" id="category_name" name="category_name" required>
        </div>
        <div id="subcategory_container">
            <label for="subcategory_1">Подкатегория 1:</label>
            <input type="text" id="subcategory_1" name="subcategories[]" required>
        </div>
        <button type="button" onclick="addSubcategory()">Добавить подкатегорию</button>
        <button type="submit">Сохранить</button>
</form>
<form action="/admin/category/delete" method="POST">
    @csrf
    <h1>Удалить категорию или подкатегорию</h1>
    <select class="form-select w-50" id="category" name="cat" aria-label="Пример выбора по умолчанию">
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{ $category->name }}</option>
        @endforeach
      </select>
      <button type="submit" class="mg-20px">Удалить </button>
</form>

<script>
    let subcategoryCount = 1;

    function addSubcategory() {
        if (subcategoryCount < 10) {
            subcategoryCount++;
            const container = document.getElementById('subcategory_container');
            const label = document.createElement('label');
            label.textContent = `Подкатегория ${subcategoryCount}:`;
            const input = document.createElement('input');
            input.type = 'text';
            input.id = `subcategory_${subcategoryCount}`;
            input.name = 'subcategories[]';
            input.required = true;
            container.appendChild(label);
            container.appendChild(input);
        }
    }
    document.addEventListener('DOMContentLoaded',function() {
    catAndsubcat(this);
});
    document.getElementById('category').addEventListener('click',function() {
    catAndsubcat(this);
});
    function catAndsubcat(element){

        var categoryId = element.value;
        var xhr = new XMLHttpRequest();

        xhr.open('GET', '/get-subcategories/' + categoryId, true);

        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                var data = JSON.parse(xhr.responseText);
                var subcategorySelect = document.getElementById('subcategory');
                subcategorySelect.innerHTML = '';

                data.forEach(function(subcategory) {
                    var option = document.createElement('option');
                    option.value = subcategory.id;
                    option.text = subcategory.name;
                    subcategorySelect.add(option);
                });

            } else {
                console.error('Ошибка запроса: ', xhr);
            }
        };

        xhr.onerror = function () {
            console.error('Ошибка соединения');
        };

        xhr.send();
    }
    
</script>

@endsection
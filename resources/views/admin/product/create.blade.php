@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Создание товара</h1>
@stop

@section('content')
    <div id="app">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Наименование</label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Наименование">
                    </div>
                    <div class="form-group">
                        <label for="category">Категория</label>
                        <select name="category_id[]" id="category" class="form-control" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Главное изображение</label>
                        <input type="file" name="main_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="media">Фото и видео для товара</label>
                        <input type="file" name="media[]" id="media" class="form-control" multiple onchange="previewMedia()">
                    </div>

                    <!-- Media preview container -->
                    <div id="media-preview-container" class="mt-2"></div>

                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea id="description" class="form-control" name="description"
                                  placeholder="Описание"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="care">Состав и уход</label>
                        <textarea id="care" class="form-control" name="care"
                                  placeholder="Состав и уход"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="params">Параметры изделия</label>
                        <textarea id="params" class="form-control" name="params"
                                  placeholder="Параметры изделия"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="delivery">Доставка и оплата</label>
                        <textarea id="delivery" class="form-control" name="delivery"
                                  placeholder="Доставка и оплата"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="size">Размеры</label>
                        <select name="size[]" multiple="multiple" id="size" class="form-control sizes-select">
                            @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="size">Цвета</label>
                        <div id="colorFields">

                        </div>

                        <button id="addColorField" class="btn btn-info" type="button">Добавить цвет</button>
                        <button id="removeColorField"  class="btn btn-danger" type="button">Удалить цвет</button>
                    </div>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="text" id="price" class="form-control" name="price" placeholder="Цена">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_sale">Цена по скидке</label>
                                <input type="text" id="price_sale" class="form-control" name="price_sale"
                                       placeholder="Цена по скидке">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_sale_percent">Скидка в (%)</label>
                                <input type="text" id="price_sale_percent" class="form-control"
                                       name="price_sale_percent"
                                       placeholder="Скидка в процентах">
                            </div>
                        </div>
                    </div>
<!--                    <div class="form-group">
                        <label for="description">Загрузить файл А4</label>
                        <input type="file" name="a4_file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Загрузить файл плоттер</label>
                        <input type="file" name="plotter_file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Загрузить файл с описанием</label>
                        <input type="file" name="description_file" class="form-control">
                    </div>-->
                    <div class="form-group">
                        <label for="status">Статус</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Отображать</option>
                            <option value="0">Не отображать</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/js/app.js"></script>

    <script>
        function previewMedia() {
            var previewContainer = document.getElementById('media-preview-container');
            var filesInput = document.getElementById('media');
            var files = filesInput.files;

            // Clear previous previews
            previewContainer.innerHTML = '';

            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var previewElement;

                    if (e.target.result.startsWith('data:image')) {
                        // Image preview
                        previewElement = document.createElement('img');
                        previewElement.src = e.target.result;
                        previewElement.className = 'img-thumbnail mr-2';
                    } else if (e.target.result.startsWith('data:video')) {
                        // Video preview
                        previewElement = document.createElement('video');
                        previewElement.src = e.target.result;
                        previewElement.controls = true;
                        previewElement.className = 'mr-2';
                    }

                    previewElement.style.width = '100px'; // Adjust the width as needed

                    previewContainer.appendChild(previewElement);
                };

                reader.readAsDataURL(files[i]);
            }
        }
    </script>

    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            // Counter for dynamically added fields
            let fieldCounter = 1;

            // Function to add new color fields
            function addColorField() {
                $('#colorFields').append('<div class="colorField colorField-' + fieldCounter + '"></div>');

                const colorFields = $('.colorField-' + fieldCounter);

                // Create new input field for name
                const nameInput = $('<input>', {
                    type: 'text',
                    name: 'colorName[][' + fieldCounter + ']',
                    placeholder: 'Название цвета',
                    class: 'form-control'
                });

                // Create new input field for color
                const colorInput = $('<input>', {
                    type: 'color',
                    name: 'colorValue[][' + fieldCounter + ']'
                });

                // Append new fields to the container
                colorFields.append(nameInput);
                colorFields.append(colorInput);

                // Increment the field counter
                fieldCounter++;
            }

            // Function to remove the last color field
            function removeColorField() {
                let fieldCounterTemp = fieldCounter - 1;

                const colorFields = $('.colorField-' + fieldCounterTemp);

                // Check if there are fields to remove
                if (fieldCounterTemp > 1) {
                    // Remove the last color field and line break
                    colorFields.remove()

                    // Decrement the field counter
                    fieldCounter--;
                }
            }

            // Attach click event to the "Add Color Field" button
            $('#addColorField').on('click', addColorField);

            // Attach click event to the "Remove Last Color Field" button
            $('#removeColorField').on('click', removeColorField);
        });
    </script>
@stop

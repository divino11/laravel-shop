@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Редактирование товара - {{ $product->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="form-group">
                    <label for="name">Наименование</label>
                    <input type="text" id="name" class="form-control" value="{{ $product->name }}" name="name"
                           placeholder="Наименование">
                </div>
                <div class="form-group">
                    <label for="category">Категория</label>
                    <select name="category_id[]" id="category" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected(in_array($category->id, $product->categories()->pluck('category_id')->toArray()))>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Главное изображение</label>
                    <input type="file" name="main_image" class="form-control">
                    <input type="hidden" value="{{ $product->image }}" name="main_image_hidden">
                    <img src="{{ url("/images/product/{$product->id}/main/" . $product->image) }}" class="img-size-s" alt="">
                </div>

                <div class="form-group">
                    <label for="media">Product Media (Images or Videos):</label>
                    <input type="file" name="media[]" id="media" class="form-control" multiple onchange="previewMedia()">
                </div>

                <div class="row existingImages">
                    @foreach($product->images as $image)
                        <div class="col-md-3">
                            @if ($image->type === 'image')
                                <img src="{{ url("/images/product/{$product->id}/images/{$image->path}") }}" class="w100" />
                            @else
                                <video autoplay muted loop class="w100">
                                    <source src="{{ url("/images/product/{$product->id}/images/{$image->path}") }}">
                                </video>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Media preview container -->
                <div id="media-preview-container" class="mt-2"></div>

                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea id="description" class="form-control" name="description"
                              placeholder="Описание">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="care">Состав и уход</label>
                    <textarea id="care" class="form-control" name="care"
                              placeholder="Состав и уход">{{ $product->care }}</textarea>
                </div>
                <div class="form-group">
                    <label for="params">Параметры изделия</label>
                    <textarea id="params" class="form-control" name="params"
                              placeholder="Параметры изделия">{{ $product->params }}</textarea>
                </div>
                <div class="form-group">
                    <label for="delivery">Доставка и оплата</label>
                    <textarea id="delivery" class="form-control" name="delivery"
                              placeholder="Доставка и оплата">{{ $product->delivery }}</textarea>
                </div>
                <div class="form-group">
                    <label for="size">Размеры</label>
                    <select name="size[]" multiple="multiple" id="size"
                            class="form-control sizes-select js-example-basic-multiple">
                        @foreach($sizes as $size)
                            <option value="{{ $size->id }}"
                                    @selected(in_array($size->id, $product->sizes()->pluck('size_id')->toArray()))>{{ $size->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="size">Цвета</label>
                    <div id="colorFields">
                        @foreach($product->colors as $key => $color)
                            <div class="colorField colorField-{{ $key + 1 }}">
                                <input type="text" name="colorName[][{{ $key + 1 }}]" value="{{ $color->name }}" placeholder="Название цвета" class="form-control">
                                <input type="color" name="colorValue[][{{ $key + 1 }}]" value="{{ $color->hex_code }}">
                            </div>
                        @endforeach
                    </div>

                    <button id="addColorField" class="btn btn-info" type="button">Добавить цвет</button>
                    <button id="removeColorField"  class="btn btn-danger" type="button">Удалить цвет</button>
                </div>
                <div class="form-group">
                    <label for="price">Цена</label>
                    <input type="text" id="price" class="form-control" value="{{ $product->price }}" name="price"
                           placeholder="Цена">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price_sale">Цена по скидку</label>
                            <input type="text" id="price_sale" value="{{ $product->price_sale }}" class="form-control"
                                   name="price_sale"
                                   placeholder="Цена по скидке">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price_sale_percent">Скидка в (%)</label>
                            <input type="text" id="price_sale_percent" value="{{ $product->price_sale_percent }}"
                                   class="form-control" name="price_sale_percent"
                                   placeholder="Скидка в процентах">
                        </div>
                    </div>
                </div>
<!--                <div class="form-group">
                    <label for="description">Загрузить файл А4</label>
                    <input type="hidden" value="{{ $product->a4_file }}" name="a4_file_hidden">
                    <input type="file" name="a4_file" class="form-control">
                    @if($product->a4_file)
                        <div class="pdf-uploaded">
                            <div class="pdf-uploaded_text">Посмотреть загруженный файл</div>
                            <a href="{{ '/files/' . $product->a4_file }}" target="_blank"><img
                                    src="/images/pdf-image.png"
                                    class="pdf-image_admin"
                                    alt="{{ $product->a4_file }}"></a>
                        </div>
                    @endif
                </div>-->
<!--                <div class="form-group">
                    <label for="description">Загрузить файл плоттер</label>
                    <input type="hidden" value="{{ $product->plotter_file }}" name="plotter_file_hidden">
                    <input type="file" name="plotter_file" class="form-control">
                    @if($product->plotter_file)
                        <div class="pdf-uploaded">
                            <div class="pdf-uploaded_text">Посмотреть загруженный файл</div>
                            <a href="{{ '/files/' . $product->plotter_file }}" target="_blank"><img
                                    src="/images/pdf-image.png"
                                    class="pdf-image_admin"
                                    alt="{{ $product->plotter_file }}"></a>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Загрузить файл с описанием</label>
                    <input type="hidden" value="{{ $product->description_file }}" name="description_file_hidden">
                    <input type="file" name="description_file" class="form-control">
                    @if($product->description_file)
                        <div class="pdf-uploaded">
                            <div class="pdf-uploaded_text">Посмотреть загруженный файл</div>
                            <a href="{{ '/files/' . $product->description_file }}" target="_blank"><img
                                    src="/images/pdf-image.png"
                                    class="pdf-image_admin"
                                    alt="{{ $product->description_file }}"></a>
                        </div>
                    @endif
                </div>-->
                <div class="form-group">
                    <label for="status">Статус</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ $product->status === 1 ? 'selected' : '' }}>Отображать</option>
                        <option value="0" {{ $product->status === 0 ? 'selected' : '' }}>Не отображать</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Изменить</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="/js/app.js"></script>

    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });

        $('#media').change(function() {
            $('.existingImages').remove();
        })
    </script>

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

        $(document).ready(function() {
            // Counter for dynamically added fields
            let fieldCounter = '{{ count($product->colors) }}';
            fieldCounter = parseInt(fieldCounter) + 1;

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

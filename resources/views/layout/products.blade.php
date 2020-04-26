<div class="col-3 product-item">
    <a href=""><img src="{{ url('/images/' . $product->image) }}" class="img-fluid img-center"></a>
    <a href=""><p class="product-title">{{ $product->name }}</p></a>
    <a href="{{ route('category', $product->category->code) }}"><p
            class="product-title">{{ $product->category->name }}</p></a>
    <a href="">
        <div class="product-rating">297 отзывов</div>
    </a>
    <div class="product-price">{{ $product->price }}</div>
    <div class="row">
        <div class="col-6">
            <div
                class="product-available">{{ $product->status === 1 ? 'Available' : 'Not available' }}</div>
        </div>
        <div class="col-6">
            <form action="{{ route('basket-add', $product->id) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary">Buy</button>
            </form>
        </div>
    </div>
</div>

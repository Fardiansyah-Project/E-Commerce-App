<div class="card">
    {{-- <img src="{{ asset('storage/' . $product->images->first()->filename ?? 'default.jpg') }}" class="card-img-top"> --}}
    <div class="card-body">
        <h5>{{ $product->name }}</h5>
        <p>Rp{{ number_format($product->price) }}</p>
        <a href="{{ route('product.show', $product->slug) }}" class="btn btn-primary btn-sm">Detail</a>
    </div>
</div>

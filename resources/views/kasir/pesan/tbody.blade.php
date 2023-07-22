<div class="flex flex-wrap justify-between">
@foreach ($data as $row)
  <div class="card card-compact w-96 bg-base-100 shadow-xl mb-3">
    <figure><img src="{{ $row->foto == null ? asset('img/default/barang.jpg') : asset('storage/'. $row->foto) }}" alt="Shoes" class="w-full"  style="height: 200px; object-fit:cover;" /></figure>
    <div class="card-body">
      <h2 class="card-title">{{ $row->nama }}</h2>
      <p>stock: {{ number_format($row->jumlah_barang, 0,','.'.') }} | kategori: {{ $row->kategori->nama }}</p>
      <div class="card-actions justify-between">
        <h2 class="card-title mt-4">Rp.{{ number_format($row->harga_jual, 0,',','.') }},-</h2>
        @if ($cart->where('barang_id', $row->id)->count() == 0)
        <button class="btn btn-primary add-to-cart" data-id="{{ $row->id }}">ADD TO CART</button>
        @else
        <button class="btn btn-neutral">ALREADY IN CART</button>
        @endif
      </div>
    </div>
  </div>
  @endforeach
</div>
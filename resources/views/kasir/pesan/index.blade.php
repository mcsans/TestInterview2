<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Pesan') }}
      </h2>
  </x-slot>

  
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-end">
          <a class="btn btn-success text-white mb-3" href="{{ route('keranjang-pesanan.index') }}">
            CART 
            <div class="badge badge-white text-success" id="info-cart" data-jumlah="{{ $totalCart }}">+{{ $totalCart }}</div>
          </a>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900" id="tbody">
            </div>
        </div>
    </div>
</div>
</x-app-layout>

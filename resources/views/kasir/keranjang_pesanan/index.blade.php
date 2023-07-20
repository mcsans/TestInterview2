<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Keranjang Pesanan') }}
      </h2>
  </x-slot>

  <div class="pt-12 py-3">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="form-control">
        <select class="select select-bordered" id="tambah-barang">
          <option value="0" disabled selected>Tambahkan Barang</option>
          @foreach ($barang as $data)
          <option value="{{ $data->id }}">{{ $data->nama }}</option>
          @endforeach
        </select>
        {{-- <label class="label">
          <span class="label-text-alt text-error"><i>@error('kategori_barang_id'){{ $message }}@enderror</i></span>
        </label> --}}
      </div>
      {{-- <button type="button" class="btn btn-success text-white">TAMBAHKAN BARANG</button> --}}
    </div>
  </div>

  <div class="pb-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-3 pl-6 text-gray-900 flex justify-between bg-info text-white">
                  {{ __("Keranjang Pesanan") }}
              </div>
              <div class="overflow-x-auto px-6">
                <table class="table" width="100%">
                  <thead>
                    <tr>
                      <th>Barang</th>
                      <th align="center">Harga</th>
                      <th align="center">Jumlah</th>
                      <th align="center">Subtotal</th>
                      <th width="1%"></th>
                    </tr>
                  </thead>
                  <tbody id="tbody">
                  </tbody>
                </table>
              </div>
            </div>
            <div class="flex justify-start">
              <button type="button" class="btn btn-error text-white my-5" id="reset-keranjang">Reset Pesanan</button>
              <button type="button" class="btn btn-success text-white my-5 ml-5" id="pembayaran">Pembayaran</button>
            </div>
      </div>
  </div>

  <div id="showForm"></div>
</x-app-layout>
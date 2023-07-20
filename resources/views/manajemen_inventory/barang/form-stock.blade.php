<dialog id="modal_add" class="modal modal-bottom sm:modal-middle">
  <form action="{{ route('barang.store') }}/addStock" method="POST" class="modal-box form-add">
    @csrf
    <div class="flex justify-between">
      <h3 class="font-bold text-lg mb-5">TAMBAH STOCK BARANG</h3>
      <h1 class="text-bold text-lg mr-3 cursor-pointer" onClick="modal_add.close()">X</h1>
    </div>

    <div class="form-control w-full">
      <select class="select select-bordered" name="barang_id">
        <option disabled selected>Pilih Barang</option>
        @foreach ($barang as $data)
        <option value="{{ $data->id }}" {{ old('barang_id') == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
        @endforeach
      </select>
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('barang_id'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="form-control w-full">
     <input type="number" class="input input-bordered w-full" placeholder="Masukkan Jumlah Barang" id="jumlah_barang" name="jumlah_barang" value="{{ old('jumlah_barang') }}" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('jumlah_barang'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="modal-action">
      <button type="submit" class="btn btn-block btn-neutral">SIMPAN</button>
    </div>
  </form>
</dialog>
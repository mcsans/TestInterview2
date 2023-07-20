<dialog id="modal_add" class="modal modal-bottom sm:modal-middle">
  <form action="{{ route('barang.store') }}" method="POST" class="modal-box form-add-file" enctype="multipart/form-data">
    @csrf
    <div class="flex justify-between">
      <h3 class="font-bold text-lg mb-5">TAMBAH DATA BARANG</h3>
      <h1 class="text-bold text-lg mr-3 cursor-pointer" onClick="modal_add.close()">X</h1>
    </div>

    <div class="form-control w-full">
      <select class="select select-bordered" name="kategori_barang_id">
        <option disabled selected>Pilih Kategori</option>
        @foreach ($kategori as $data)
        <option value="{{ $data->id }}" {{ old('kategori_barang_id') == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
        @endforeach
      </select>
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('kategori_barang_id'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="form-control w-full">
     <input type="text" class="input input-bordered w-full" placeholder="Masukkan Nama" id="nama" name="nama" value="{{ old('nama') }}" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('nama'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="form-control w-full">
      <input type="file" class="file-input file-input-bordered w-full" id="foto" name="foto" value="{{ old('foto') }}" />
       <label class="label">
         <span class="label-text-alt text-error"><i>@error('foto'){{ $message }}@enderror</i></span>
       </label>
     </div>

    <div class="form-control w-full">
     <input type="date" class="input input-bordered w-full" placeholder="Masukkan Tanggal Masuk" id="tanggal_masuk" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('tanggal_masuk'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="form-control w-full">
     <input type="number" class="input input-bordered w-full" placeholder="Masukkan Jumlah Barang" id="jumlah_barang" name="jumlah_barang" value="{{ old('jumlah_barang') }}" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('jumlah_barang'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="form-control w-full">
     <input type="number" class="input input-bordered w-full" placeholder="Masukkan Harga Beli" id="harga_beli" name="harga_beli" value="{{ old('harga_beli') }}" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('harga_beli'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="form-control w-full">
     <input type="number" class="input input-bordered w-full" placeholder="Masukkan Harga Jual" id="harga_jual" name="harga_jual" value="{{ old('harga_jual') }}" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('harga_jual'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="modal-action">
      <button type="submit" class="btn btn-block btn-neutral">SIMPAN</button>
    </div>
  </form>
</dialog>
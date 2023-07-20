<dialog id="modal_add" class="modal modal-bottom sm:modal-middle">
  <form action="{{ route('kategori-barang.store') }}" method="POST" class="modal-box form-add">
    @csrf
    <div class="flex justify-between">
      <h3 class="font-bold text-lg mb-5">TAMBAH DATA KATEGORI BARANG</h3>
      <h1 class="text-bold text-lg mr-3 cursor-pointer" onClick="modal_add.close()">X</h1>
    </div>

    <div class="form-control w-full">
     <input type="text" class="input input-bordered w-full" placeholder="Masukkan Nama" id="nama" name="nama" value="{{ old('nama') }}" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('nama'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="modal-action">
      <button type="submit" class="btn btn-block btn-neutral">SIMPAN</button>
    </div>
  </form>
</dialog>
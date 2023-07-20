<dialog id="modal_edit" class="modal modal-bottom sm:modal-middle">
  <form action="{{ route('kategori-barang.store') . '/' . $data->id }}" method="POST" class="modal-box form-edit">
    @method('PUT')
    @csrf

    <div class="flex justify-between">
      <h3 class="font-bold text-lg mb-5">EDIT DATA KATEGORI BARANG</h3>
      <h1 class="text-bold text-lg mr-3 cursor-pointer" onClick="modal_edit.close()">X</h1>
    </div>

    <div class="form-control w-full">
     <input type="text" class="input input-bordered w-full" placeholder="Masukkan Nama" id="nama" name="nama" value="{{ old('nama', $data->nama) }}" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('nama'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="modal-action">
      <button type="submit" class="btn btn-block btn-neutral">SIMPAN</button>
    </div>
  </form>
</dialog>
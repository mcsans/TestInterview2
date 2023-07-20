<dialog id="modal_add" class="modal modal-bottom sm:modal-middle">
  <form action="{{ route('karyawan.store') }}" method="POST" class="modal-box form-add">
    @csrf
    <div class="flex justify-between">
      <h3 class="font-bold text-lg mb-5">TAMBAH DATA KARYAWAN</h3>
      <h1 class="text-bold text-lg mr-3 cursor-pointer" onClick="modal_add.close()">X</h1>
    </div>

    <div class="form-control w-full">
     <input type="text" class="input input-bordered w-full" placeholder="Masukkan Nama" id="name" name="name" value="{{ old('name') }}" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('name'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="form-control w-full">
     <input type="email" class="input input-bordered w-full" placeholder="Masukkan Email" id="email" name="email" value="{{ old('email') }}" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('email'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="form-control w-full">
     <input type="password" class="input input-bordered w-full" placeholder="Masukkan Password" id="password" name="password" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('password'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="form-control w-full">
     <input type="text" class="input input-bordered w-full" placeholder="Masukkan KTP" id="ktp" name="ktp" value="{{ old('ktp') }}" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('ktp'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="form-control w-full">
      <select class="select select-bordered" name="role">
        <option disabled selected>Pilih Role</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>admin</option>
        <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>kasir</option>
      </select>
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('role'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="form-control w-full">
     <input type="number" class="input input-bordered w-full" placeholder="Masukkan Telepon" id="telepon" name="telepon" value="{{ old('telepon') }}" />
      <label class="label">
        <span class="label-text-alt text-error"><i>@error('telepon'){{ $message }}@enderror</i></span>
      </label>
    </div>

    <div class="modal-action">
      <button type="submit" class="btn btn-block btn-neutral">SIMPAN</button>
    </div>
    {{-- <div class="modal-action mt-0">
      <button type="button" class="btn btn-block" onClick="modal_add.close()">CLOSE</button>
    </div> --}}
  </form>
</dialog>
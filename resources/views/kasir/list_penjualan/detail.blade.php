<dialog id="modal_detail" class="modal modal-bottom sm:modal-middle">
  <form class="modal-box">
    @csrf
    <div class="flex justify-between">
      <h3 class="font-bold text-lg mb-5">DETAIL BARANG</h3>
    </div>

     <div class="overflow-x-auto">
      <table class="table" width="100%">
        <thead>
          <tr>
            <th>Barang</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($barang as $brg)
          <tr>
            <td>{{ $brg->barang->nama }}</td>
            <td>{{ $brg->harga }}</td>
            <td>{{ $brg->jumlah }}</td>
            <td>Rp.{{ number_format(($brg->harga * $brg->jumlah), 0, ',','.') }},-</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="modal-action">
      <button type="button" class="btn btn-block btn-neutral" onClick="modal_detail.close()">TUTUP</button>
    </div>
  </form>
</dialog>
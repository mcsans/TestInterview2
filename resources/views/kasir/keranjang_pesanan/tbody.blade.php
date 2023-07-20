@php $subtotal=0; @endphp
@foreach ($data as $row)
<tr>
  <td>{{ $row->barang->nama }}</td>
  <td align="center" class="text-base-500">Rp.{{ number_format($row->harga, 0,',','.') }},-</td>
  <td class="flex justify-center">
    <input type="number" placeholder="0" class="input input-bordered input-sm text-center pl-6 tambah-jumlah-barang" data-id="{{ $row->id }}" data-barang="{{ $row->barang_id }}" max="999" value="{{ $row->jumlah }}" />
  </td>
  <td align="center">Rp.{{ number_format(($row->harga * $row->jumlah), 0,',','.') }},-</td>
  <td align="right">
    <button class="btn btn-xs btn-outline btn-error form-delete" data-id="{{ $row->id }}" data-name="{{ $row->nama }}">hapus</button>
  </td>
</tr>
@php $subtotal+=($row->harga * $row->jumlah); @endphp
@endforeach
<tr>
  <th colspan="3">Total Pembelian:</th>
  <th align="center">Rp.{{ number_format($subtotal, 0,',','.') }},-</th>
  <input type="hidden" id="total" value="{{ $subtotal }}">
</tr>
<tr>
  <th colspan="3">Tunai:</th>
  <th class="flex justify-center">
    <input type="number" placeholder="0" class="input input-bordered input-sm text-center pl-6" max="999" id="tunai" />
  </th>
</tr>
<tr>
  <th colspan="3">Total Kembali:</th>
  <th align="center" id="kembali">Rp.0,-</th>
</tr>
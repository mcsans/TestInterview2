@foreach ($data as $row)
<tr class="hover">
  <th>{{ $loop->iteration }}</th>
  <td>
    <div class="flex items-center space-x-3">
      <div class="avatar">
        <div class="mask mask-squircle w-12 h-12">
          @if ($row->foto == null)
          <img src="{{ asset('img/default/barang.jpg') }}" alt="foto barang" />
          @else
          <img src="{{ asset('storage/'. $row->foto) }}" alt="foto barang" />
          @endif
        </div>
      </div>
    </div>
  </td>
  <td>{{ $row->kategori->nama }}</td>
  <td>{{ $row->nama }}</td>
  <td>{{ $row->tanggal_masuk }}</td>
  <td>{{ $row->jumlah_barang }}</td>
  <td>{{ $row->harga_beli }}</td>
  <td>{{ $row->harga_jual }}</td>
  <td align="right">
    <button class="btn btn-xs btn-outline btn-info" onClick="showForm({{ $row->id }})">edit</button>
    <button class="btn btn-xs btn-outline btn-error form-delete" data-id="{{ $row->id }}" data-name="{{ $row->nama }}">delete</button>
  </td>
</tr>
@endforeach
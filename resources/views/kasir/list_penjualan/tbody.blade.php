@foreach ($data as $row)
<tr class="hover">
  <td>{{ $row->id }}</td>
  <td>{{ $row->user->name }}</td>
  <td>{{ $row->created_at }}</td>
  <td>Rp.{{ number_format($row->total, 0,',','.') }},-</td>
  <td align="right">
    <button class="btn btn-xs btn-outline btn-info" onClick="detailTransaksi({{ $row->id }})">detail</button>
  </td>
</tr>
@endforeach
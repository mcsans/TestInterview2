@foreach ($data as $row)
<tr class="hover">
  <th>{{ $loop->iteration }}</th>
  <td>{{ $row->nama }}</td>
  <td align="right">
    <button class="btn btn-xs btn-outline btn-info" onClick="showForm({{ $row->id }})">edit</button>
    <button class="btn btn-xs btn-outline btn-error form-delete" data-id="{{ $row->id }}" data-name="{{ $row->nama }}">delete</button>
  </td>
</tr>
@endforeach
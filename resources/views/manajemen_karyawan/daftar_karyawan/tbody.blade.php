@foreach ($data as $row)
<tr class="hover">
  <th>{{ $loop->iteration }}</th>
  <td>{{ $row->name }}</td>
  <td>{{ $row->email }}</td>
  <td>{{ $row->ktp }}</td>
  <td>{{ $row->role }}</td>
  <td>
    <div class="badge {{ $row->status == 1 ? 'badge-success' : 'badge-error' }} badge-xs"></div>
  </td>
  <td>{{ $row->telepon }}</td>
  <td>
    <button class="btn btn-xs btn-outline btn-info" onClick="showForm({{ $row->id }})">edit</button>
    <button class="btn btn-xs btn-outline btn-error form-delete" data-id="{{ $row->id }}" data-name="{{ $row->name }}">delete</button>
  </td>
</tr>
@endforeach
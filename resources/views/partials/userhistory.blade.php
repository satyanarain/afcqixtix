<tr>
    <td><b>Created By</b></td>
    <td class="table_normal">{{ $value->user_name }}</td>
</tr>
<tr>
    <td><b>Created On</b></td>
    <td class="table_normal">{{ dateView($value->created_at) }}</td>
</tr>
<tr>
    <td><b>Last Updated At</b></td>
    <td class="table_normal">{{ dateView($value->updated_at) }}</td>
</tr>
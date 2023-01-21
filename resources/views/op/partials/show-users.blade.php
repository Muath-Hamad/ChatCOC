<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"> <b>Chatbot files</b></div>
            <div class="col col-md-6">
                {{-- <a href="{{ route('Adminfile.store') }}" class="btn btn-success btn-sm float-end">New</a> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name </th>
                <th>Role</th>
                <th>Created at</th>
            </tr>
            @if (count($admin_users) > 0)

            @foreach ( $admin_users as $row )
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->role }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>
                        <form method="post" action="{{ route('adminfile.destroy', $row->id) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger btn-sm" value="Delete"/>
                        </form>
                    </td>

                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">No files uploaded</td>
                </tr>
            @endif
        </table>
        {{ $admin_users->links() }}
    </div>

</div>

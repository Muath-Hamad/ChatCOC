{{-- <table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Date of Upload</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($adminfiles as $file)
            <tr>
                <td>{{ $file->path }}</td>
                <td>{{ $file->created_at }}</td>
                <td>
                    <form action="{{ route('Adminfile.destroy', $file->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table> --}}


<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"> <b> ملفات chabot</b></div>
            <div class="col col-md-6">
                {{-- <a href="{{ route('adminfile.create') }}" class="btn btn-success btn-sm float-end">New</a> --}}
                {{-- <a href="{{ route('adminfile.store') }}" class="btn btn-success btn-sm float-end">New</a> --}}
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>الاسم </th>
                <th>تم الرفع في</th>
                <th>تم الرفع بواسطة</th>
            </tr>
            @if (count($adminfiles) > 0)

            @foreach ( $adminfiles as $row )
                <tr>
                    <td>{{ $row->path }}</td>
                    <td>{{ $row->created_at }}</td>
                    <td>{{ $row->user_id }}</td>
                    <td>
                        <form method="post" action="{{ route('adminfile.destroy', ['file' => $row->id]) }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="mt-4 btn btn-outline-danger" value="حذف"/>
                        </form>
                    </td>

                </tr>
            @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center">لا يوجد ملفات </td>
                </tr>
            @endif
        </table>
        {{ $adminfiles->links() }}
    </div>

</div>

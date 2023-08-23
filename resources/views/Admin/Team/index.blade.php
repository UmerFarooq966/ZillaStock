@include('..layouts.app')
@include('Admin.Team.create')

<h1>Image categories</h1>
@if(count($users)>0)
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>User Name</th>
            <th width="280px">Email</th>
            <th width="280px">Role</th>
        </tr>
        @foreach ($users as $index =>$user)

            <tr>
                <td>{{ $index + 1 }}</td>

                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>

                <td>
                    <form action="{{ route('Team.destroy',$user->id) }}" method="POST">





                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

        @endforeach
    </table>

@else
    <p>No posts found</p>
@endif
<a href="../Admin/A-dashboard">
    <button type="submit" class="btn btn-danger">back</button>
</a>



@include('..layouts.app')
@include('Admin.ImageCategory.create')

<h1>Image categories</h1>
@if(count($Imagecategorys)>0)
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Category type</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($Imagecategorys as $index =>$category)
            <tr>
                <td>{{ $index + 1 }}</td>

                <td>{{ $category->type }}</td>

                <td>
                    <form action="{{ route('ImageCategory.destroy',$category->id) }}" method="POST">





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



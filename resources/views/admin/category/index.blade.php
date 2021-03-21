<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            All Category <b>  </b>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-header">All Categories</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->user->name }}</td>
                                        <td>
                                            @if($category->created_at == null)
                                                <span class="text-danger">No Date Set</span>
                                            @else
                                                {{ Carbon\Carbon::parse($category->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('category/edit/' . $category->id) }}" class="btn btn-warning">Edit</a>
                                            <a href="{{ url('softdelete/category/' . $category->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            {{ $categories->links() }}

                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                            @csrf
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id="category_name" aria-describedby="emailHelp">

                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


{{--        Trash Deleted--}}
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                        <div class="card-header">Trash List</div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($trashCategories as $trashCategory)
                                    <tr>
                                        <th scope="row">{{ $trashCategories->firstItem() + $loop->index }}</th>
                                        <td>{{ $trashCategory->category_name }}</td>
                                        <td>{{ $trashCategory->user->name }}</td>
                                        <td>
                                            @if($trashCategory->created_at == null)
                                                <span class="text-danger">No Date Set</span>
                                            @else
                                                {{ Carbon\Carbon::parse($trashCategory->created_at)->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('category/restore/' . $trashCategory->id) }}" class="btn btn-success">Restore</a>
                                            <a href="{{ url('pdelete/category/' . $trashCategory->id) }}" class="btn btn-danger">P Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                            {{ $trashCategories->links() }}

                        </div>
                    </div>
                </div>

                <div class="col-md-4">

                </div>

            </div>
        </div>
    </div>
</x-app-layout>

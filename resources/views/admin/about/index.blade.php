@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">

                <h2 class="mb-2">Home About</h2>
                <a href="{{ route('add.about') }}"><button class="btn btn-info mb-3 ml-1">Add About</button></a>

                <div class="col-md-12">
                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-header">All About Data</div>


                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" width="3%">SL No</th>
                                    <th scope="col" width="10%">Home Title</th>
                                    <th scope="col" width="20%">Short Description</th>
                                    <th scope="col" width="30%">Content</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @foreach($homeAbout as $about)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $about->title }}</td>
                                        <td>{{ $about->short_desc }}</td>
                                        <td>{{ $about->content }}</td>

                                        <td>
                                            <a href="{{ url('about/edit/' . $about->id) }}" class="btn btn-warning">Edit</a>
                                            <a href="{{ url('about/delete/' . $about->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>



            </div>
        </div>

    </div>
@endsection

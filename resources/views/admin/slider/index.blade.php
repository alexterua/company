@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">

                <h2 class="mb-2">Home Slider</h2>
                <a href="{{ route('add.slider') }}"><button class="btn btn-info mb-3 ml-1">Add Slider</button></a>

                <div class="col-md-12">
                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-header">All Sliders</div>


                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" width="5%">SL No</th>
                                    <th scope="col" width="15%">Slider Title</th>
                                    <th scope="col" width="25%">Slider Description</th>
                                    <th scope="col" width="15%">Image</th>
                                    <th scope="col" width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @foreach($sliders as $slider)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->description }}</td>
                                        <td>
                                            <img src="{{ asset($slider->image) }}" style="height: 40px; width: 60px;" alt="{{ $slider->title }}">
                                        </td>

                                        <td>
                                            <a href="{{ url('slider/edit/' . $slider->id) }}" class="btn btn-warning">Edit</a>
                                            <a href="{{ url('slider/delete/' . $slider->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
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

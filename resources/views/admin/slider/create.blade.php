@extends('admin.admin_master')

@section('admin')

<div class="col-lg-8">
    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Create Slider</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('store/slider/') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title Slider</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description Slider</label>
                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                    @error('description')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image Slider input</label>
                    <input type="file" name="image" class="form-control-file" id="image">
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-success btn-default">Create</button>
                </div>
            </form>
        </div>
    </div>
    <a href="{{ route('home.slider') }}" class="btn btn-primary mt-3 ml-4">Back</a>
</div>

@endsection

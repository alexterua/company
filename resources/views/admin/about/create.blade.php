@extends('admin.admin_master')

@section('admin')

    <div class="col-lg-8">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Home About</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('store/about/') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title Home About</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="short_desc">Description Home About</label>
                        <input type="text" name="short_desc" class="form-control" id="short_desc" placeholder="Description">
                    </div>
                    <div class="form-group">
                        <label for="content">Content Home About</label>
                        <textarea class="form-control" name="content" id="content" rows="3"></textarea>
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-success btn-default">Create</button>
                    </div>
                </form>
            </div>
        </div>
        <a href="{{ route('home.about') }}" class="btn btn-primary mt-3 ml-4">Back</a>
    </div>

@endsection

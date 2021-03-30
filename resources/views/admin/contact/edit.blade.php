@extends('admin.admin_master')

@section('admin')

    <div class="col-lg-8">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Edit Admin Contact</h2>
            </div>
            <div class="card-body">
                <form action="{{ url('admin/contact/update/' . $contact->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="address">Contact Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Address" value="{{ $contact->address }}">
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Contact Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ $contact->email }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Contact Phone</label>
                        <input type="phone" name="phone" class="form-control" id="phone" placeholder="Phone" value="{{ $contact->phone }}">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-success btn-default">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <a href="{{ route('admin.contact') }}" class="btn btn-primary mt-3 ml-4">Back</a>
    </div>

@endsection

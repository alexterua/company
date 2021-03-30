@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">

                <h2 class="mb-2">Contact Page</h2>
                <a href="{{ route('add.contact') }}"><button class="btn btn-info mb-3 ml-1">Add Contact</button></a>

                <div class="col-md-12">
                    <div class="card">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card-header">All Contact Data</div>


                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">SL No</th>
                                    <th scope="col">Contact Address</th>
                                    <th scope="col">Contact Email</th>
                                    <th scope="col">Contact Phone</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i = 1)
                                @foreach($contacts as $contact)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $contact->address }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone }}</td>

                                        <td>

                                            <a href="{{ url('admin/contact/edit/' . $contact->id) }}" class="btn btn-warning">Edit</a>
                                            <a href="{{ url('admin/contact/delete/' . $contact->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')">Delete</a>
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

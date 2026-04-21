@extends('admin.master')
@section('title', 'Admin Dashboard | Contact Message Details')
@section('body')
    <section class="pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Contact Message Details</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $contact->id }}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $contact->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $contact->email }}</td>
                                </tr>
                                <tr>
                                    <th>Subject</th>
                                    <td>{{ $contact->subject }}</td>
                                </tr>
                                <tr>
                                    <th>Message</th>
                                    <td>{{ $contact->message }}</td>
                                </tr>
                                <tr>
                                    <th>Received At</th>
                                    <td>{{ $contact->created_at->format('d M, Y h:i A') }}</td>
                                </tr>
                            </table>
                            <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
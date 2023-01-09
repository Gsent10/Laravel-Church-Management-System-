@extends('layouts.main')

@section('content')

    <!-- Page Heading -->
    <div class="row">
        <div class="col">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Departments</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card mx-auto w-100">
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <div class="card-header">
                <a href="{{ route('departments.create') }}" class="btn btn-primary">Create Department</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Department</th>
                        <th scope="col">Head of Department</th>
                        <th scope="col">Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $department->department }}</td>
                                <td>Imiete</td>
                                <td>
                                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-success">Manage</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

@endsection
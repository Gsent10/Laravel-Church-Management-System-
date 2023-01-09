@extends('layouts.main')


@section('content')

    <div class="row">
        <div class="col">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ $department->department }}</h1>
            </div>
        </div>

        <div class="col">
            <a href="{{ route('departments.index') }}" class="float-right "><i class="fa-solid fa-arrow-left"></i>  Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card mx-auto w-100">
                <div>
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div class="card-header">
                    <form method="POST" action="{{ route('departments.destroy', $department->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Remove {{ $department->department }}</button>
                    </form>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mx-auto">
                <div class="card-body">
                    <form method="POST" action="{{ route('departments.update', $department->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="department" class="col-md-4 col-form-label text-md-end">Name of Department</label>
        
                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ old('department', $department->department) }}" required autocomplete="off" autofocus>
        
                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Department') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@extends('layouts.main')


@section('content')

    <div class="row">
        <div class="col">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ $member->surname }}, {{ $member->first_name }}</h1>
            </div>
        </div>

        <div class="col">
            <a href="{{ route('users.index') }}" class="float-right "><i class="fa-solid fa-arrow-left"></i>  Back</a>
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
                    <form method="POST" action="{{ route('users.destroy', $member->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Remove {{ $member->first_name }}</button>
                    </form>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mx-auto">
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $member->id) }}">
                        @csrf
                        @method('PUT')
    
                        <div class="row mb-3">
                            <label for="firstname" class="col-md-4 col-form-label text-md-end">First Name</label>
    
                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname', $member->first_name) }}" required autocomplete="off" autofocus>
    
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <label for="lastname" class="col-md-4 col-form-label text-md-end">Last Name</label>
    
                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname', $member->surname) }}" required autocomplete="off">
    
                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <label for="middlename" class="col-md-4 col-form-label text-md-end">Middle Name</label>
    
                            <div class="col-md-6">
                                <input id="middlename" type="text" class="form-control @error('middlename') is-invalid @enderror" name="middlename" value="{{ old('middlename', $member->middle_name) }}" autocomplete="off">
    
                                @error('middlename')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <label for="birthday" class="col-md-4 col-form-label text-md-end">Birth Day</label>
    
                            <div class="col-md-6">
                                <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday', $member->birthday) }}" autocomplete="off">
    
                                @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <label for="state" class="col-md-4 col-form-label text-md-end">State of Origin</label>
    
                            <div class="col-md-6">
                                <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ old('state', $member->state) }}" required autocomplete="off">
    
                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <label for="lga" class="col-md-4 col-form-label text-md-end">Local Government Area</label>
    
                            <div class="col-md-6">
                                <input id="lga" type="text" class="form-control @error('lga') is-invalid @enderror" name="lga" value="{{ old('lga', $member->lga) }}" required autocomplete="off">
    
                                @error('lga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">Home Address</label>
    
                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $member->address) }}" required autocomplete="off">
    
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">Phone Number</label>
    
                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" pattern="[0-9]{4} [0-9]{3} [0-9]{4}" value="{{ old('phone', $member->phone) }}" autocomplete="off">
                                <small>Format: 0801 234 5678</small> <br>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
    
    
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Member') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
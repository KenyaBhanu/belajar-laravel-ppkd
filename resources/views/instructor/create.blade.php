@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('instructor.store')}}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="">Major *</label>
                    <select name="major_id" id="" class="form-control">
                        <option value="">Select One</option>
                        @foreach ($majors as $key => $major)
                        <option value="{{ $major->id }}">{{ $major->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Name *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" name="name">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Phone Number *</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone number" name="phone">
                    @error('phone')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Email *</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter email address" name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="">Password *</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password" name="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('instructor.update', $edit->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">Major</label>
                    <select name="major_id" id="" class="form-control">
                        <option value="">Select One</option>
                        @foreach ($majors as $key => $major)
                        <option value="{{ $major->id }}" {{ $major->id == $edit->major_id ? 'selected' : '' }}>{{ $major->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{ $edit->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="">Phone Number</label>
                    <input type="text" class="form-control" placeholder="Enter phone number" name="phone" value="{{ $edit->phone }}" required>
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{ $edit->user->email ?? '' }}" required>
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" class="form-control" placeholder="Enter password" name="password">
                </div>
                <div class="mb-3 d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

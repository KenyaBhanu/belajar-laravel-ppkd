@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('student.store')}}" method="post">
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
                    <input type="text" class="form-control" placeholder="Enter name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="">Phone Number *</label>
                    <input type="text" class="form-control" placeholder="Enter phone number" name="phone" required>
                </div>
                <div class="mb-3 d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

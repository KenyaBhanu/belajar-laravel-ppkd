@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('user.update', $edit->id)}}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" placeholder="Enter your name" name="name" required value="{{ $edit->name }}">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="text" class="form-control" placeholder="Enter your email" name="email" required value="{{ $edit->email }}">
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="text" class="form-control" placeholder="Enter your password" name="password">
                </div>
                <div class="mb-3">
                    <label for="">Role *</label>
                    <select name="role_ids[]" id="" class="form-control" required multiple>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option @selected(in_array($role->id, $edit->roles->pluck('id')->all())) value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>

                    <small class="text-secondary">
                        *) Can choose more than one role
                    </small>
                </div>
                <div class="mb-3 d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

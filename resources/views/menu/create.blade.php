@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('menu.store') }}" method="post">
                @csrf
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="" class="form-label">Parent ID
                        </label>
                        <select name="parent_id" id="" class="form-control">
                            <option value="">Select One</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Name
                        </label>
                        <input type="text" class="form-control" name="name"
                            value="" placeholder="Enter Menu Name"
                            required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="" class="form-label">URL
                        </label>
                        <input type="text" class="form-control" name="url"
                            value="" placeholder="Enter URL">
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Icon
                        </label>
                        <input type="text" class="form-control" name="icon"
                            value="" placeholder="Enter Icon Class Name">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="" class="form-label">Sort Order</label>
                        <input type="text" class="form-control" name="sort_order"
                            value="" placeholder="Enter Sort Order">
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Status</label><br>
                        <input type="radio" name="is_active" value="1">
                        Active <br>
                        <input type="radio" name="is_active" value="0">
                        Inactive
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="" class="form-label">Assign to Roles</label>
                        @foreach ($roles as $role)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="roles[]" id="role-{{ $role->id }}" value="{{ $role->id }}">
                            <label for="role-{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="mb-3 d-flex justify-content-end align-items-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

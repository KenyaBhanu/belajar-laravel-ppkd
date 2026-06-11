@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('menu.update', $edit->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="" class="form-label">Parent ID
                        </label>
                        <select name="parent_id" id="" class="form-control">
                            <option value="">Select Option</option>
                            @foreach ($parents as $parent)
                                <option value="{{ $parent->id }}" {{ $parent->id == $edit->parent_id ? 'selected' : ''}}>
                                    {{ $parent->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Name
                        </label>
                        <input type="text" class="form-control" name="name"
                            value="{{ $edit->name }}" placeholder="Enter Menu Name"
                            required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="" class="form-label">URL
                        </label>
                        <input type="text" class="form-control" name="url"
                            value="{{ $edit->url }}" placeholder="Enter URL">
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Icon
                        </label>
                        <input type="text" class="form-control" name="icon"
                            value="{{ $edit->icon }}" placeholder="Enter Icon Class Name">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="" class="form-label">Sort Order</label>
                        <input type="text" class="form-control" name="sort_order"
                            value="{{ $edit->sort_order }}" placeholder="Enter Sort Order">
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label">Status</label><br>
                        <input type="radio" name="is_active" value="1" {{ $edit->is_active == 1 ? 'checked' : '' }}>
                        Active <br>
                        <input type="radio" name="is_active" value="0" {{ $edit->is_active == 0 ? 'checked' : '' }}>
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

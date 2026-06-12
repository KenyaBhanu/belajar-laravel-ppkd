@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $title ?? '' }}</h3>
        </div>
        <div class="card-body">
            <div class="mb-3" align="right">
                <a href="{{ route('user-role.create') }}" class="btn btn-primary">Create New User Role</a>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User Name</th>
                        <th>Role Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userRoles as $index => $userRole)
                    <tr>
                        <td>{{ $index += 1 }}</td>
                        <td>{{ $userRole->user->name ?? '' }}</td>
                        <td>{{ $userRole->role->name ?? '' }}</td>
                        <td>
                            @if($useRole->is_active == 1)
                            <span class="badge text-white bg-primary">Active</span>
                            @else
                            <span class="badge text-white bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('user-role.edit', $userRole->id) }}" class="btn btn-primary d-inline">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('user-role.destroy', $userRole->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

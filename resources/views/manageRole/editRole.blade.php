<x-app-layout>
    <div class="container mt-5">
        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Role Name</label>
                <input type="text" class="form-control" name="name" value="{{ $role->name }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Permissions</label>
                <div class="row">
                    @foreach($permissions as $permission)
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   name="permissions[]" 
                                   value="{{ $permission->name }}"
                                   {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $permission->name }}</label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Role</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</x-app-layout>
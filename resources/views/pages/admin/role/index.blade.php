@extends('layouts.master', ['title' => 'Role'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card title="List Role">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $i => $role)
                            <tr>
                                <td>{{ $i + $roles->firstItem() }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if ($role->name != 'super admin')
                                        @foreach ($role->permissions as $permission)
                                            <li>{{ $permission->name }}</li>
                                        @endforeach
                                    @else
                                        <li>all permission</li>
                                    @endif
                                </td>
                                <td>
                                    <x-button-modal :id="$role->id" title="" icon="edit" style=""
                                        class="btn btn-info btn-sm" />
                                    <x-modal :id="$role->id" title="Update Role">
                                        <form action="{{ route('admin.role.update', $role->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <x-input title="Role name" name="name" type="text"
                                                placeholder="Input role name" :value="$role->name" />
                                            <x-select-group title="Permission">
                                                @foreach ($permissions as $permission)
                                                    <label class="form-selectgroup-item">
                                                        <input type="checkbox" name="permissions[]"
                                                            value="{{ $permission->id }}" class="form-selectgroup-input"
                                                            @checked($role->permissions()->find($permission->id))>
                                                        <span class="form-selectgroup-label">
                                                            {{ $permission->name }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </x-select-group>
                                            <x-button-save title="Update role" icon="save" class="btn btn-primary" />
                                        </form>
                                    </x-modal>
                                    <x-button-delete :id="$role->id" :url="route('admin.role.destroy', $role->id)" title=""
                                        class="btn btn-danger btn-sm" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card>
        </div>
        <div class="col-12 col-lg-4">
            <x-card title="Create role" class="card-body">
                <form action="{{ route('admin.role.store') }}" method="POST">
                    @csrf
                    <x-input title="Role name" name="name" type="text" placeholder="Input role name"
                        :value="old('name')" />
                    <x-select-group title="Permission">
                        @foreach ($permissions as $permission)
                            <label class="form-selectgroup-item">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                    class="form-selectgroup-input">
                                <span class="form-selectgroup-label">{{ $permission->name }}</span>
                            </label>
                        @endforeach
                    </x-select-group>
                    <x-button-save title="Create role" icon="plus-circle" />
                </form>
            </x-card>
        </div>
    </x-container>
@endsection

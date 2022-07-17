@extends('layouts.master', ['title' => 'Permission'])

@section('content')
    <x-container>
        <div class="col-12 col-lg-8">
            <x-card title="List Permission">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Permission</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $i => $permission)
                            <tr>
                                <td>{{ $i + $permissions->firstItem() }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <x-button-modal :id="$permission->id" title="" icon="edit" style=""
                                        class="btn btn-info btn-sm" />
                                    <x-modal :id="$permission->id" title="Ubah Data">
                                        <form action="{{ route('admin.permission.update', $permission->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <x-input name="name" type="text" title="Permission" placeholder=""
                                                :value="$permission->name" />
                                            <x-button-save title="Update Permission" icon="save"
                                                class="btn btn-primary" />
                                        </form>
                                    </x-modal>
                                    <x-button-delete :id="$permission->id" :url="route('admin.permission.destroy', $permission->id)" title=""
                                        class="btn btn-danger btn-sm" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card>
        </div>
        <div class="col-12 col-lg-4">
            <x-card title="Create Permission" class="card-body">
                <form action="{{ route('admin.permission.store') }}" method="POST">
                    @csrf
                    <x-input title="Permission name" name="name" type="text" placeholder="Input permission name"
                        :value="old('name')" />
                    <x-button-save title="Crate Permission" icon="plus-circle" />
                </form>
            </x-card>
        </div>
    </x-container>
@endsection

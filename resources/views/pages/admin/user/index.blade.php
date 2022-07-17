@extends('layouts.master', ['title' => 'User'])

@section('content')
    <x-container>
        <div class="col-12">
            <x-card title="List User">
                <x-table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Avatar</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $i => $user)
                            <tr>
                                <td>{{ $i + $users->firstItem() }}</td>
                                <td>
                                    <span class="avatar rounded avatar-md"
                                        style="background-image: url({{ $user->avatar }})">
                                    </span>
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </td>
                                <td>
                                    <x-button-modal :id="$user->id" title="" icon="edit" style=""
                                        class="btn btn-info btn-sm" />
                                    <x-modal :id="$user->id" title="Update User">
                                        <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <x-select title="Role" name="role">
                                                <option value="">Silahkan Pilih</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" @selected($user->roles()->find($role->id))>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </x-select>
                                            <x-button-save title="Update User" icon="save" class="btn btn-primary" />
                                        </form>
                                    </x-modal>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table>
            </x-card>
        </div>
    </x-container>
@endsection

@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>User Management</h2>
        </div>
        <div class="pull-right">
        @can('user-create')
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New user</a>
            @endcan
        </div>
    </div>
</div>
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
<table class="table table-bordered">
    <tr>
        <th>@sortablelink('id')</th>
        <th>@sortablelink('name')</th>
        <th>@sortablelink('email')</th>
        <th>@sortablelink('role')</th>
        <th width="280px">action</th>
    </tr>
    
    @foreach ($data as $key => $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                @endforeach
            @endif
            </td>
            <td>
            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
            @can('user-edit')
                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
            @endcan
            @can('user-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>
{!! $data->render() !!}

@endsection
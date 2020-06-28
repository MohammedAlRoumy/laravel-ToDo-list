@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h3>To Do List</h3>
                        <div class="ml-auto">
                            <a href="{{ route('tasks.create') }}" class="btn btn-outline-success">Create new Task</a>
                        </div>
                    </div>

                </div>

                <div class="card-body">

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Task</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $index=>$task)
                                <tr>
                                    <td scope="row">{{ $index+1 }}</td>
                                    @if($task->status == 1)
                                    <td style="width: 30%;color: green; text-decoration: line-through;">{{ $task->title }}</td>
                                    @endif
                                    <td style="width: 30%">{{ $task->title }}</td>
                                    <td>

                                        <input type="checkbox" data-toggle="toggle"
                                            data-id="{{$task->id}}" name="status"
                                            class="js-switch tasks-switch"  {{ $task->status == 1 ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $task>created_at }}</td>
                                    <td>{{ $task>updated_at }}</td>
                                    <td>
                                        <div class="d-flex">
                                        <a class="btn btn-outline-primary btn-sm mr-1" href="">Edit</a>
                                        <form method="post" action="">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger btn-sm delete">Delete</button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



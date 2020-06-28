@extends('layouts.dashboard.app')

@section('content')

    <div>
        <h2>tasks</h2>
    </div>

    <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active">tasks</li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="tile mb-4">
                <div class="row">
                    <div class="col-12">
                        <form action="">
                            <div class="row">


                                <div class="ml-auto mb-2">

                                        <a href="{{route('tasks.create')}}" class="btn btn-success"><i
                                                class="fa fa-plus"></i> Add</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        @if($tasks->count()>0)
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="tbody">
                                @foreach($tasks as $index=>$task)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        @if ($task->status == 1)
                                            <td style="font-size: 18px;color:green;text-decoration: line-through;">{{$task->name}}</td>
                                        @else
                                            <td style="font-size: 18px">{{$task->name}}</td>
                                        @endif

                                        <td>
                                            <input type="checkbox" data-toggle="toggle"
                                                   data-id="{{$task->id}}" name="status"
                                                   class="js-switch tasks-switch" {{ $task->status == 1 ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                                <a href="{{route('tasks.edit',$task->id)}}"
                                                   class="btn btn-warning btn-sm"><i
                                                        class="fa fa-edit"></i> Edit</a>


                                                <form action="{{route('tasks.destroy',$task->id)}}"
                                                      method="post"
                                                      style="display: inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-sm delete"><i
                                                            class="fa fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <h3>Sorry no records found</h3>
                        @endif
                    </div>
                </div>
                {{ $tasks->links() }}
            </div>
        </div>
    </div>

@endsection

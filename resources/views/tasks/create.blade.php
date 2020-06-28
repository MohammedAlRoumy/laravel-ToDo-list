@extends('layouts.dashboard.app')

@section('content')

<div>
    <h2>To Do list</h2>
</div>

        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item "><a href="{{route('tasks.index')}}">To do list</a></li>
            <li class="breadcrumb-item active">Create</li>
        </ul>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="col-md-12">
                <div class="tile-body">
                    <form class="form-horizontal" method="post" action="{{route('tasks.store')}}">
                        @csrf
                        @method('post')
                        @include('partials._errors')
                        <div class="form-group row">
                            <label class="control-label col-md-3">Task name</label>
                            <div class="col-md-9">
                                <input class="form-control" name="name" type="text"  value="{{old('name')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3">Status</label>
                            <div class="col-md-9">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="status" value="1">completed
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="status" value="0">uncompleted
                                    </label>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Add
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <a class="btn btn-secondary" href="{{route('tasks.index')}}"><i
                                    class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

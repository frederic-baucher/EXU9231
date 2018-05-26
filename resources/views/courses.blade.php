@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Course
                </div>

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Course Form -->
                    <form action="{{ url('course')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Course Name -->
                        <div class="form-group">
                            <label for="Course-name" class="col-sm-3 control-label">Course</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="Course-name" class="form-control" value="{{ old('Course') }}">
                            </div>
                        </div>

                        <!-- Add Course Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Course
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Courses -->
            @if (count($courses) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Courses
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped Course-table">
                            <thead>
                                <th>Course</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td class="table-text"><div>{{ $course->name }}</div></td>

                                        <!-- Course Delete Button -->
                                        <td>
                                            <form action="{{ url('course/'.$course->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

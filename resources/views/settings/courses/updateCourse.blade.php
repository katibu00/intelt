@extends('layouts.app')
@section('PageTitle', 'Update Course')
@section('content')   
<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Form Layouts</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Forms</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="#">Form Layouts</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">

            <!-- Basic multiple Column Form section start -->
            <section id="multiple-column-form">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Course</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('courses.update',$course->id)}}" method="POST">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">Course Code</label>
                                                <input type="text" class="form-control" name="course_code" value="{{ $course->course_code }}" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">Course Title</label>
                                                <input type="text" class="form-control" name="course_title" value="{{ $course->course_title }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="basicSelect">CU</label>
                                                <select class="form-select" id="basicSelect" name="credit_unit">
                                                    <option value="">CU</option>
                                                    <option value="1" {{ $course->credit_unit == '1'? 'selected': ''}}>1</option>
                                                    <option value="2" {{ $course->credit_unit == '2'? 'selected': ''}}>2</option>
                                                    <option value="3" {{ $course->credit_unit == '3'? 'selected': ''}}>3</option>
                                                    <option value="4" {{ $course->credit_unit == '4'? 'selected': ''}}>4</option>
                                                    <option value="5" {{ $course->credit_unit == '5'? 'selected': ''}}>5</option>
                                                    <option value="6" {{ $course->credit_unit == '6'? 'selected': ''}}>6</option>
                                                    <option value="7" {{ $course->credit_unit == '7'? 'selected': ''}}>7</option>
                                                    <option value="8" {{ $course->credit_unit == '8'? 'selected': ''}}>8</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-2 mb-1">
                                            <label class="form-label" for="select2-disabled-result">Coordinator</label>
                                            <select class="select2 form-select" id="select2-disabled-result" name="user_id">
                                                <option value=""></option>
                                                @foreach($users as $user)
                                                <option value="{{$user->id}}"  {{ $course->user_id == $user->id? 'selected': ''}}>{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="basicSelect">Designation</label>
                                                <select class="form-select" id="basicSelect" name="designation">
                                                    <option value="C" {{ $course->cu == 'C'? 'selected': ''}}>Core</option>
                                                    <option value="E" {{ $course->cu == 'E'? 'selected': ''}}>Elective</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary me-1">Submit</button>
                                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Floating Label Form section end -->

        </div>
    </div>
</div>
<!-- END: Content-->
    @endsection
@extends('layouts.app')
@section('PageTitle', 'Courses')
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
                    <h2 class="content-header-title float-start mb-0">Courses</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Courses</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">Add New Courses</a>
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
        <section class="form-control-repeater">
            <div class="row">
                <!-- Invoice repeater -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add New Course(s)</h4>
                        </div>
                        <div class="card-body">
                    
                            <form class="invoice-repeater" action="{{ route('courses.store') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-md-3 mb-1">
                                        <label class="form-label" for="select2-multiple">Department(s)</label>
                                        <select class="select2 form-select" id="select2-multiple" name="department[]" multiple>
                                            <option value=""></option>
                                            @if($type == 'nce')
                                            <option value="gedu">General Education</option>
                                            <option value="gse">GSE</option>
                                            <option value="tp">TP</option>
                                            @endif
                                            @foreach ($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-md-2 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="level">Level</label>
                                            <select class="form-select" id="level" name="level_order" required>
                                                <option value=""></option>
                                                @foreach ($levels as $level)
                                                <option value="{{$level->order}}">{{$level->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="designation">Semester</label>
                                            <select class="form-select" id="designation" name="semester" required>
                                                <option value="first">First</option>
                                                <option value="second">Second</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                               
                                <div data-repeater-list="course">
                                    <div data-repeater-item>
                                        <div class="row d-flex align-items-end">
                                            
                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label">Course Code</label>
                                                    <input type="text" class="form-control" name="course_code" required/>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="course_title">Course Title</label>
                                                    <input type="text" class="form-control" name="course_title" required/>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="cu">CU</label>
                                                    <select class="form-select" id="cu" name="credit_unit" required>
                                                        <option value="">CU</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                    </select>
                                                </div>
                                            </div>
    
                                            <div class="col-md-2 mb-1">
                                                <label class="form-label" for="coordinator">Coordinator</label>
                                                <select class="form-select" id="coordinator" name="user_id" required>
                                                    <option value=""></option>
                                                    @foreach($users as $user)
                                                    <option value="{{$user->id}}">{{$user->first_name}} {{$user->middle_name}} {{$user->last_name}}</option>
                                                    @endforeach
                                                </select>
                                                   
                                            </div>
    
                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="designation">Designation</label>
                                                    <select class="form-select" id="designation" name="designation" required>
                                                        <option value="C">Core</option>
                                                        <option value="E">Elective</option>
                                                    </select>
                                                </div>
                                            </div>

                    


                                            <div class="col-md-1 col-12 mb-0">
                                                <div class="mb-1">
                                                    <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                        <i data-feather="x" class="me-25"></i>
                                                        {{-- <span>Del</span> --}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-icon btn-info" type="button" data-repeater-create>
                                            <i data-feather="plus" class="me-25"></i>
                                            <span>Add Row</span>
                                        </button>
                                        <button class="btn btn-icon btn-primary" type="submit">
                                            <span>Submit</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Invoice repeater -->
            </div>
        </section>

    </div>
</div>
</div>
<!-- END: Content-->
@endsection

@section('js')
<script src="/backend/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
<script src="/backend/app-assets/js/scripts/forms/form-repeater.js"></script>

@endsection
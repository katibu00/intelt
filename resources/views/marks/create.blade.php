@extends('layouts.app')
@section('PageTitle', 'Enter Marks')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">
                <section id="multssiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">Marks Entry</h4>
                                    @if(isset($students))
                                    <div class="col-7">
                                        <div class="d-flex justify-content-between align-items-center fw-bolder mb-50">
                                            <span><span id="marked">{{ @$marked? $marked : 0}}</span> of {{ $students->count() }} Students</span>
                                            <span style="font-size: 12px; font-weight: normal;" id="remaining">{{ $students->count() - @$marked}} remaining</span>
                                        </div>
                                        <div class="progress mb-50" style="height: 8px">
                                            <div class="progress-bar" role="progressbar" style="width: {{ @$marked/$students->count()*100 }}%" aria-valuenow="6" aria-valuemax="100" aria-valuemin="0"></div>
                                        </div>
                                       
                                    </div>
                                    <input type="hidden" id="total_students" value="{{$students->count()}}">
                                    <input type="hidden" id="initial" value="{{ @$initial }}">
                                    @endif
                                </div>
                                <div class="card-body my-1 py-50">
                                    <form class="form" action="{{ route('marks.create')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-4 mb-1">
                                                <label class="form-label" for="course">Course</label>
                                                <select class="select2 form-select" id="course_id" name="course_id">
                                                    <option value=""></option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}" {{$course->id == @$course_id? 'selected':''}}>{{ $course->course_code }} - {{ $course->course_title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4 mb-1">
                                                <label class="form-label" for="marks_category">Marks Category</label>
                                                <select id="marks_category" class="form-select" aria-label="Marks Category" name="marks_category">
                                                    <option value=""></option>
                                                    <option value="ca1" {{@$marks_category == 'ca1'? 'selected':''}}>CA1</option>
                                                    <option value="ca2" {{@$marks_category == 'ca2'? 'selected':''}}>CA2</option>
                                                    <option value="ca3" {{@$marks_category == 'ca3'? 'selected':''}}>CA3</option>
                                                    <option value="exam" {{@$marks_category == 'exam'? 'selected':''}}>Exam</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary  mt-2">Search</button>
                                            </div>
                                        </div>
                                    </form>

                             
                                    @if(isset($students))
                                    <form id="main_form">
                                        <div class="marks_table ">
                                            <div class="table-responsive mt-2">
                                                <table class="table table-striped table-hover marks_table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 5%">S/N</th>
                                                            <th>Reg. Number</th>
                                                            <th>Student Name</th>
                                                            <th style="width: 5%">Type</th>
                                                            <th style="width: 5%">Absent</th>
                                                            <th>Marks</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="marks_tbody">
                                                      
                                                        @foreach ($students as $key => $student)
                                                            <tr>
                                                                <td>{{ $key + 1}}</td>
                                                                <td>{{ $student['student']['reg_number'] }}</td>
                                                                <td>{{ $student['student']['first_name'] }} {{ $student['student']['middle_name'] }} {{ $student['student']['last_name'] }}</td>
                                                                <td>Regular</td>
                                                                <td class="text-center"><input type="checkbox" {{ @$student->absent == 'absent'? 'checked':'' }} class="absent" data-user_id="{{ $student['student']['id'] }}" data-reg_number="{{ $student['student']['reg_number'] }}" data-marks="{{ @$student->marks == 0 ? '': $student->marks }}"></td>
                                                                <td><input type="hidden" name="user_id[]" value="{{ $student['student']['id'] }}"><input type="{{ @$student->absent == 'absent'? 'text':'number' }}" max="70" class="form-control form-control-sm" id="marks" name="marks" data-user_id="{{ $student['student']['id'] }}" value="{{ @$student->absent == 'absent'? 'absent': $student->marks }}"></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>

                                                </table>
                                                <input type="hidden" id="course_id_send" name="course_id" value="{{ @$course_id }}">
                                                <input type="hidden" id="marks_category_send" name="marks_category" value="{{ @$marks_category }}">
                                                <input type="hidden" id="submitted" value="{{ @$submitted }}">
                                            </div>

                                            <div class="col-12 text-center mt-1">
                                              
                                                <button type="submit" class="btn btn-outline-danger initialize_btn d-none">Initialize</button>
                                             
                                                <button type="submit" class="btn btn-secondary submit_btn d-none">Submit</button>
                                               
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('js')
    @include('marks.scripts')
    <script src="/backend/sweetalert.min.js"></script>
@endsection

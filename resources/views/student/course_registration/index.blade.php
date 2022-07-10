@extends('layouts.app')
@section('PageTitle', 'Course Registration')
@section('css')
<style>
     table {
            border-collapse: collapse !important;
        }
  
        .table tr td {
            padding: 0 5px !important; 
        }
</style>
@endsection
@section('content')


<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-body">
            <!-- Basic Horizontal form layout section start -->
            <section id="basic-horizontal-layouts">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Recommended</h4>
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle level-text" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Choose Level
                                            </button>
                                            <div class="dropdown-menu">
                                               @foreach ($levels as $level)
                                               <a class="dropdown-item change-level" href="#" data-level="{{ $level->order }}" data-level_name="{{ $level->name }}" data-semester="first">{{ $level->name }} - First Semester</a>
                                               <a class="dropdown-item change-level" href="#" data-level="{{ $level->order }}" data-level_name="{{ $level->name }}" data-semester="second">{{ $level->name }} - Second Semester</a>

                                               @endforeach
                                               
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">

                            <div class="regular-div d-none">
                                <h5>Core Courses</h5>
                                <div class="table-responsive">
                                    <table class="table table-sm table-collapsed table-bordered mb-2 regular-courses-table" style="font-size: 10px;">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Code</th>
                                                <th>title</th>
                                                <th>CU</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="regular-courses-tr">
                                            
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="elective-div d-none">
                                <h5>Elective Courses</h5>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered mb-2" style="font-size: 10px;">
                                       
                                        <tbody id="elective-courses-tr">
                                           
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="co-div d-none">
                                <h5>Carry Over(s)</h5>
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered mb-2" style="font-size: 10px;">
                                       
                                        <tbody id="co-courses-tr">
                                           
                                          
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Registered Courses</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-outline-danger btn-sm reset d-none">Reset</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                               <form id="register_course_form">
                                @csrf
                                <div class="table-responsive selected-div d-none">
                                    <table class="table table-sm table-bordered mb-2 selected-courses-table" style="font-size: 10px;">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Code</th>
                                                <th>title</th>
                                                <th>CU</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="registered-courses-tr">
                                            
                                          
                                        </tbody>
                                    </table>

                                    <h5>Registration Summary</h5>
                                    <table class="table table-sm table-bordered mb-2" style="font-size: 10px;">
                                        
                                        <tbody>
                                            <tr>
                                                <th>Total Courses Registered</th>
                                                <td><span id="registred"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Total Credits Registered</th>
                                                <td><span id="credit"></span></td>
                                            </tr>
                                            <tr>
                                                <th>Minimun Credits Allowed</th>
                                                <td>X</td>
                                            </tr>
                                            <tr>
                                                <th>Maximum Credits Allowed</th>
                                                <td>X</td>
                                            </tr>
                                          
                                        </tbody>
                                    </table>


                                    <div class="col-sm-9 offset-sm-3 mt-2">
                                        <button type="submit" class="btn btn-sm btn-primary me-1 submit_btn">Submit</button>
                                        <button type="reset" class="btn btn-sm btn-outline-secondary">Save & Continue Later</button>
                                    </div>

                                </div>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Horizontal form layout section end -->

        </div>
    </div>
</div>
<!-- END: Content-->

 @endsection

 @section('js')
  @include('student.course_registration.scripts')
  <script src="/backend/sweetalert.min.js"></script>
 @endsection
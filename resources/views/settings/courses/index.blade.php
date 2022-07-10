@extends('layouts.app')
@section('PageTitle', 'Courses')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content ">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper container-xxl p-0">
      <div class="content-body">
          <!-- Basic Tables start -->
          <div class="row" id="basic-table">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Courses</h4>
                          <div class="row">
                            <div class="col-md-3 mb-1">
                                <input type="text" class="form-control form-control-sm" id="search" placeholder="Search..."/>
                            </div>
                            <div class="col-md-3 mb-1 mx-1">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle department-text" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        All Departments
                                    </button>
                                    <div class="dropdown-menu">
                                     <a class="dropdown-item change-department" href="#" data-department_id="" data-department_name="All Departments">All Departments</a>
                                        @foreach ($departments as $department)
                                             <a class="dropdown-item change-department" href="#" data-department_id="{{ $department->id }}" data-department_name="{{ $department->name }}">{{ $department->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="department-hold"/>
                            <input type="hidden" id="level-hold"/>
                            <input type="hidden" id="query-hold"/>

                            <div class="col-md-2 mb-1 mx-1">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle level-text" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        All Level
                                    </button>
                                    <div class="dropdown-menu">
                                       <a class="dropdown-item change-level" href="#" data-level_order="" data-level_name="All Levels">All Levels</a>
                                        @foreach ($levels as $level)
                                             <a class="dropdown-item change-level" href="#" data-level_order="{{ $level->order }}" data-level_name="{{ $level->name }}">{{ $level->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3 mb-1">
                              <a class="btn btn-primary btn-sm" href="{{ route('courses.create') }}">
                                  <i data-feather="plus"></i>
                                  <span>New Course(s)</span>
                              </a>
                           </div>
                        </div> 
                    </div>
                      
                      <div class="table-responsive table-data">

                        @include('settings.courses.table')
                        
                      </div>
                  </div>
              </div>
          </div>
          <!-- Basic Tables end -->
      </div>
  </div>
</div>
<!-- END: Content-->


 @endsection

 @section('js')
 @include('settings.courses.scripts')
 <script src="/backend/sweetalert.min.js"></script>
 @endsection
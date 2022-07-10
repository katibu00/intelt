@extends('layouts.app')
@section('PageTitle', 'Students')
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
                      <div class="card-header d-flex flex-md-row flex-column justify-content-md-between justify-content-start align-items-md-center align-items-start">
                        
                        <h4 class="card-title mb-1">Students</h4>

                     
                        <div class="col-md-3 mb-1">
                            <input type="text" class="form-control form-control-sm" id="search" placeholder="Search..."/>
                        </div>

                        <input type="hidden" id="department-hold"/>
                        <input type="hidden" id="level-hold"/>
                        <input type="hidden" id="status-hold"/>
                        <input type="hidden" id="query-hold"/>

                        <div class="col-md-2 mb-1">
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

                        <div class="col-md-1 mb-1">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle level-text" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All Level
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item change-level" href="#" data-level_id="" data-level_name="All Levels">All Levels</a>
                                    @foreach ($levels as $level)
                                        <a class="dropdown-item change-level" href="#" data-level_id="{{ $level->id }}" data-level_name="{{ $level->name }}">{{ $level->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 mb-1">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle status-text" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Active
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item change-status" href="#" data-status_id="1" data-status_name="Active">Active</a>
                                    <a class="dropdown-item change-status" href="#" data-status_id="2" data-status_name="Deffered">Deffered</a>
                                    <a class="dropdown-item change-status" href="#" data-status_id="3" data-status_name="Withdrawn">Withdrawn</a>
                                    <a class="dropdown-item change-status" href="#" data-status_id="3" data-status_name="Suspended">Suspended</a>
                                    <a class="dropdown-item change-status" href="#" data-status_id="4" data-status_name="Rusticated">Rusticated</a>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-2 mb-1">
                            <a class="btn btn-primary btn-sm" href="{{ route('students.create') }}">
                                <i data-feather="plus"></i>
                                <span>New Student(s)</span>
                            </a>
                        </div>
                        
                    
                    </div>
                      
                      <div class="table-responsive table-data">

                        @include('users.students.table')
                        
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
 @include('users.students.scripts')
 {{-- <script src="/backend/sweetalert.min.js"></script> --}}
 @endsection
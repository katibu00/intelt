@extends('layouts.app')
@php
  $title_singular = "Course"; 
  $title_plural = "Courses"; 
  if($institution_type == 'university'){
    $title_singular = "Department";
    $title_plural = "Departments";
  } 
  if($institution_type == 'nce'){
    $title_singular = "Department";
    $title_plural = "Departments";
  } 
@endphp
@section('PageTitle', $title_plural)
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
                          <h4 class="card-title">{{ $title_plural }}</h4>
                          <div class="row">
                              <div class="col-md-6 mb-1">
                                  <input type="text" id="search" class="form-control form-control-sm" placeholder="Search..."/>
                              </div>
                        
                              <div class="col-md-6 mb-1">
                                  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                                      <i data-feather="plus"></i>
                                      <span>New {{ $title_singular }}</span>
                                  </button>
                              </div>
                          </div>
                      </div>
                      
                      <div class="table-responsive table-data">
                        @include('settings.departments.table')
                        
                      </div>
                  
                      
                  </div>
              </div>
          </div>
          <!-- Basic Tables end -->

          @include('settings.departments.addModal')
          @include('settings.departments.updateModal')
          @include('settings.departments.deleteModal')

      </div>
  </div>
</div>
<!-- END: Content-->


 @endsection

 @section('js')
  @include('settings.departments.scripts')
 @endsection
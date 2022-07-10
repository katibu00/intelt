@extends('layouts.app')
@section('PageTitle', 'Sessions')
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
                          <h4 class="card-title">Sessions</h4>
                          <div class="row">
                              <div class="col-md-6 mb-1">
                                  <input type="text" id="search" class="form-control form-control-sm" placeholder="Search..."/>
                              </div>
                        
                              <div class="col-md-6 mb-1">
                                  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                                      <i data-feather="plus"></i>
                                      <span>New Session</span>
                                  </button>
                              </div>
                          </div>
                      </div>
                      
                      <div class="table-responsive table-data">
                        @include('settings.sessions.table')
                        
                      </div>
                  
                      
                  </div>
              </div>
          </div>
          <!-- Basic Tables end -->

          @include('settings.sessions.addModal')
          @include('settings.sessions.updateModal')
          @include('settings.sessions.deleteModal')

      </div>
  </div>
</div>
<!-- END: Content-->


 @endsection

 @section('js')
  @include('settings.sessions.scripts')
 @endsection
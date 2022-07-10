@extends('layouts.app')
@section('PageTitle', 'Grading System')
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
                          <h4 class="card-title">Grading System</h4>
                          <div class="row">
                              
                        
                              <div class="col-md-12 mb-1">
                                  <a class="btn btn-primary btn-sm" href="{{ route('grading.create')}}">
                                      <i data-feather="plus"></i>
                                      <span>New Grading System</span>
                                  </a>
                              </div>
                          </div>
                      </div>
                      
                      <div class="table-responsive table-data">
                       
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Marks Range</th>
                                    <th>Letter Grade</th>
                                    <th>Numerical Grade</th>
                                    <th>Remark</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                              @foreach ($allData as $key=> $value )
                          
                                <tr>
                                    
                                    <td>{{ 1 + $key}}</td>
                                    <td>{{ $value->start_mark}} - {{ $value->end_mark}}</td>
                                    <td>{{ $value->letter_grade}}</td>
                                    <td>{{ $value->numerical_grade}}</td>
                                    <td>{{ $value->remarks}}</td>
                                 
                                    <td>
                                      <button class="btn btn-info btn-small updateItem" 
                                          data-bs-toggle="modal" 
                                          data-bs-target="#updateModal"
                                          data-id="{{$value->id}}"
                                          data-name="{{$value->name}}">
                                          <i class="fa fa-edit"></i>
                                      </button>
                                      <button class="btn btn-danger btn-small deleteItem" 
                                          data-bs-toggle="modal" 
                                          data-bs-target="#deleteModal"
                                          data-id="{{$value->id}}"
                                          data-name="{{$value->name}}">
                                          <i class="fa fa-trash"></i>
                                      </button>
                                  </td>
                                  
                                </tr>
                                @endforeach
                            
                            </tbody>
                        </table>
                        
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

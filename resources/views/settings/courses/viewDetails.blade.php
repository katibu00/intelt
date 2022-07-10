@extends('layouts.app')
@section('PageTitle', 'View Course')
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
                          <h4 class="card-title">{{ @$dept->name }} - {{ @$level->name }} Courses Detail</h4>
                          <div class="row">
                              
                        
                              <div class="col-md-12 mb-1">
                                <a class="btn btn-primary" href="{{route('courses.index')}}"><i class="fa fa-list"></i> Courses List</a>                    
                              </div>
                          </div>
                      </div>
                      
                      <div class="table-responsive table-data">
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>S/N</th>
                                    <th>Semester</th>
                                    <th>Course</th>
                                    <th>CU</th>
                                    <th>Facilitator</th>
                                    <th>Designation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>FIrst Semester</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach ($firsts as $f => $first)
                                    <tr>
                                        <td></td>
                                        <td>{{ $f + 1 }}</td>
                                        <td>{{ $first->course_code }} - {{ $first->course_title }}</td>
                                        <td>{{ $first->credit_unit }}</td>
                                        <td>{{ $first['user']['first_name'] }} {{ $first['user']['middle_name'] }}
                                            {{ $first['user']['last_name'] }}</td>
                                        <td>{{ $first->designation }}</td>
                                        <td>
                                            <a href="{{ route('courses.edit',$first->id )}}" title="Edit" class="btn btn-sm btn-info mb-1" ><i class="fa fa-edit text-white"></i></a>
                                            <a title="Delete" class="btn btn-sm btn-danger mb-1" data-bs-toggle="modal"
                                                data-bs-target="#view_courses" role-id=""><i class="fa fa-trash text-white"></i></a>

                                        </td>

                                    </tr>
                                @endforeach



                                <tr>
                                    <td>2</td>
                                    <td>Second Semester</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                @foreach ($seconds as $s => $second)
                                    <tr>
                                        <td></td>
                                        <td>{{ $s + 1 }}</td>
                                        <td>{{ $second->course_code }} - {{ $second->course_title }}</td>
                                        <td>{{ $second->credit_unit }}</td>
                                        <td>{{ $second['user']['first_name'] }} {{ $second['user']['middle_name'] }}
                                            {{ $second['user']['last_name'] }}</td>
                                        <td>{{ $second->designation }}</td>
                                        <td>
                                          <a href="{{ route('courses.edit',$second->id )}}" title="Edit" class="btn btn-sm btn-info mb-1"><i class="fa fa-edit"></i></a>
                                          <a title="Delete" class="btn btn-sm btn-danger mb-1" data-bs-toggle="modal"
                                              data-bs-target="#view_courses" role-id=""><i class="fa fa-trash"></i></a>

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

          @include('settings.courses.deleteModal')


      </div>
  </div>
</div>
<!-- END: Content-->


 @endsection

 @section('js')
  @include('settings.courses.scripts')
 @endsection
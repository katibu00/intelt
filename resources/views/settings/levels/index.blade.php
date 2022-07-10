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
                          <h4 class="card-title">Levels</h4>
                          <div class="row">
                              
                        
                              <div class="col-md-12 mb-1">
                                  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                                      <i data-feather="plus"></i>
                                      <span>New Level</span>
                                  </button>
                              </div>
                          </div>
                      </div>
                      
                      <div class="table-responsive table-data">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">S/N</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Order</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($allData as $key => $data )
                                    <tr>
                                        <td>{{$key+ $allData->firstItem()}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{$data->order}}</td>
                                        <td>
                                            <button class="btn btn-info btn-small updateItem" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#updateModal"
                                                data-id="{{$data->id}}"
                                                data-name="{{$data->name}}"
                                                data-order="{{$data->order}}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-small deleteItem" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal"
                                                data-id="{{$data->id}}"
                                                data-name="{{$data->name}}">
                                               <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $allData->links() }}
                        
                      </div>
                  </div>
              </div>
          </div>
          <!-- Basic Tables end -->

          @include('settings.levels.addModal')
          @include('settings.levels.updateModal')
          @include('settings.levels.deleteModal')

      </div>
  </div>
</div>
<!-- END: Content-->


 @endsection

 @section('js')
  @include('settings.levels.scripts')
 @endsection
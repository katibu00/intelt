@extends('layouts.app')
@section('PageTitle', 'Add New Students')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content ">
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">
     
    </div>
    <div class="content-body">
        <section class="form-control-repeater">
            <div class="row">
                <!-- Invoice repeater -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add New Student(s)</h4>
                        </div>
                        <div class="card-body">
                    
                            <form class="invoice-repeater" id="create-students-form">
                                @csrf
                                <div class="row">

                                    <div class="col-md-3 mb-1">
                                        <label class="form-label" for="select2-basic">Department</label>
                                        <select class="select2 form-select" id="select2-basic" name="department_id">
                                            <option value="">Select Department</option>
                                            @foreach ($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="col-md-2 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="level">Level</label>
                                            <select class="form-select" id="level" name="level_id" required>
                                                <option value=""></option>
                                                @foreach ($levels as $level)
                                                <option value="{{$level->id}}">{{$level->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                   

                                </div><hr />
                               
                                <div data-repeater-list="student">
                                    <div data-repeater-item>
                                        <div class="row d-flex align-items-end">
                                            
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label">First Name *</label>
                                                    <input type="text" class="form-control" name="first_name" required/>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label">Middle Name</label>
                                                    <input type="text" class="form-control" name="middle_name" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label">Last Name *</label>
                                                    <input type="text" class="form-control" name="last_name" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label">Registration Number *</label>
                                                    <input type="text" class="form-control" name="reg_number" required/>
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
                                        <button class="btn btn-icon btn-outline-primary add_row" type="button" data-repeater-create>
                                            <i data-feather="plus" class="me-25"></i>
                                            <span>Row</span>
                                        </button>
                                        <button class="btn btn-icon btn-primary submit_btn" type="submit">
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

<script>
//submit course registratio form
$('#create-students-form').on('submit', function(e){
    e.preventDefault();
          
    var form_data = $(this).serialize();
    

    spinner = '<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div><span class="ms-25 align-middle"> Submitting...</span>';
    $('.submit_btn').html(spinner);
    $('.submit_btn').attr("disabled", true);
    $('.add_row').attr("disabled", true);

   
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "{{ route('students.index')}}",
        data: form_data,
        dataType: "json",
       success: function(response){
           
            if(response.status == 200){
                Command: toastr["success"](response.message)
                toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
                $('.submit_btn').html("Submit");
                $('.submit_btn').attr("disabled", false);
                $('.add_row').attr("disabled", false);
                $('#create-students-form')[0].reset();

            }
            if(response.status == 400){
                Command: toastr["error"](response.message)
                toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
                $('.submit_btn').html("Submit");
                $('.submit_btn').attr("disabled", false);
                $('.add_row').attr("disabled", false);
            }  
        }
    });


});
</script>

@endsection
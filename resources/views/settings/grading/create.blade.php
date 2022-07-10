@extends('layouts.app')
@section('PageTitle', 'New Grading System')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content ">
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper container-xxl p-0">
    <div class="content-header row">

    <div class="content-body">
        <section class="form-control-repeater">
            <div class="row">
                <!-- Invoice repeater -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add New Grading System</h4>
                        </div>
                        <div class="card-body">
                    
                            <form class="invoice-repeater" action="{{ route('grading.store') }}" method="POST">
                                @csrf
                        
                               
                                <div data-repeater-list="row">
                                    <div data-repeater-item>
                                        <div class="row d-flex align-items-end">
                                            
                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label">Start Mark</label>
                                                    <input type="number" class="form-control" name="start_mark" required/>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="end_mark">End Mark</label>
                                                    <input type="number" class="form-control" name="end_mark" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="letter_grade">Letter Grade</label>
                                                    <input type="text" class="form-control" name="letter_grade" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="numerical_grade">Numerical Grade</label>
                                                    <input type="number" class="form-control" name="numerical_grade" required/>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="remarks">Remarks</label>
                                                    <input type="text" class="form-control" name="remarks" required/>
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
                                        <button class="btn btn-icon btn-info" type="button" data-repeater-create>
                                            <i data-feather="plus" class="me-25"></i>
                                            <span>Add Row</span>
                                        </button>
                                        <button class="btn btn-icon btn-primary" type="submit">
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

@endsection
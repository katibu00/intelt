@extends('layouts.app')
@section('PageTitle', 'Institution Settings')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content ">
   <div class="content-overlay"></div>
   <div class="header-navbar-shadow"></div>
   <div class="content-wrapper container-xxl p-0">
      <div class="content-header row">
      </div>
      <div class="content-body">
            <!-- frequently asked questions tabs pills -->
            <section id="faq-tabs">
               <!-- vertical tab pill -->
               <div class="row">
                  <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="faq-navigation d-flex justify-content-between flex-column mb-2 mb-md-0">
                           <!-- pill tabs navigation -->
                           <ul class="nav nav-pills nav-left flex-column" role="tablist">
                              <!-- payment -->
                              <li class="nav-item">
                                    <a class="nav-link active" id="payment" data-bs-toggle="pill" href="#faq-payment"
                                       aria-expanded="true" role="tab">
                                       <i data-feather="credit-card" class="font-medium-3 me-1"></i>
                                       <span class="fw-bold">Basic</span>
                                    </a>
                              </li>

                              <!-- delivery -->
                              <li class="nav-item">
                                    <a class="nav-link" id="delivery" data-bs-toggle="pill" href="#faq-delivery"
                                       aria-expanded="false" role="tab">
                                       <i data-feather="shopping-bag" class="font-medium-3 me-1"></i>
                                       <span class="fw-bold">Account</span>
                                    </a>
                              </li>

                              <!-- cancellation and return -->
                              <li class="nav-item">
                                    <a class="nav-link" id="cancellation-return" data-bs-toggle="pill"
                                       href="#faq-cancellation-return" aria-expanded="false" role="tab">
                                       <i data-feather="refresh-cw" class="font-medium-3 me-1"></i>
                                       <span class="fw-bold">Application</span>
                                    </a>
                              </li>

                              <!-- my order -->
                              <li class="nav-item">
                                    <a class="nav-link" id="my-order" data-bs-toggle="pill" href="#faq-my-order"
                                       aria-expanded="false" role="tab">
                                       <i data-feather="package" class="font-medium-3 me-1"></i>
                                       <span class="fw-bold">Result</span>
                                    </a>
                              </li>

                              <!-- product and services-->
                              <li class="nav-item">
                                    <a class="nav-link" id="product-services" data-bs-toggle="pill"
                                       href="#faq-product-services" aria-expanded="false" role="tab">
                                       <i data-feather="settings" class="font-medium-3 me-1"></i>
                                       <span class="fw-bold">Other</span>
                                    </a>
                              </li>
                           </ul>
                        </div>
                  </div>


                  <div class="col-lg-9 col-md-8 col-sm-12">
                        <div class="card">
                           <div class="card-body">
                              <!-- pill tabs tab content -->
                              <div class="tab-content">

                                    <!-- payment panel -->
                                    <div role="tabpanel" class="tab-pane active" id="faq-payment"
                                       aria-labelledby="payment" aria-expanded="true">

                                       <div> <ul id="error_list"></ul></div>
                                       <!-- form -->
                                       <form id="profile" method="POST" enctype="multipart/form-data">
                                          
                                       <!-- header section -->
                                       <div class="d-flex">
                                          <a href="#" class="me-25">
                                                <img @if($institution->logo == 'default.png') src="/uploads/thumbnail-default.jpg" @else  src="/uploads/{{ @$institution->username }}/{{ @$institution->logo }}" @endif
                                                   id="account-upload-img" class="profile-pic rounded me-50"
                                                   alt="profile image" height="100" width="100" />
                                          </a>
                                          <!-- upload and reset button -->
                                          <div class="d-flex align-items-end mt-75 ms-1">
                                                <div>
                                                   <label for="account-upload"
                                                      class="btn btn-sm btn-primary mb-75 me-75">Change</label>
                                                   <input type="file" class="file-upload" name="logo" id="account-upload" hidden
                                                      accept="image/*" />
                                                   <button type="button" id="account-reset"
                                                      class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                                                   <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                                                </div>
                                          </div>
                                          <!--/ upload and reset button -->
                                       </div>
                                       <!--/ header section -->

                                 
                                          <div class="row mt-2 pt-50">

                                                <div class="col-12 col-sm-6 mb-1">
                                                   <label class="form-label" for="name">Institution Name</label>
                                                   <input type="text" class="form-control" id="name" name="name" value="{{ $institution->name }}" />
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                   <label class="form-label" for="motto">Institution Motto</label>
                                                   <input type="text" class="form-control" id="motto" name="motto" value="{{ $institution->motto }}" />
                                                </div>

                                                <div class="col-12 col-sm-12 mb-1">
                                                   <label class="form-label" for="address">Address</label>
                                                   <input type="text" class="form-control" id="address" name="address" value="{{ $institution->address }}" />
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                   <label class="form-label" for="phone">Phone Number</label>
                                                   <input type="text" class="form-control" id="phone" name="phone" value="{{ $institution->phone }}" />
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                   <label class="form-label" for="alternate_phone">Alternate Phone Number</label>
                                                   <input type="text" class="form-control" id="alternate_phone" name="alternate_phone" value="{{ $institution->alternate_phone }}" />
                                                </div>
                                                <div class="col-12 col-sm-6 mb-1">
                                                   <label class="form-label" for="email">Email</label>
                                                   <input type="text" class="form-control" id="email" name="email" value="{{ $institution->email }}" />
                                                </div>
                                                <div class="col-12 col-sm-6 mb-1">
                                                   <label class="form-label" for="website">Website</label>
                                                   <input type="text" class="form-control" id="website" name="website" value="{{ $institution->website }}" />
                                                </div>

                                                <div class="col-12 col-sm-6 mb-1">
                                                   <label for="session_id" class="form-label">Session</label>
                                                   <select id="session_id" class="select2 form-select" name="session_id">
                                                      <option value="">Select Session</option>
                                                      @foreach ($sessions as $session)
                                                      <option value="{{ $session->id }}"
                                                            {{ $session->id == $institution->session_id ? 'Selected' : '' }}>
                                                            {{ $session->name }}</option>
                                                      @endforeach
                                                   </select>
                                                </div>
                                                <div class="col-12 col-sm-6 mb-1">
                                                   <label for="semester" class="form-label">Semester</label>
                                                   <select id="semester" class="select2 form-select" name="semester">
                                                      <option value=""></option>
                                                      <option value="first" {{$institution->semester == 'first'? 'selected': ''}}>First</option>
                                                      <option value="second" {{$institution->semester == 'second'? 'selected': ''}}>Second</option>
                                                      
                                                   </select>
                                                </div>

                                                <div class="col-12">
                                                   <button type="submit" class="btn btn-primary mt-1 me-1" id="basic_btn">Save
                                                      changes</button>
                                                   <button type="reset"
                                                      class="btn btn-outline-secondary mt-1">Discard</button>
                                                </div>
                                          </div>
                                       </form>
                                       <!--/ form -->
                                    </div>

                                    <!-- delivery panel -->
                                    <div class="tab-pane" id="faq-delivery" role="tabpanel"
                                       aria-labelledby="delivery" aria-expanded="false">
                                       <!-- icon and header -->
                                       <div class="d-flex align-items-center">
                                          <div class="avatar avatar-tag bg-light-primary me-1">
                                                <i data-feather="shopping-bag" class="font-medium-4"></i>
                                          </div>
                                          <div>
                                                <h4 class="mb-0">Delivery</h4>
                                                <span>Which license do I need?</span>
                                          </div>
                                       </div>

                                    </div>


                              </div>
                           </div>
                        </div>

                  </div>
               </div>
            </section>
            <!-- / frequently asked questions tabs pills -->

      </div>
   </div>
</div>
<!-- END: Content-->

@endsection
@section('js')
    <script>
        $(document).ready(function() {


            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function() {
                readURL(this);
            });

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });

            //submit profile
            $(document).on('submit', '#profile', function(e) {
                e.preventDefault();

                let formData = new FormData($('#profile')[0]);

                spinner = '<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div><span class="ms-25 align-middle"> Saving...</span>';
                $('#basic_btn').html(spinner);
                $('#basic_btn').attr("disabled", true);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "{{ route('basic') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 400) {
                            $('#error_list').html("");
                            $('#error_list').addClass('alert alert-danger px-2 py-1');
                            $.each(response.errors, function(key, err) {
                                $('#error_list').append('<li>' + err + '</li>');
                            });
                            $('#basic_btn').text("Save Changes");
                            $('#basic_btn').attr("disabled", false);
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
                        }

                        if (response.status == 200) {
                            $('#error_list').html("");
                            $('#error_list').removeClass('alert alert-danger px-2 py-1');
                            $('#basic_btn').text("Save Changes");
                            $('#basic_btn').attr("disabled", false);


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

                        }
                    }
                })

            })


        });
    </script>
@endsection

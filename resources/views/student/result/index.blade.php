@extends('layouts.app')
@section('PageTitle', 'Generate Result')
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">

            <div class="content-body">
                <section id="multssiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">Generate Result</h4>
                                   
                                </div>
                                <div class="card-body my-1 py-50">
                                    <form class="form">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-4 mb-1">
                                                <label class="form-label" for="level_order">Level</label>
                                                <select class="select2 form-select" id="level_order" name="level_order">
                                                    <option value=""></option>
                                                    @foreach ($levels as $level)
                                                        <option value="{{ $level->order }}">{{ $level->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4 mb-1">
                                                <label class="form-label" for="semester">Semester</label>
                                                <select id="semester" class="form-select" aria-label="Semester" name="semester">
                                                    <option value=""></option>
                                                    <option value="first">First</option>
                                                    <option value="second">Second</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary mt-2 download_btn">Generate</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

@section('js')
<script type="text/javascript">
    $(".download_btn").click(function (e){
        e.preventDefault();
        

        var data = {
            'level_order': $('#level_order').val(),
            'semester': $('#semester').val(),
        }

        spinner = '<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div><span class="ms-25 align-middle"> Please wait...</span>';
        $('.download_btn').html(spinner);
        $('.download_btn').attr("disabled", true);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: "{{ route('student.result.generate') }}",
            data: data,
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response){
              
                if(response.status == 404){

                    $('.download_btn').html("Generate");
                    $('.download_btn').attr("disabled", false);

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
                }else{
                    var blob = new Blob([response]);
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download =  "first_semester_result.pdf";
                    link.click();
                    $('.download_btn').html("Generate");
                    $('.download_btn').attr("disabled", false);
                }
            },
            error: function(blob){
                console.log(blob);
            }
        })
    });
</script>


@endsection



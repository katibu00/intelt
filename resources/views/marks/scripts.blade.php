<script type="text/javascript">
    $(function() {
        //document ready
        $(document).ready( function(){
             var initial = $('#initial').val();
             var submitted = $('#submitted').val();
            
            if(initial == 'yes'){
                $('.initialize_btn').removeClass('d-none');
            }else{
                $('.submit_btn').removeClass('d-none');
            }

            if(submitted == 'yes'){
                $('input[type="number"]').attr('disabled', true);
                $('input[type="checkbox"]').attr('disabled', true);
                $('.submit_btn').addClass('d-none');
            }else{
                $('input[type="number"]').attr('disabled', false);
            }

            $('input[type="text"]').prop('disabled', true);
        });


        //initialize form fields
        $('#main_form').on('submit', function(e) {
            e.preventDefault();


            swal({
                    title: "Initialize Marks Entry?",
                    text: "Initializing marks will make it ready for entry",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {



                        var form_data = $(this).serialize();
                       

                        spinner =
                            '<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div><span class="ms-25 align-middle"> Initializing...</span>';
                        $('.initialize_btn').html(spinner);
                        $('.initialize_btn').attr("disabled", true);

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('initialize-marks-entry') }}",
                            data: form_data,
                            dataType: "json",
                            success: function(response) {

                                if (response.status == 200) {
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
                                    $('.initialize_btn').addClass('d-none');
                                    $('.submit_btn').removeClass('d-none');

                                }
                                if (response.status == 404) {
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
                                    $('.initialize_btn').html("Initialize");
                                    $('.initialize_btn').attr("disabled", false);
                                   
                                }
                               
                            }
                        });

                    }
                });



        });

        //as you type save
        $('input[type="number"]').focusout(function(){
           
            let user_id = $(this).data('user_id');
            let marks = $(this).val()
            let course_id = $('#course_id_send').val();
            let marks_category = $('#marks_category_send').val();

            let total = $('#total_students').val();



            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '{{ route('save-marks-entry')}}',
                data: {
                    'course_id': course_id,
                    'user_id': user_id,
                    'marks_category': marks_category,
                    'marks': marks,
                },
                success: function(res) {

                
                    if (res.status == 200) {
                        Command: toastr["info"](res.message)
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": true,
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

                        $("#marked").html(res.marked);

                        var parcent = res.marked/total*100;
                        $('.progress-bar').attr('style', `width: ${parcent}%`)
                        $('#remaining').html(total-res.marked + ' remaining');

                    }
                    if (res.status == 404) {
                        Command: toastr["error"](res.message)
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": true,
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
            });
        

        });


      
        //submit form fields
        $('.submit_btn').on('click', function(e) {
            e.preventDefault();


            swal({
                    title: "Submit Marks?",
                    text: "Once submitted, you will not be able to edit it!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {


                        var data = {
                            'course_id': $('#course_id_send').val(),
                            'marks_category': $('#marks_category_send').val(),
                        }

                        spinner =
                            '<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div><span class="ms-25 align-middle"> Submitting...</span>';
                        $('.submit_btn').html(spinner);
                        $('.submit_btn').attr("disabled", true);

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: "{{ route('submit-marks-entry') }}",
                            data: data,
                            dataType: "json",
                            success: function(response) {

                                if (response.status == 200) {
                                    Command: toastr[response.type](response.message)
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
                                    $('.submit_btn').addClass('d-none');
                                    $('input[type="number"]').attr('disabled', true);
                                    $('input[type="checkbox"]').attr('disabled', true);

                                }
                                if (response.status == 404) {
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
                                   

                                }
                                
                               
                            }
                        });

                    }
                });
        });


        //absent check
        $(document).on("click", ".absent", function() {
            
            let reg_number = $(this).data('reg_number');
            let marks = $(this).data('marks');
            var search = reg_number;


            let user_id = $(this).data('user_id');
            let course_id = $('#course_id_send').val();
            let marks_category = $('#marks_category_send').val();

            if($(this).prop("checked") == true)
            {
            
                $(function(){
                $("table tr td").filter(function() {
                    return $(this).text() == search;
                }).parent('tr').find('input[type="number"]').prop('type','text').prop('value', 'absent').prop('disabled', true);



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('check-absent-marks-entry') }}",
                    data: {
                        'course_id': course_id,
                        'user_id': user_id,
                        'marks_category': marks_category,
                    
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.status == 200) {
                            Command: toastr[response.type](response.message)
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
                });


            });

            }else
            {
            
                
                $(function(){
                $("table tr td").filter(function() {
                    return $(this).text() == search;
                }).parent('tr').find('input[type="text"]').prop('type','number').prop('value',marks).prop('disabled', false);


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('uncheck-absent-marks-entry') }}",
                    data: {
                        'course_id': course_id,
                        'user_id': user_id,
                        'marks_category': marks_category,
                        'marks': marks,
                    
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.status == 200) {
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
                });


            });

            }


          });

    });
</script>

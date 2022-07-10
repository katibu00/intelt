<script type="text/javascript">
    $(document).ready(function() {

        //change department
        $(document).on('click', '.change-level', function(e) {
            e.preventDefault();

            let level = $(this).data('level');
            let level_name = $(this).data('level_name');
            let semester = $(this).data('semester');



            $('.level-text').html(level_name + ' -' + semester + ' semester');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('get-recommeded-courses') }}",
                method: 'POST',
                data: {
                    level: level,
                    semester: semester,
                },

                success: function(res) {

                    if (res.status == 200) {

                        if(res.regulars.length > 0){
                            var html = '';
                            $.each(res.regulars, function(key, regular) {

                                html +=
                                    '<tr>' +
                                    '<td>' + (key + 1) + '</td>' +
                                    '<td>' + regular.course_code + '</td>' +
                                    '<td>' + regular.course_title + '</td>' +
                                    '<td class="text-center">' + regular.credit_unit +
                                    '</td>' +
                                    '<td class="text-center"><div class="form-check form-check-inline"><input class="form-check-input course" id="selected" type="checkbox" data-course_code="' +
                                        regular.course_code + '" data-course_title="' +
                                        regular.course_title + '" data-credit_unit="' +
                                        regular.credit_unit + '" data-course_id="' +
                                        regular.id + '" /></div></td>';

                            });
                            html = $('#regular-courses-tr').html(html);
                            $('.regular-div').removeClass('d-none');
                            // $('.elective-div').removeClass('d-none');
                        }else
                        {
                            Command: toastr["error"]("No Courses Found")
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
                            $('.regular-div').addClass('d-none');
                            $('.elective-div').addClass('d-none');
                        }
                        
                        if(res.electives.length > 0)
                        {
                            var html = '';
                            $.each(res.electives, function(key, elective) {

                                html +=
                                    '<tr>' +
                                    '<td>' + (key + 1) + '</td>' +
                                    '<td>' + elective.course_code + '</td>' +
                                    '<td>' + elective.course_title + '</td>' +
                                    '<td class="text-center">' + elective.credit_unit +
                                    '</td>' +
                                    '<td class="text-center"><div class="form-check form-check-inline"><input class="form-check-input course" id="selected" type="checkbox" data-course_code="' +
                                        elective.course_code + '" data-course_title="' +
                                        elective.course_title + '" data-credit_unit="' +
                                        elective.credit_unit + '" data-course_id="' +
                                        elective.id + '" /></div></td>';

                            });
                            html = $('#elective-courses-tr').html(html);
                            $('.elective-div').removeClass('d-none');
                        }else
                        {
                            $('.elective-div').addClass('d-none');
                            $('#elective-courses-tr').html("");
                        }

                        if(res.cos.length > 0)
                        {
                            var html = '';
                            $.each(res.cos, function(key, co) {

                                html +=
                                    '<tr>' +
                                    '<td>' + (key + 1) + '</td>' +
                                    '<td>' + co.course.course_code + '</td>' +
                                    '<td>' + co.course.course_title + '</td>' +
                                    '<td class="text-center">' + co.course.credit_unit +
                                    '</td>' +
                                    '<td class="text-center"><div class="form-check form-check-inline"><input class="form-check-input course" id="selected" type="checkbox" data-course_code="' +
                                        co.course.course_code + '" data-course_title="' +
                                        co.course.course_title + '" data-credit_unit="' +
                                        co.course.credit_unit + '" data-course_id="' +
                                        co.course.id + '" /></div></td>';

                            });
                            html = $('#co-courses-tr').html(html);
                            $('.co-div').removeClass('d-none');
                        }else
                        {
                            $('.co-div').addClass('d-none');
                            $('#co-courses-tr').html("");
                        }

                    }
                }
            });

        });


        //selection to add to registration table
        let lineNo = 1;
        let totalcr = 0;
        
        $(document).on('click', '.course', function(e) {

            $('.selected-div').removeClass('d-none');
            $('.reset').removeClass('d-none');

            if ($(this).is(':checked')) {
                let course_id = $(this).data('course_id');
                let course_code = $(this).data('course_code');
                let course_title = $(this).data('course_title');
                let credit_unit = $(this).data('credit_unit');

                var row = '';
                row +=
                    '<tr class="serial">' +
                    '<td class="key">' + lineNo +'</td>' +
                    '<td>' + course_code + '</td>' +
                    '<td>' + course_title + '</td>' +
                    '<td>' + credit_unit + '<input class="selected" type="hidden" name="course_id[]" value="'+course_id+'" />'+ '</td>' +
                    '<td class="text-center"><button class="DeleteButton" data-code="'+course_code+'" data-credits="'+credit_unit+'" >X</button></td>' +
                    '<tr>';

                $('.selected-courses-table > tbody:last-child').append(row);
                lineNo++;
                totalcr += credit_unit;
                $('#credit').html(totalcr);
                $('#registred').html(lineNo - 1);
                isChecked = false;
                $(this).prop("disabled", true);
            }

        });

        //remove courses
        $(".selected-courses-table").on("click", ".DeleteButton", function() {
            let credits = $(this).data('credits');
            let code = $(this).data('code');
            totalcr -= credits;
            lineNo--;

            $('#credit').html(totalcr);
            $('#registred').html(lineNo - 1);
            $(this).closest("tr").remove();
    
           

            $(".serial").each(function(row_count){
                $(this).children(".key").html(row_count+1);
            });

            var search = code;
        
            $(function(){
                $("table tr td").filter(function() {
                    return $(this).text() == search;
                }).parent('tr').find('input:checkbox').prop('checked', this.value==0).prop('disabled', false);
            });

        });




        //submit course registratio form
        $('#register_course_form').on('submit', function(e){
            e.preventDefault();



            swal({
                    title: "Submit Courses?",
                    text: "Once submitted, you will not be able to edit it!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                   
                        
            var form_data = $(this).serialize();
            

            spinner = '<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div><span class="ms-25 align-middle"> Submitting...</span>';
            $('.submit_btn').html(spinner);
            $('.submit_btn').attr("disabled", true);
           
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('submit-courses')}}",
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
                    }  
                }
            });


                    }
                });


       
        });

       
        //reset all
        $(document).on('click', '.reset', function(e) {

            $('input:checkbox').prop('checked', false);
            $('input:checkbox').prop('disabled', false);
            $(".selected-courses-table > tbody").empty();
            totalcr = 0;
            lineNo = 1;
            $('#credit').html(totalcr);
            $('#registred').html('0');
    
        });

    });
</script>

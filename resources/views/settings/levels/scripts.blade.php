
 <script>
     $(document).ready(function(){

        $(document).on('click', '#add_btn', function(e){
         e.preventDefault();
         
         var data = {
             'name': $('#name').val(),
             'order': $('#order').val(),
         }

         spinner = '<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div><span class="ms-25 align-middle"> Submitting...</span>';
                 $('#add_btn').html(spinner);
                 $('#add_btn').attr("disabled", true);

               
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
                type: "POST",
                url:  "{{ route('levels.create') }}",
                data: data,
                dataType: "json",
                success: function(response){
                    if(response.status == 400){
                        $('#error_list').html("");
                        $('#error_list').addClass('alert alert-danger px-2 py-1');
                        $.each(response.errors, function (key, err){
                            $('#error_list').append('<li>'+err+'</li>');
                        });
                        $('#add_btn').text("Submit");
                        $('#add_btn').attr("disabled", false);

                    }
                  
                    if(response.status == 200){
                        $('#success_message').html("");
                        $('#error_list').html("");
                        $('#error_list').removeClass('alert alert-danger px-2 py-1');
                        $('#addModal').modal('hide');
                        $('#addModal').find('input').val("");
                        $('#add_btn').text("Submit");
                        $('#add_btn').attr("disabled", false);
                        $('.table').load(location.href+' .table');

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
        


        $(document).on('click', '.updateItem', function(e){
         e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            let order = $(this).data('order');
        
        
            $('#update_id').val(id);
            $('#update_name').val(name);
            $('#update_order').val(order);
            
              $('#update_error_list').html("");
              $('#update_error_list').removeClass('alert alert-danger px-2 py-1');

         });

        $(document).on('click', '#update_btn', function(e){
         e.preventDefault();
           
            
            var data = {
             'update_id': $('#update_id').val(),
             'update_name': $('#update_name').val(),
             'update_order': $('#update_order').val(),
         }

           spinner = '<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div><span class="ms-25 align-middle"> Updating...</span>';
            $('#update_btn').html(spinner);
            $('#update_btn').attr("disabled", true);
               
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                type: "POST",
                url:  "{{ route('levels.update') }}",
                data: data,
                dataType: "json",
                success: function(response){
                   
                    if(response.status == 400){
                        $('#update_error_list').html("");
                        $('#update_error_list').addClass('alert alert-danger px-2 py-1');
                        $.each(response.errors, function (key, err){
                            $('#update_error_list').append('<li>'+err+'</li>');
                        });
                        $('#update_btn').removeAttr("disabled");
                        $('#update_btn').text("Update");
                    }
                  
                    if(response.status == 200){
                        $('#success_message').html("");
                        $('#error_list').html("");
                        $('#error_list').removeClass('alert alert-danger px-2 py-1');
                        $('#updateModal').modal('hide');
                        $('#updateModal').find('input').val("");
                        $('#update_btn').text("Update");
                        $('#update_btn').removeAttr("disabled");
                        $('.table').load(location.href+' .table');

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


       $(document).on('click', '.deleteItem', function(e){
         e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
        
        
            $('#delete_id').val(id);
            $('.deleteTitle').html('Delete '+name+'?');
            
         });


        $(document).on('click', '#delete_btn', function(e){
         e.preventDefault();
           
            
            var data = {
             'delete_id': $('#delete_id').val(),
         }

         spinner = '<div class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></div><span class="ms-25 align-middle"> Deleting...</span>';
            $('#delete_btn').html(spinner);
            $('#delete_btn').attr("disabled", true);
               
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                type: "POST",
                url:  "{{ route('levels.delete') }}",
                data: data,
                dataType: "json",
                success: function(response){
                   
                    if(response.status == 200){
            
                        $('#deleteModal').modal('hide');
                        $('#deleteModal').find('input').val("");
                        $('#delete_btn').text("Delete");
                        $('#delete_btn').attr("disabled", false);
                        $('.table').load(location.href+' .table');

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


    });

 </script>
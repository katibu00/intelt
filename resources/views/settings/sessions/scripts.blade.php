
 <script>
    $(document).ready(function(){

       $(document).on('click', '#add_btn', function(e){
        e.preventDefault();
        
        var data = {
            'name': $('#name').val(),
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
               url:  "{{ route('sessions.create') }}",
               data: data,
               dataType: "json",
               success: function(response){
                   if(response.status == 400){
                       $('#error_list').html("");
                       $('#error_list').addClass('alert alert-danger px-2 py-1');
                       $.each(response.errors, function (key, err){
                           $('#error_list').append('<li>'+err+'</li>');
                       });
                       $('#add_btn').attr("disabled", false);
                       $('#add_btn').text("Submit");
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
       

       //update click
       $(document).on('click', '.updateItem', function(e){
        e.preventDefault();
           let id = $(this).data('id');
           let name = $(this).data('name');
       
       
           $('#update_id').val(id);
           $('#update_name').val(name);
           
             $('#update_error_list').html("");
             $('#update_error_list').removeClass('alert alert-danger');

        });


        //update operation
       $(document).on('click', '#update_btn', function(e){
        e.preventDefault();
          
           
           var data = {
            'update_id': $('#update_id').val(),
            'update_name': $('#update_name').val(),
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
               url:  "{{ route('sessions.update') }}",
               data: data,
               dataType: "json",
               success: function(response){
                  
                   if(response.status == 400){
                       $('#update_error_list').html("");
                       $('#update_error_list').addClass('alert alert-danger');
                       $.each(response.errors, function (key, err){
                           $('#update_error_list').append('<li>'+err+'</li>');
                       });
                       $('#update_btn').removeAttr("disabled");
                       $('#update_btn').text("Update");
                   }
                 
                   if(response.status == 200){
                       $('#success_message').html("");
                       $('#error_list').html("");
                       $('#error_list').removeClass('alert alert-danger');
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

       //delete
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
               url:  "{{ route('sessions.delete') }}",
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



       //pagination
        $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
          
        let page = $(this).attr('href').split('page=')[1]
        fetchData(page)
           
        });

        function fetchData(page){
           $.ajax({
               url: "/paginate-sessions?page="+page,
               success: function(res){
                   $('.table-data').html(res);
               }
           });
        }

        //search
        $(document).on('keyup', function(e){
        e.preventDefault();
          
        let query = $('#search').val();

         $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });

         $.ajax({
               url: "{{ route('search.sessions') }}",
               method: 'POST',
               data: {query:query},

               success: function(res){
                   $('.table-data').html(res);
                   if(res.status == 404){
                       $('.table-data').html('<p class="text-danger text-center">No Data Matched the Query</p>');
                   }
               }
           });
           
        });


   });

</script>
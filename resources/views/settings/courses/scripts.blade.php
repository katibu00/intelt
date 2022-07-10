<script>
    $(document).ready(function() {


        //pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();

            let page = $(this).attr('href').split('page=')[1]
            fetchData(page)

        });

        function fetchData(page) {

            
            $.ajax({
                url: "/paginate-courses?page=" + page,
                data: {
                    department_id: $('#department-hold').val(),
                    level: $('#level-hold').val(),
                    query: $('#query-hold').val(),
                },
                success: function(res) {
                    $('.table-data').html(res);
                }
            });
        }




        //search
        $(document).on('keyup', function(e) {
            e.preventDefault();

            let query = $('#search').val();
            $('#query-hold').val(query);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('search.courses') }}",
                method: 'POST',
                data: {
                    query: query
                },

                success: function(res) {
                    $('.table-data').html(res);
                    if (res.status == 404) {
                        $('.table-data').html(
                            '<p class="text-danger text-center">No Data Found</p>'
                        );
                    }
                }
            });

        });


        //change department
        $(document).on('click', '.change-department', function(e) {
            e.preventDefault();

            let department_id = $(this).data('department_id');
            let department_name = $(this).data('department_name');

            $('.department-text').html(department_name);
            $('#department-hold').val(department_id);


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('sort.courses') }}",
                method: 'POST',
                data: {
                    department_id: department_id,
                    level: $('#level-hold').val(),
                },

                success: function(res) {
                    $('.table-data').html(res);
                    if (res.status == 404) {
                        $('.table-data').html(
                            '<p class="text-danger text-center">No Data Found</p>'
                        );
                    }
                }
            });

        });
        //change level
        $(document).on('click', '.change-level', function(e) {
            e.preventDefault();

            let level_order = $(this).data('level_order');
            let level_name = $(this).data('level_name');




            $('.level-text').html(level_name);
            $('#level-hold').val(level_order);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('sort.courses') }}",
                method: 'POST',
                data: {
                    level: level_order,
                    department_id: $('#department-hold').val(),
                },

                success: function(res) {
                    $('.table-data').html(res);
                    if (res.status == 404) {
                        $('.table-data').html(
                            '<p class="text-danger text-center">No Data Found.</p>'
                        );
                    }
                }
            });

        });


        //delete item
        $(document).on('click', '.deleteItem', function(e) {
            e.preventDefault();

            let id = $(this).data('id');
            let name = $(this).data('name');

            swal({
                    title: "Delete " + name + "?",
                    text: "Once deleted, you will not be able to recover it!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });


                        $.ajax({
                            url: "{{ route('courses.delete') }}",
                            method: 'POST',
                            data: {
                                id: id,
                            },

                            success: function(res) {

                                if (res.status == 200) {
                                    swal('Deleted', res.message, "success");
                                    $('.table').load(location.href + ' .table');
                                }

                            }
                        });

                    }
                });

        });


    });
</script>

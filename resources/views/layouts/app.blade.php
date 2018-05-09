<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Arhan Ashik">

        <title>Simple Laravel CRUD Ops</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        @yield('css')

    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="container container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{url('/customer')}}">SIMPLE LARAVEL CRUD OPERATIONS</a>
                </div>
            </div>
        </nav>

        <div class="container">
            @yield('content')
        </div>

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        {{-- ajax form add customer --}}
        <script type="text/javascript">
            $(document).on('click','.create-modal', function () {
                $('#create').modal('show');
                $('.form-horizontal').show();
                $('.modal-title').text("Add Customer");
            });

            //function AddCustomer
            $('#add').click(function () {
               $.ajax({
                   type : 'POST',
                   url : 'addCustomer',
                   data : {
                       '_token' : $('input[name=_token]').val(),
                       'name' : $('input[name=name]').val(),
                       'job_reference' : $('input[name=job_reference]').val(),
                       'company_name' : $('input[name=company_name]').val(),
                       'note' : $('input[name=note]').val(),
                       'email' : $('input[name=email]').val(),
                   },
                   success : function (data) {
                       if(data.errors){
                           if(data.errors.name){
                               $('#error-name').removeClass('hidden');
                               $('#error-name').text(data.errors.name);
                           }
                           else $('#error-name').addClass('hidden');

                           if(data.errors.job_reference){
                               $('#error-job_reference').removeClass('hidden');
                               $('#error-job_reference').text(data.errors.job_reference);
                           }
                           else $('#error-job_reference').addClass('hidden');

                           if(data.errors.company_name){
                               $('#error-company_name').removeClass('hidden');
                               $('#error-company_name').text(data.errors.company_name);
                           }
                           else $('#error-company_name').addClass('hidden');

                           if(data.errors.note){
                               $('#error-note').removeClass('hidden');
                               $('#error-note').text(data.errors.note);
                           }
                           else $('#error-note').addClass('hidden');

                           if(data.errors.email){
                               $('#error-email').removeClass('hidden');
                               $('#error-email').text(data.errors.email);
                           }
                           else $('#error-email').addClass('hidden');
                       }
                       else {
                           $('.error').remove();
                           $('#table').append("<tr class='customer" + data.id + "'>" +
                                   "<td>" + data.id + "</td>" +
                                   "<td>" + data.name + "</td>" +
                                   "<td>" + data.job_reference + "</td>" +
                                   "<td>" + data.company_name + "</td>" +
                                   "<td>" + data.note + "</td>" +
                                   "<td>" + data.email + "</td>" +
                                   "<td>" + data.created_at + "</td>" +
                                   "<td>" +
                                   "<a href='#' class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-job_referfence='"+ data.job_reference +"' data-company_name='"+ data.company_name +"' data-note='"+ data.note +"'data-email='"+ data.email +"'><i class='fa fa-eye'></i></a>" +
                                   "<a href='#' class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-job_referfence='"+ data.job_reference +"' data-company_name='"+ data.company_name +"' data-note='"+ data.note +"'data-email='"+ data.email +"'><i class='glyphicon glyphicon-pencil'></i></a>" +
                                   "<a href='#' class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-job_referfence='"+ data.job_reference +"' data-company_name='"+ data.company_name +"' data-note='"+ data.note +"'data-email='"+ data.email +"'><i class='glyphicon glyphicon-trash'></i></a>" +
                                   "</td>" +
                                   "</tr>");

                           $('#name').val('');
                           $('#job_reference').val('');
                           $('#company_name').val('');
                           $('#note').val('');
                           $('#email').val('');
                       }
                   },
               });
            });

            //function show customer
            $(document).on('click', '.show-modal', function () {
                $('#sid').text('ID: ' + $(this).data('id'));
                $('#sname').text('Name: ' + $(this).data('name'));
                $('#sjob_reference').text('Job Reference: ' + $(this).data('job_reference'));
                $('#scompany_name').text('Company: ' + $(this).data('company_name'));
                $('#snote').text('Note: ' + $(this).data('note'));
                $('#semail').text('Email: ' + $(this).data('email'));
                $('.modal-title').text('Customer information');
               $('#show').modal('show');
            });

            //function edit customer
            $(document).on('click', '.edit-modal', function () {
                $('#footer_action_button').text('Update Customer');
                $('#footer_action_button').removeClass('glyphicon-trash');
                $('#footer_action_button').addClass('glyphicon-check');
                $('.actionBtn').addClass('btn-success');
                $('.actionBtn').removeClass('btn-danger');
                $('.actionBtn').addClass('edit');
                $('.modal-title').text('Edit Customer');
                $('.deletecontent').hide();
                $('.form-horizontal').show();
                $('#fid').val($(this).data('id'));
                $('#nm').val($(this).data('name'));
                $('#j').val($(this).data('job_reference'));
                $('#c').val($(this).data('company_name'));
                $('#nt').val($(this).data('note'));
                $('#e').val($(this).data('email'));
                $('#myModel').modal('show');
            });

            $('.modal-footer').on('click', '.edit', function () {
                $.ajax({
                   type : 'POST',
                   url : 'editCustomer',
                   data : {
                       '_token' : $('input[name=_token]').val(),
                       'id' : $('#fid').val(),
                       'name' : $('#nm').val(),
                       'job_reference' : $('#j').val(),
                       'company_name' : $('#c').val(),
                       'note' : $('#nt').val(),
                       'email' : $('#e').val(),
                   },
                    success : function (data) {
                        $('.customer' + data.id).replaceWith("<tr class='customer" + data.id + "'>" +
                            "<td>" + data.id + "</td>" +
                            "<td>" + data.name + "</td>" +
                            "<td>" + data.job_reference + "</td>" +
                            "<td>" + data.company_name + "</td>" +
                            "<td>" + data.note + "</td>" +
                            "<td>" + data.email + "</td>" +
                            "<td>" + data.created_at + "</td>" +
                            "<td>" +
                            "<a href='#' class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-job_referfence='"+ data.job_reference +"' data-company_name='"+ data.company_name +"' data-note='"+ data.note +"'data-email='"+ data.email +"'><i class='fa fa-eye'></i></a>" +
                            "<a href='#' class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-job_referfence='"+ data.job_reference +"' data-company_name='"+ data.company_name +"' data-note='"+ data.note +"'data-email='"+ data.email +"'><i class='glyphicon glyphicon-pencil'></i></a>" +
                            "<a href='#' class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-job_referfence='"+ data.job_reference +"' data-company_name='"+ data.company_name +"' data-note='"+ data.note +"'data-email='"+ data.email +"'><i class='glyphicon glyphicon-trash'></i></a>" +
                            "</td>" +
                            "</tr>");
                    },
                });
            });

            //function delete customer
            $(document).on('click', '.delete-modal', function () {
                $('#footer_action_button').text('Delete Customer');
                $('#footer_action_button').removeClass('glyphicon-check');
                $('#footer_action_button').addClass('glyphicon-trash');
                $('.actionBtn').removeClass('btn-success');
                $('.actionBtn').addClass('btn-danger');
                $('.actionBtn').addClass('delete');
                $('.modal-title').text('Delete Customer');
                $('.id').text($(this).data('id'));
                $('.deletecontent').show();
                $('.form-horizontal').hide();
                $('.name').html($(this).data('name'));
                $('#myModel').modal('show');
            });

            $('.modal-footer').on('click', '.delete', function () {
                $.ajax({
                    type : 'POST',
                    url : 'deleteCustomer',
                    data : {
                        '_token' : $('input[name=_token]').val(),
                        'id' : $('.id').text(),
                    },
                    success : function (data) {
                        $('.customer' + $('.id').text()).remove();
                    },
                });
            });

            //function Search Customer
            $('#search-btn').click(function () {
                $.ajax({
                    type : 'GET',
                    url : 'searchCustomer',
                    data : {
                        '_token' : $('input[name=_token]').val(),
                        'key' : $('#key').val(),
                    },
                    success : function (data) {
                        var result = $('<div />').append(data).find('#table').html();
                        $('#table').html(result);
                    },
                    error: function (xhr, status) {
                        alert("Sorry, there was a problem!");
                    },
                    complete: function (xhr, status) {
                        //$('#showresults').slideDown('slow')
                    }
                });
            });
        </script>
`   </body>
</html>
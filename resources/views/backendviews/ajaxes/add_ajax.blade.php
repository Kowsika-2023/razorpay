@extends('backendviews.layouts.app')
@section('content')
@include('backendviews.layouts.navbar')
@include('backendviews.layouts.sidebar')
<main id="main-container">
      <!-- Hero -->
      <div class="bg-body-light ">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Admins<small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"></small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Add Admin</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a style="color:black" href="">Admins</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
   <!-- END Hero -->
   <div class="content">
    <div class="block block-rounded">
      <div class="block-header">
          
             <h3 class="block-title ">Add Admin</h3>
          
           
        </div> 
         <div class="block-content block-content-full">
    
           
                
                <form name="contactUsForm" id="contactUsForm" method="post" action="javascript:void(0)">
       @csrf

        <div class="form-group">
          <label for="exampleInputEmail1">Name</label>
          <input type="text" id="name" name="name" class="form-control">
        </div>
        
        <div class="form-group">
          <label for="exampleInputEmail1">Mobile</label>
          <input type="text" id="mobile" name="mobile" class="form-control">
        </div>

         <div class="form-group">
          <label for="exampleInputEmail1">Email</label>
          <input type="email" id="email" name="email" class="form-control">
        </div>           

        <div class="form-group">
          <label for="exampleInputEmail1">Message</label>
          <textarea name="message" id="message" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
      </form>
 


  
  
         
         </div>


         
        </div></div>
        </div>
   
   @endsection
   @section('script')
   
    <script>
$(document).ready(function () {
    $("#submit").click(function () {
        // Perform client-side validation using jQuery Validation Plugin
        if ($("#contactUsForm").valid()) {
            // If client-side validation passes, make an Ajax request to the server
            $.ajax({
                url: "{{ url('ajax/') }}",
                type: "POST",
                data: $("#contactUsForm").serialize(),
                success: function (response) {
                    // Handle the server's response
                    alert('Ajax form has been submitted successfully');
                    document.getElementById("contactUsForm").reset();
                },
                error: function (xhr) {
                    // Handle errors, if any
                    console.log(xhr.responseText);
                }
            });
        }
    });

    // Initialize jQuery Validation Plugin
        $("#contactUsForm").validate({
                    rules: {
                name: {
                required: true,
                maxlength: 50
            },
            email: {
                required: true,
                maxlength: 50,
                email: true,
            },  
            message: {
                required: true,
                maxlength: 300
            },   
            },
            messages: {
            name: {
                required: "Please enter name",
                maxlength: "Your name maxlength should be 50 characters long."
            },
            email: {
                required: "Please enter valid email",
                email: "Please enter valid email",
                maxlength: "The email name should less than or equal to 50 characters",
            },   
            message: {
                required: "Please enter message",
                maxlength: "Your message name maxlength should be 300 characters long."
            },
            },
            submitHandler: function(form) {
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#submit').html('Please Wait...');
                $("#submit"). attr("disabled", true);

            
            }
        });
});
  </script>


     </main>
   @endsection

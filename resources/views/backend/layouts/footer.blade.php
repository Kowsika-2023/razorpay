<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/oneui.core.min.js') }}"></script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"
    integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

<script>  
   CKEDITOR.replace( 'product_description' );
   CKEDITOR.replace( 'long_description' );
    $(document).ready(function() {
        @if (session('status'))
            Swal.fire({
                imageUrl: '{{ session('status') }}',
                timer: 4000,
                text: '{{ session('message') }}',
                imageAlt: 'Custom image',
                width: '350',
                showConfirmButton: true,
                confirmButtonColor: '#2cabf5',
            })
        @endif
    });
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("fa-eye-slash");
                $('#show_hide_password i').removeClass("fa-eye");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("fa-eye-slash");
                $('#show_hide_password i').addClass("fa-eye");
            }
        });
    });
    $(document).ready(function() {
        $("#show_hide_password1 a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password1 input').attr("type") == "text") {
                $('#show_hide_password1 input').attr('type', 'password');
                $('#show_hide_password1 i').addClass("fa-eye-slash");
                $('#show_hide_password1 i').removeClass("fa-eye");
            } else if ($('#show_hide_password1 input').attr("type") == "password") {
                $('#show_hide_password1 input').attr('type', 'text');
                $('#show_hide_password1 i').removeClass("fa-eye-slash");
                $('#show_hide_password1 i').addClass("fa-eye");
            }
        });
    });
</script>
<script src="{{ asset('assets/js/oneui.app.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/be_pages_dashboard_v1.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/op_auth_signin.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
<script>
    jQuery(function() {
        One.helpers('select2');
    });
</script>
<script src="{{ asset('assets/js/pages/be_forms_validation.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/flatpickr/flatpickr.min.js') }}"></script>
<script>
    jQuery(function() {
        One.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs',
            'rangeslider'
        ]);
    });
</script>
<script src="{{ asset('assets/js/plugins/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
<script>
    jQuery(function() {
        One.helpers('magnific-popup');
    });
    
    $(document).ready(function() {
        toastr.options.timeOut = 1000;

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            }
            toastr.error('{{ Session::get('error') }}');
        @elseif (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            }
            toastr.warning('{{ Session::get('warning') }}');
        @elseif (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            }
            toastr.success('{{ Session::get('success') }}');
        @endif
   
        $(document).ready(function() {
  $('#testSelect1').multiselect({
    checkboxClick: function(event, ui) {
      if (ui.checked) {
        console.log("Checkbox for item with value '" + ui.value + "' was clicked and got value true");
      } else {
        console.log("Checkbox for item with value '" + ui.value + "' was clicked and got value false");
      }
    },
    checkAll: function(event, ui) {
      console.log("Checkbox 'Select All' was clicked and got value " + ui.checked);
    }
  });
});


});
</script>



{{--ckeditor --}}
<script>
    document.addEventListener("DOMContentLoaded", function () {
    ClassicEditor
        .create(document.querySelector('#js-ckeditor5-classic'))
        .then(editor => {
            console.log('CKEditor initialized successfully:', editor);
        })
        .catch(error => {
            console.error('CKEditor initialization error:', error);
        });
});
</script>

<script src="{{ asset('assets/js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/be_forms_wizard.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script>
@yield('script')
</body>

</html>

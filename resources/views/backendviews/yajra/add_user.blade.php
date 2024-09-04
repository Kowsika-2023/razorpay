@extends('backend.layouts.app')
@section('content')
@include('backend.layouts.navbar')
@include('backend.layouts.sidebar')

<main id="main-container">
    <!-- Hero -->
    <div class="bg-body-light ">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-sm-fill h3 my-2">
                    Banners<small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"></small>
                </h1>
                <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">Add Banners</li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a style="color:black" href="">Banners</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="block block-rounded">
            <div class="block-header">
                <h3 class="block-title ">Add Banner</h3>
            </div>
            <div class="block-content block-content-full">

                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    
<label>VIEW IMAGE</label>
<?php $user = App\Models\User::find(59); ?>

<div class="form-group col-8">
                                <label for="sub_heading">Image</label>
                                <div class="mb-4">
                                    <div class="row gutters-tiny items-push js-gallery push">
                                        <div class="animated fadeIn">
                                            <div class="options-container fx-item-rotate-r">
                                                <img src="{{ asset('banner/'.$user->image) }}" readonly alt="your image" width="551px" height="368px" />
                                                <div class="options-overlay bg-black-75">
                                                    <div class="options-overlay-content">
                                                        <a class="btn btn-sm btn-primary img-lightbox" href="{{ asset('banner/'.$user->image) }}" >
                                                            <i class="fa fa-search-plus mr-1"></i> View
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>









                    <input type="file" id="inputImage" name="image" accept="image/*">
                    <br>
                    <br>
                    <div>
                    <img id="image" src="" alt="Picture" >
                    </div>
                    <div id="croppedResult"></div>
                    <button type="button" id="cropButton" class="mt-5 mb-5 btn btn-primary">Crop</button>
                    <button type="button" id="reset" class="mt-5 mb-5 btn btn-danger">Reset</button>

                    <div class="form-group pt-2">
                        <a href=""><button type="button" class="btn btn-secondary">Back</button></a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>         


                    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>

<script>

    $('#cropButton').hide();
    $('#reset').hide();

  window.addEventListener('DOMContentLoaded', function () {
    var image = document.getElementById('image');
    var inputImage = document.getElementById('inputImage');
    var cropper;

    inputImage.addEventListener('change', function () {
      var file = this.files[0];
      var reader = new FileReader();

      reader.onload = function (event) {
        $('#cropButton').show();

        image.src = event.target.result;
        if (cropper) {
          cropper.destroy(); // Destroy previous cropper instance if exists
        }
        cropper = new Cropper(image, {
          aspectRatio: 16 / 9, // You can adjust the aspect ratio as needed
          viewMode: 1,
          zoomable: false
        });
      };

      reader.readAsDataURL(file);
    });

    document.getElementById('cropButton').addEventListener('click', function (event) {
    $('#reset').show();
      event.preventDefault(); // Prevent default form submission behavior

      if (!cropper) {
        return;
      }
      var canvas = cropper.getCroppedCanvas();
      if (!canvas) {
        return;
      }
      var croppedImage = canvas.toDataURL();

      
      

      // Display cropped image on the page
      var croppedResult = document.getElementById('croppedResult');
      var newImage = new Image();
      newImage.src = croppedImage;
      croppedResult.appendChild(newImage);
    });
  });

  document.getElementById('reset').addEventListener('click', function() {
    var croppedResult = document.getElementById("croppedResult");
    croppedResult.innerHTML = ''; // Clear the content of the croppedResult element
    $('#reset').hide();
    $('#crop_button').show();
});

</script> 


                </form>
            </div>
        </div>
    </div>
    
</main>
@endsection
@section('style')
<style>
img[alt=""] {
    display: none;
}
</style>
@endsection
@section('script')


@endsection
<div id="page-container" class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
    <!-- Header -->
     <header id="page-header">
      <!-- Header Content -->
      <div class="content-header">
          <!-- Left Section -->
          <div class="d-flex align-items-center ">
              <!-- Toggle Sidebar -->
              <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
              <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none " data-toggle="layout" data-action="sidebar_toggle">
                  <i class="fa fa-fw fa-bars"></i>
              </button>
              <!-- END Toggle Sidebar -->

              <!-- Toggle Mini Sidebar -->
              <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
              <button type="button" class="btn btn-sm btn-dual mr-2 d-none text-white  p-2 d-lg-inline-block gradientBRD" data-toggle="layout" data-action="sidebar_mini_toggle">
                  <i class="fa fa-fw fa-ellipsis-v"></i>
              </button>
              <!-- END Toggle Mini Sidebar -->
            </div>
          <!-- END Left Section -->

          <!-- Right Section -->
          <div class="d-flex align-items-center " >
              <!-- User Dropdown -->
              <div class="dropdown d-inline-block ml-2" >
                  <button type="button" class="btn btn-sm btn-dual d-flex align-items-center gradientBRD" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <img class="rounded-circle" src="{{ asset('assets/media/avatars/avatar10.jpg') }}" alt="Header Avatar" style="width: 21px;">

                      <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ml-1 mt-1"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown" >
                      <div class="p-3 text-center  rounded-top gradientBRD" >
                          <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('assets/media/avatars/avatar10.jpg') }}" alt="">
                      
                        </div>
                      <div class="p-2">
                         
                          </a>
                      </div>
                  </div>
              </div>
              <!-- END User Dropdown -->
          </div>
          <!-- END Right Section -->
      </div>
      <!-- END Header Content -->

    

      <!-- Header Loader -->
      <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
      <div id="page-header-loader" class="overlay-header bg-white">
          <div class="content-header">
              <div class="w-100 text-center">
                  <i class="fa fa-fw fa-circle-notch fa-spin"></i>
              </div>
          </div>
      </div>
      <!-- END Header Loader -->
  </header>
  <!-- END Header -->

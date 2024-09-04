<style>
     .sidebar1 {
        background: radial-gradient(ellipse farthest-corner at right bottom, #000000 0%, #000000 8%, #030202 30%, #090800 40%, transparent 80%),
            radial-gradient(ellipse farthest-corner at left top, #000000 0%, #000000 8%, #000000 25%, #000000 62.5%, #000000 100%);
        box-shadow: 0px 3px 7px #0dcaf0 !important;
    }

    .sidebar2 {
        background: radial-gradient(ellipse farthest-corner at right bottom, #14130e 0%, #12100a 8%, #0c0b08 30%, #0f0d09 40%, transparent 80%),
            radial-gradient(ellipse farthest-corner at left top, #110b0b 0%, #11110b 8%, #100e0a 25%, #1a1813 62.5%, #14110b 100%);
        box-shadow: 0px 3px 7px #0dcaf0 !important;
    }

    .custom {
        background-color: rgb(237, 240, 242);
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
        /* box-shadow: 0 10px 0 0 #bcb9b9; */
        padding-left: 15px;
        margin-left: 1px;

    }

    .custom5 {

        color: white;
        font-weight: bold;
        font-size: 15px;
        padding-left: 15px;
        margin-left: 1px;

    }


    .nav-main-link1 {
        position: relative;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding: 0.5rem 1.25rem;
        min-height: 2.5rem;
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: #343a40;
    }


    .nav-main-link-name {
        font-size: 125%;
        line-height: 2em;
    }
    .your-element {
    box-shadow: 0px 3px 7px #0dcaf0 !important;
    background: linear-gradient(#000, #06375A);
    }
</style>
<!-- Sidebar -->
<nav id="sidebar" class="sidebar1 your-element" aria-label="Main Navigation">
    <!-- Side Header -->
    <div class="content-header " >
        <!-- Logo -->
        <a class="" href="">
        
            
        </a>
        <!-- END Logo -->
    </div>
    <!-- END Side Header -->

    <!-- Sidebar Scrolling -->
    <div class="js-sidebar-scroll sidebarbg ">
        <!-- Side Navigation -->
        <div class="content-side">
            <ul class="nav-main">
                
                <li class="nav-main-item pl-2 pb-2 pt-2">
                    <a class="nav-main-link1 {{ Request::routeIs('users*') ? 'custom' : '' }} "
                        href="{{ route('users.index') }}">
                        <i
                            class="nav-main-link-icon fa fa-user-circle fa-2x  {{ Request::routeIs('user*') ? 'text-black' : 'text-white' }}"></i>
                        <span
                            class="{{ Request::routeIs('users*') ? 'text-black' : 'text-white' }} pl-2 ">Users</span>
                    </a>
                </li>
                
                
                


                
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->

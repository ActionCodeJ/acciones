<style>
ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.notification-drop {
  font-family: 'Ubuntu', sans-serif;
  color: #444;
}
.notification-drop.item {
  padding: 10px;
  font-size: 18px;
  position: relative;
  border-bottom: 1px solid #ddd;
}
.notification-drop.item:hover {
  cursor: pointer;
}
.notification-drop.item i {
  margin-left: 10px;
}
.notification-drop.item ul {
  display: none;
  position: absolute;
  top: 100%;
  background: #fff;
  left: -200px;
  right: 0;
  z-index: 1;
  border-top: 1px solid #ddd;
}
.notification-drop.item ul li {
  font-size: 16px;
  padding: 15px 0 15px 25px;
}
.notification-drop.item ul li:hover {
  background: #ddd;
  color: rgba(0, 0, 0, 0.8);
}

@media screen and (min-width: 500px) {
  .notification-drop {
    display: flex;
    justify-content: flex-end;
  }
  .notification-drop.item {
    border: none;
  }
}



.notification-bell{
  font-size: 20px;
}

.btn__badge {
  background: #FF5D5D;
  color: white;
  font-size: 12px;
  position: absolute;
  top: 0;
  right: 0px;
  padding:  3px 10px;
  border-radius: 50%;
}

.pulse-button {
  box-shadow: 0 0 0 0 rgba(255, 0, 0, 0.5);
  -webkit-animation: pulse 1.5s infinite;
}

.pulse-button:hover {
  -webkit-animation: none;
}

@-webkit-keyframes pulse {
  0% {
    -moz-transform: scale(0.9);
    -ms-transform: scale(0.9);
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }
  70% {
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1);
    box-shadow: 0 0 0 50px rgba(255, 0, 0, 0);
  }
  100% {
    -moz-transform: scale(0.9);
    -ms-transform: scale(0.9);
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
    box-shadow: 0 0 0 0 rgba(255, 0, 0, 0);
  }
}

.notification-text{
  font-size: 14px;
  font-weight: bold;
}

.notification-text span{
  float: right;
}

</style>

 <script>
$(document).ready(function () {
  $(".notification-drop.item").on('click',function() {
      $(this).find('ul').toggle();
    });
        });

      </script>
<!-- Navbar visibility: hidden;  -->
  <nav    class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="{{route('home')}}" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
	<!-- marco farfan 3888-15568587 - licenciadomarcofarfan@gmail.com -->
<!-- Site Logo Here -->
<a  style="visibility: hidden;" class="navbar-brand" href="#">Bootstrap Navbar</a>
<!-- Mobile Toggle Button -->
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMobileToggle" aria-controls="navbarMobileToggle" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div style="visibility: hidden;" class="collapse navbar-collapse" id="navbarMobileToggle">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="Submenu-Dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Services
            </a>
            <ul class="dropdown-menu rounded-3" aria-labelledby="Submenu-Dropdown">
                <li><a class="dropdown-item" href="#">Services One</a></li>
                <li><a class="dropdown-item" href="#">Services Two</a></li>
                <li><a class="dropdown-item" href="#">Services Three</a></li>
                <li><a class="dropdown-item" href="#">Services Four</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Portfolio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
        </li>
    </ul>

    <!-- Right Side -->
    <div class="btn-group float-end">
        <a href="#" class="dropdown-toggle text-decoration-none text-light" data-bs-toggle="dropdown">
        <i class="bi bi-person-circle"></i>
        <span>Gurdeep Singh</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a href="#" class="dropdown-item"><i class="bi bi-lock-fill"></i> Change Password</a></li>
            <li><a href="#" class="dropdown-item"><i class="bi bi-gear-fill"></i> Admin Setion</a></li>
            <li><a href="#" class="dropdown-item"><i class="bi bi-gear-wide-connected"></i> IMAP Settings</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a href="#" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Sign out</a></li>
        </ul>
    </div>


    <div class="dropdown">
      <a class="me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
      role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-bell"></i>
          <span class="badge rounded-pill badge-notification bg-danger">1</span>
      </a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li>
              <a class="dropdown-item" href="#">Some news</a>
          </li>
          <li>
              <a class="dropdown-item" href="#">Another news</a>
          </li>
          <li>
              <a class="dropdown-item" href="#">Something else here</a>
          </li>
      </ul>
  </div>
</div>
    <!-- SEARCH FORM -->
    {{--
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->
      
         </ul>
         <ul class="notification-drop">
          <li  style="visibility: hidden;" class="item">
           
            <i class="fa fa-bell-o notification-bell" aria-hidden="true"></i> <span class="btn__badge pulse-button ">
              
             
         
             <a href="{{ route('cart.store') }}" >
              4
            </a>
          </span>     
           
        </ul>
    
  </nav>
  <!-- /.navbar -->

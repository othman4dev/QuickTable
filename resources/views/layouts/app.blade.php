<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/responsive2.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="{{asset('assets/LOGO.svg')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.tiny.cloud/1/w5o6851coln6uxz4eqge6bq0qi2ez0n5zwyprq67sybzjlf9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>QuickTable | Reserve  It Now</title>
</head>
<body>
    <header class="index-header">
        <h1 class="login-h1">Quick<img src="assets/table.svg" class="table-icon" alt="">able</h1>
        <div class="search-bar">
            <input type="text" class="search" onkeyup="searchAjax(this)" placeholder="Search for events">
            <button class="search-btn"><i class="bi bi-search"></i></button>
            <div class="search-results" id="search-results">
                <div class="search-loading">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
        
        @if (session('user'))
        <div class="account" id="account-bar" onclick="dropdown(this)">
            <i class="bi bi-person-down" id="arrow" style="font-size: 30px;"></i>
            <span>{{session('user')->firstname}} {{session('user')->lastname}}</span>
        </div>
        @else
        <div class="logins">
            <a href="/login?login"><button class="log">Login</button></a>
            <a href="/login?register"><button class="log">Register</button></a>
        </div>
        @endif
        <div class="account-drop" id="accountDrop">
            <div class="x-btn" onclick="dropdown(this)">
                <i class="bi bi-x-lg"></i>
            </div>
            <div class="drop-option" onclick="window.location.href = '/profile'">
                <i class="bi bi-person" style="font-size: 20px;"></i>
                <span>Profile</span>
            </div>
            <div class="drop-option" onclick="window.location.href = '/settings'">
                <i class="bi bi-gear" style="font-size: 20px;"></i>
                <span>Settings</span>
            </div>
            <div class="drop-option" onclick="window.location.href='/logout'">
                <i class="bi bi-box-arrow-right" style="font-size: 20px;"></i>
                <span>Logout</span>
            </div>
        </div>
    </header>
    <div class="mobile-bar-container">
        <div class="mobile-bar">
            <div class="menu-mobile-btn">
                <i class="bi bi-list"></i>
            </div>
            <div class="mobile-option" onclick="window.location.href = '/'">
                <i class="bi bi-house" style="font-size: 17px;"></i>
                <span>Home</span>
            </div>
            <div class="mobile-option" onclick="window.location.href = '/posts'">
                <i class="bi bi-shop-window" style="font-size: 17px;"></i>
                <span>Posts</span>
            </div>
            <div class="mobile-option" onclick="window.location.href = '/myReservations'">
                <i class="bi bi-ticket-detailed" style="font-size: 17px"></i>
                <span>My Tickets</span>
            </div>
            <div class="mobile-option">
                <i class="bi bi-info-circle" style="font-size: 17px;" onclick="window.location.href='/help'"></i>
                <span>Help</span>
            </div>
            <div class="mobile-option">
                <i class="bi bi-gear" style="font-size: 17px;" onclick="window.location.href='/settings'"></i>
                <span>Settings</span>
            </div>
        </div>
    </div>
    <main class="index-main">
        <section class="side-bar" id="all-side">
            <div class="menu-btn" onclick="shrinkSide(this)">
                <i class="bi bi-list"></i>
            </div>
            <div class="main-side" id="main-side">
                <div class="side-option" onclick="window.location.href = '/'">
                    <i class="bi bi-house" style="font-size: 20px;"></i>
                    <span>Home</span>
                </div>
                <div class="side-option" onclick="window.location.href = '/posts'">
                    <i class="bi bi-shop-window" style="font-size: 20px;"></i>
                    <span>Posts</span>
                </div>
                <div class="side-option" onclick="window.location.href = '/myReservations'">
                    <i class="bi bi-ticket-detailed" style="font-size: 20px"></i>
                    <span>My Tickets</span>
                </div>
                <div class="side-option">
                    <i class="bi bi-info-circle" style="font-size: 20px;" onclick="window.location.href='/help'"></i>
                    <span>Help</span>
                </div>
                <div class="side-option">
                    <i class="bi bi-gear" style="font-size: 20px;" onclick="window.location.href='/settings'"></i>
                    <span>Settings</span>
                </div>
            </div>
        </section>
        @yield('content')
    </main>
    <div class="alert-modal" id="alert" @if ( session('message') )
        style="display: block;"
    @endif>
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modal-title">Error</h2>
                <div class="modal-close" onclick="this.parentNode.parentNode.parentNode.style.display = 'none'">
                    <i class="bi bi-x-lg"></i>
                </div> 
            </div>
            <div class="modal-body">
                <p class="modal-description" id="alert-message">{{ session('message') }}</p>
            </div>
            <div class="modal-footer">
                <button class="modal-buttons" id="reserve-btn" onclick="this.parentNode.parentNode.parentNode.style.display = 'none'">Ok</button>
                <button class="modal-buttons" onclick="this.parentNode.parentNode.parentNode.style.display = 'none'">Cancel</button>
            </div>
        </div>
    </div>
    <div class="image-big-display">
        <div class="image-big-content">
            <div class="image-big-close">
                <div class="icon-wrapper">
                    <i class="bi bi-download" style="cursor: pointer" onclick="downloadImage()"></i>
                </div>
                <div class="icon-wrapper close">
                    <i class="bi bi-x-lg" style="cursor: pointer" onclick="this.parentNode.parentNode.parentNode.parentNode.style.display = 'none'"></i>
                </div>          
            </div>
            <img src="assets/s1.jfif" alt="" class="image-big" id="display-image">
    </div>
    
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script src="js/script.js" defer></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
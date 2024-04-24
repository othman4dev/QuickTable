<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="{{asset('assets/table.svg')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <title>QuickTable | Reserve  It Now</title>
</head>
<body>
    <header class="index-header">
        <h1 class="login-h1">Quick<img src="assets/table.svg" class="table-icon" alt="">able</h1>
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
            <div class="drop-option">
                <i class="bi bi-person" style="font-size: 20px;"></i>
                <span>Profile</span>
            </div>
            <div class="drop-option">
                <i class="bi bi-gear" style="font-size: 20px;"></i>
                <span>Settings</span>
            </div>
            <div class="drop-option" onclick="window.location.href='/logout'">
                <i class="bi bi-box-arrow-right" style="font-size: 20px;"></i>
                <span>Logout</span>
            </div>
        </div>
    </header>
    <div class="mobile-bar">
        
    </div>
    <main class="index-main">
        <section class="side-bar" id="all-side">
            <div class="menu-btn" onclick="shrinkSide(this)">
                <i class="bi bi-list"></i>
            </div>
            <div class="main-side" id="main-side">
                <div class="side-option" onclick="window.location.href='/stats'">
                    <i class="bi bi-bar-chart-line" style="font-size: 25px;"></i>
                    <span>statistics</span>
                </div>
                <div class="side-option" onclick="window.location.href='/users'">
                    <i class="bi bi-person-fill" style="font-size: 25px;"></i>
                    <span>Users</span>
                </div>
                <div class="side-option" onclick="window.location.href='/allposts'">
                    <i class="bi bi-file-post" style="font-size: 25px;"></i>
                    <span>Posts</span>
                </div>
                <div class="side-option" onclick="window.location.href='/business'">
                    <i class="bi bi-briefcase-fill" style="font-size: 25px;"></i>
                    <span>Businesses</span>
                </div>
                <div class="side-option" onclick="window.location.href='/reports'">
                    <i class="bi bi-flag" style="font-size: 25px;"></i>
                    <span>Reports</span>
                </div>
                <div class="side-option" onclick="window.location.href = '/inbox'">
                    <i class="bi bi-chat-square-text" style="font-size: 25px;"></i>
                    <span>Contact</span>
                </div>
                <div class="side-option" onclick="window.location.href='/settings'">
                    <i class="bi bi-gear" style="font-size: 25px;"></i>
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
    </div>
    <div class="protection" id="protection"></div>
</body>
</html>
<script src="{{ asset('js/script.js') }}?v=1.1" defer></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
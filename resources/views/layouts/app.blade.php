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
    <script src="https://cdn.tiny.cloud/1/w5o6851coln6uxz4eqge6bq0qi2ez0n5zwyprq67sybzjlf9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/montserrat" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/responsive2.css') }}">
    <title>QuickTable | Reserve  It Now</title>
</head>
<body>
    <header class="index-header">
        <h1 class="login-h1">Quick<img src="{{ asset('assets/table.svg') }}" class="table-icon" alt="">able</h1>
        <div class="search-bar">
            <input type="text" class="search" onkeyup="searchAjax(this)" placeholder="Search for Restaurants, Coffee Shops...">
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
            <div class="drop-option" onclick="window.location.href = '/'">
                <i class="bi bi-house" style="font-size: 20px;"></i>
                <span>Home</span>
            </div>
            <div class="drop-option" onclick="window.location.href = '/myreservations'">
                <i class="bi bi-ticket-detailed" style="font-size: 20px;"></i>
                <span>Tickets</span>
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
            <div class="mobile-option" onclick="window.location.href = '/restaurants'">
                <i class="bi bi-shop" style="font-size: 17px;"></i>
                <span>Restaurants</span>
            </div>
            <div class="mobile-option" onclick="window.location.href = '/coffeeshops'">
                <i class="bi bi-cup-hot-fill" style="font-size: 17px;"></i>
                <span>Coffee Shops</span>
            </div>
            <div class="mobile-option" onclick="window.location.href = '/posts'">
                <i class="bi bi-postcard" style="font-size: 17px;"></i>
                <span>Posts</span>
            </div>
            <div class="mobile-option" onclick="window.location.href = '/myReservations'">
                <i class="bi bi-ticket-detailed" style="font-size: 17px"></i>
                <span>Reservations</span>
            </div>
            <div class="mobile-option" onclick="window.location.href = '/contact'">
                <i class="bi bi-chat-square-text" style="font-size: 17px;"></i>
                <span>Contact</span>
            </div>
        </div>
    </div>
    <main class="index-main">
        <section class="side-bar" id="all-side">
            <div class="menu-btn" onclick="shrinkSide(this,'0.3s')">
                <i class="bi bi-list"></i>
            </div>
            <div class="main-side" id="main-side">
                <div class="side-option -home" onclick="window.location.href = '/'">
                    <i class="bi bi-house" style="font-size: 25px;"></i>
                    <span>Home</span>
                </div>
                <div class="side-option -restaurants" onclick="window.location.href = '/restaurants'">
                    <i class="bi bi-shop" style="font-size: 25px;"></i>
                    <span>Restaurants</span>
                </div>
                <div class="side-option -coffeeshops" onclick="window.location.href = '/coffeeshops'">
                    <i class="bi bi-cup-hot" style="font-size: 25px;"></i>
                    <span>Coffee Shops</span>
                </div>
                <div class="side-option -posts" onclick="window.location.href = '/posts'">
                    <i class="bi bi-postcard" style="font-size: 25px;"></i>
                    <span>Posts</span>
                </div>
                <div class="side-option -myreservations" onclick="window.location.href = '/myReservations'">
                    <i class="bi bi-ticket-detailed" style="font-size: 25px"></i>
                    <span>Reservations</span>
                </div>
                <div class="side-option -contact" onclick="window.location.href = '/contact'">
                    <i class="bi bi-chat-square-text" style="font-size: 25px;"></i>
                    <span>Contact</span>
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
                <h2 class="modal-title" id="modal-title">Message</h2>
                <div class="modal-close" onclick="this.parentNode.parentNode.parentNode.style.display = 'none'">
                    <i class="bi bi-x-lg"></i>
                </div> 
            </div>
            <div class="modal-body">
                <p class="modal-description" id="alert-message">{{ session('message') }}</p>
            </div>
            <div class="modal-footer">
                <button class="modal-buttons" id="reserve-btn" onclick="this.parentNode.parentNode.parentNode.style.display = 'none'" style="margin-top: 15px">Ok</button>
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
    <section class="reserveModal">
        <div class="modal-header">
            <h2 class="modal-title" id="modal-title">Reserve Ticket</h2>
            <div class="closer" onclick="this.parentNode.parentNode.style.display = 'none';hideProtection()">
                <i class="bi bi-x-lg"></i>
            </div>
        </div>
        <form action="/reserveTable" method="POST"  class="modal-body">
            <div class="reserve-texts">
                <h2  id="business-name">{{ @$business->name }}</h2>
                <p class="business-type">{{ @$business->business_type }}</p>
            </div>
            <label for="places-count" class="labels">Number Of Seats</label>
            <div class="reserve-texts">
                <div class="place-counter">
                    <div class="counter-btn" onclick="placeCounter('minus',{{ @$business->base_price ? : 1 }})">-</div>
                    <input type="number" name="quantity" id="places-count" class="places-count" readonly value="1" required min="1" max="6">
                    <div class="counter-btn" onclick="placeCounter('add',{{ @$business->base_price ? : 1 }})">+</div>
                </div>
                <div class="price-tag">
                    <span id="price-tag">Price: <span id="price-price">{{ @$business->base_price ? : 1 }}</span> $</span>
                    <label class="labels">{{ @$business->base_price ? : 1 }} $ / Seat</label>
                </div>
            </div>
            <input type="hidden" name="business_id" value="{{ @$business->id }}">
        </form>
        <div class="modal-footer" style="padding: 7px">
            <button class="menu-item-btn" onclick="this.parentNode.parentNode.style.display = 'none';hideProtection()">Cancel</button>
            <button class="menu-item-btn" id="reserve-btn" onclick="reserveTable()">Reserve</button>
        </div>
    </section>
    <div class="protection" id="protection"></div>
    <form class="menu-item-modal" method="POST" action="/checkout" style="font-family: 'Reem Kufi', sans-serif !important;">
        @csrf
        <div class="menu-item-header">
            <div class="closer" onclick="this.parentNode.parentNode.style.display = 'none';hideProtection()">                
                <i class="bi bi-x-lg"></i>
            </div>
        </div>
        <div class="menu-item-body">
            <div class="menu-item-image" id="menu-image">

            </div>
            <input type="text" class="hidden" id="inp-id" name="id">
            <input type="text" class="hidden" id="inp-price" name="price">
            <div class="menu-item-texts">
                <h2 class="menu-item-title" id="item-name">Title</h2>
                <p class="menu-item-description" id="item-desc">Description</p>
                <div class="place-counter" style="padding: 15px">
                    <div class="counter-btn" onclick="placeCounterBuy('minus')">-</div>
                    <input type="number" name="quantity" id="places-count2" class="places-count" readonly value="1" required min="1" max="6">
                    <div class="counter-btn" onclick="placeCounterBuy('add')">+</div>
                </div>
            </div>
            
            <div class="menu-item-price">
                <h2 class="menu-item-price-value" id="item-price"><span id="price-price2">15</span>$</h2>
            </div>
        </div>
        <div class="menu-item-footer">
            <button class="menu-item-btn">Cancel</button>
            <button class="menu-item-btn">Buy</button>
        </div>
    </form>
</body>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script src="{{ asset('js/script.js') }}?v=1.2" defer></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="{{asset('assets/LOGO.svg')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.tiny.cloud/1/w5o6851coln6uxz4eqge6bq0qi2ez0n5zwyprq67sybzjlf9/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://fonts.cdnfonts.com/css/reem-kufi" rel="stylesheet">
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
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
            <div class="drop-option" onclick="window.location.href = '/add'">
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
    <main class="index-main">
        <section class="side-bar" id="all-side">
            <div class="menu-btn" onclick="shrinkSide(this)">
                <i class="bi bi-list"></i>
            </div>
            <div class="main-side" id="main-side">
                <div class="side-option" onclick="window.location.href = '/myposts'">
                    <i class="bi bi-shop-window" style="font-size: 25px;"></i>
                    <span>My Posts</span>
                </div>
                <div class="side-option" onclick="window.location.href = '/money'">
                    <i class="bi bi-cash-coin" style="font-size: 25px"></i>
                    <span>Money</span>
                </div>
                <div class="side-option" onclick="window.location.href = '/reservations'">
                    <i class="bi bi-person-fill-lock" style="font-size: 25px"></i>
                    <span>Reservations</span>
                </div>
                <div class="side-option">
                    <i class="bi bi bi-toggles" style="font-size: 25px;"></i>
                    <span>Switch To User</span>
                </div>
                <div class="side-option" onclick="window.location.href = '/profile'">
                    <i class="bi bi-person" style="font-size: 25px;"></i>
                    <span>Profile</span>
                </div>
                <div class="side-option" onclick="window.location.href = '/settings'">
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
                <p class="event-description" id="event-details"></p>
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
    <div class="menu-item-modal" style="font-family: 'Reem Kufi', sans-serif !important;">
        <div class="menu-item-header" style="justify-content: space-between">
            <p style="font-size: 20px">Edit Menu Item</p>
            <div class="closer" onclick="this.parentNode.parentNode.style.display = 'none';hideProtection()">                
                <i class="bi bi-x-lg"></i>
            </div>
        </div>
        <form action="/editMenuItem" class="menu-item-body" method="POST">
            @csrf
            <div class="menu-item-image" id="menu-image">

            </div>
            <div class="menu-item-texts">
                <input type="text" style="display: none" name="id" value="" id="menu-id">
                <label for="item-name" class="labels"></label>
                <input type="text" name="name" class="menu-item-inp" value="" required id="item-name">
                <label for="item-desc" class="labels"></label>
                <textarea name="desc" class="aria-edit" cols="30" rows="10" required id="item-desc"></textarea>
            </div>
            <div class="menu-item-price">
                <input type="number" name="price" class="menu-item-price-inp" value="" required id="item-price"> $
            </div>
        </form>
        <div class="menu-item-footer">
            <button class="menu-item-btn" onclick="this.parentNode.style.display = 'none';hideProtection()">Cancel</button>
            <button class="menu-item-btn" id="deleteBTN">Delete</button>
            <button class="menu-item-btn" onclick="this.parentNode.previousElementSibling.submit()">Save</button>
        </div>
    </div>
    <div class="banner-modal" style="font-family: 'Reem Kufi', sans-serif !important;">
        <div class="menu-item-header" style="justify-content: space-between">
            <p style="font-size: 20px">Edit Banner</p>
            <div class="closer" onclick="showBannerModal()" style="margin: 0">                
                <i class="bi bi-x-lg"></i>
            </div>
        </div>
        <div class="banner-body">
            <form action="/uploadBanner" enctype="multipart/form-data" method="post">
                @csrf
                <img src="{{ session('business')->background_image }}" class="preview-banner" id="previewBanner" alt="">
                <label for="banner">
                    Uplaod New Banner
                </label>
                <input type="file" name="banner" id="banner" class="banner-input" accept=".png , .jpeg , .jpg">
                <p class="errorResponse" id="banner-error"></p>
            </form>
        </div>
        <div class="menu-item-footer">
            <button class="menu-item-btn" onclick="showBannerModal()">Cancel</button>
            <button class="menu-item-btn" id="crop">Save</button>
            
        </div>
    </div>
    <div class="info-modal">
        <div class="menu-item-header" style="justify-content: space-between">
            <p style="font-size: 20px">Edit Info</p>
            <div class="closer" onclick="showInfoModal()">
                <i class="bi bi-x-lg"></i>
            </div>
        </div>
        <form onsubmit="return false;" class="info-body" action="/editInfo" method="post" enctype="multipart/form-data" id="info-form">
            <div class="info-col">
                <img src="{{ session('user')->pp }}" class="info-image" alt="" id="pp-preview">
                <label for="pp-input" class="info-btn">Upload Picture</label>
            </div>
            <div class="info-col">
                <input type="file" name="pp" id="pp-input" style="display: none" onchange="setPreview(this)">
                <div class="info-texts">
                    <div class="flex-inps">
                        <label for="edit-fullname" class="labels">Owner fisrtname
                            <input type="text" name="firstname" value="{{ session('user')->firstname }}" class="menu-item-inp">
                        </label>
                        <label for="edit-fullname" class="labels">Owner lastname
                            <input type="text" name="lastname" value="{{ session('user')->lastname }}" class="menu-item-inp">
                        </label>
                    </div>
                    <label for="edit-name" class="labels">Business Name</label>
                    <input type="text" id="edit-name" value="{{ session('business')->name }}" name="name" class="menu-item-inp">
                    <label for="edit-desc" class="labels">Description</label>
                    <textarea id="edit-desc" name="description" cols="30" rows="10" class="aria-edit">{{ session('business')->description }}</textarea>
                    <label class="labels">Business Type</label>
                    <p class="type">{{ session('business')->business_type }}</p>
                    <select name="business_type" class="business-type" style="z-index:10000">
                        <option default selected>Choose Business Type</option>
                        <option value="Restaurant" @if (session('business')->business_type == 'Restaurant') selected @endif>Restaurant</option>
                        <option value="Coffee shop" @if (session('business')->business_type == 'Coffee shop') selected @endif>Coffee Shop</option>
                    </select>
                </div>
            </div>
        </form>
        <p class="errorResponse" id="info-error"></p>
        <div class="info-btns">
            <button class="menu-item-btn" id="save" onclick="sendFormWithAjax(document.getElementById('info-form'))">Save</button>
        </div>
    </div>
    <div class="protection" id="protection"></div>
    <form class="sliders-modal" enctype="multipart/form-data" action="/saveSliders" style="display: none;z-index:3" method="POST" onsubmit="return false;">
        @csrf
        <div class="menu-item-header" style="justify-content: space-between">
            <p style="font-size: 20px">Edit Sliders</p>
            <div class="closer" onclick="this.parentNode.parentNode.style.display = 'none';hideProtection()">
                <i class="bi bi-x-lg"></i>
            </div>
        </div>
        <p class="swiper-title">
            <label for="swipper-title" class="labels">Slider title</label>
            <input type="text" name="swipper_title1" class="swipper-title" id="swipper-title" required value="{{ session('slider1_title') }}">
        </p>
        <div class="swiper1">
            <div class="swiper-img-container">
                <img src="{{ session('slider1')[0] }}" id="swiper1-image1" class="swiper-edit-img" alt="" title="slide 1">
                <div class="controls">
                    <label for="swiper1-slide1" class="swipper-btn">Change</label>
                    <input type="file" name="swiper1_slide1" class="hidden-file" style="display: none" id="swiper1-slide1" onchange="previewSlide(1,1)">
                    <button class="swipper-btn" onclick="deleteSlide(1,1)">Delete</button>
                </div>
            </div>
            <div class="swiper-img-container">
                <img src="{{ session('slider1')[1] }}" id="swiper1-image2" class="swiper-edit-img" alt="" title="slide 2">
                <div class="controls">
                    <label for="swiper1-slide2" class="swipper-btn">Change</label>
                    <input type="file" name="swiper1_slide2" class="hidden-file" style="display: none" id="swiper1-slide2" onchange="previewSlide(1,2)">
                    <button class="swipper-btn" onclick="deleteSlide(1,2)">Delete</button>
                </div>
            </div>
            <div class="swiper-img-container">
                <img src="{{ session('slider1')[2] }}" id="swiper1-image3" class="swiper-edit-img" alt="" title="slide 3">
                <div class="controls">
                    <label for="swiper1-slide3" class="swipper-btn">Change</label>
                    <input type="file" name="swiper1_slide3" style="display: none" id="swiper1-slide3" onchange="previewSlide(1,3)">
                    <button class="swipper-btn" onclick="deleteSlide(1,3)">Delete</button>
                </div>
            </div>
        </div>
        <p class="swiper-title">
            <label for="swipper-title" class="labels">Slider title</label>
            <input type="text" name="swipper_title2" class="swipper-title" id="swipper-title" required value="{{ session('slider2_title') }}"">
        </p>
        <div class="swiper2">
            <div class="swiper-img-container">
                <img src="{{ session('slider2')[0] }}" id="swiper2-image1" class="swiper-edit-img" alt="" title="slide 1">
                <div class="controls">
                    <label for="swiper2-slide1" class="swipper-btn">Change</label>
                    <input type="file" name="swiper2_slide1" class="hidden-file" style="display: none" id="swiper2-slide1" onchange="previewSlide(2,1)">
                    <button class="swipper-btn" onclick="deleteSlide(2,1)">Delete</button>
                </div>
            </div>
            <div class="swiper-img-container">
                <img src="{{ session('slider2')[1] }}" id="swiper2-image2" class="swiper-edit-img" alt="" title="slide 1">
                <div class="controls">
                    <label for="swiper2-slide2" class="swipper-btn">Change</label>
                    <input type="file" name="swiper2_slide2" class="hidden-file" style="display: none" id="swiper2-slide2" onchange="previewSlide(2,2)">
                    <button class="swipper-btn" onclick="deleteSlide(2,2)">Delete</button>
                </div>
            </div>
            <div class="swiper-img-container">
                <img src="{{ session('slider2')[2] }}" id="swiper2-image3" class="swiper-edit-img" alt="" title="slide 1">
                <div class="controls">
                    <label for="swiper2-slide3" class="swipper-btn">Change</label>
                    <input type="file" name="swiper2_slide3" class="hidden-file" style="display: none" id="swiper2-slide3" onchange="previewSlide(2,3)">
                    <button class="swipper-btn" onclick="deleteSlide(2,3)">Delete</button>
                </div>
            </div>
        </div>
        <div class="controls">
            <button class="menu-item-btn" onclick="this.parentNode.parentNode.submit()">Save</button>
        </div>
    </form>
    <section id="editMenu" class="edit-menu" style="display: none">
        <div class="menu-item-header" style="justify-content: space-between">
            <p style="font-size: 20px">Edit Menu</p>
            <div class="closer" onclick="this.parentNode.parentNode.style.display = 'none';hideProtection()">
                <i class="bi bi-x-lg"></i>
            </div>
        </div>
        <div class="menu-body">
            <form action="/editMenu" method="POST" style="min-height: 120px">
                @csrf
                @foreach (session('menu') as $index => $item)
                    <div class="item-wrapper">
                        <p style="font-size: 16px">Item {{ $index + 1 }}</p>
                        <label for="item{{ $index + 1 }}" class="labels">Name & Price</label>
                        <div class="item-container">
                            <input type="text" class="menu-item-inp hack" name="item_{{ $index + 1 }}" id="item{{ $index + 1 }}" required placeholder="Item Name" value="{{ $item->name }}">
                            <input type="number" class="menu-item-price-inp" name="price_{{ $index + 1 }}" id="price{{ $index + 1 }}" required placeholder="Item Price" value="{{ $item->price }}">
                            <input type="text" class="menu-item-price-inp" name="price_{{ $index + 1 }}" id="price{{ $index + 1 }}" required placeholder="Item Price Currency" value="$" readonly style="width: 35px">
                        </div>
                        <label for="description_{{ $index + 1 }}" class="labels">Description</label>
                        <textarea cols="30" rows="10" class="aria-edit" name="description_{{ $index + 1 }}" id="description{{ $index + 1 }}">{{ $item->description }}</textarea>
                        <input type="file" name="image{{$index}}" id="image{{$index}}">
                    </div>
                @endforeach
                <span id="inserter"></span>
                <span id="menu-error" class="labels" style="color: red"></span>
            </form>
            <div class="controls" style="padding-top: 15px">
                <button onclick="if (this.parentNode.previousElementSibling.checkValidity()) {this.parentNode.previousElementSibling.submit()} else {this.parentNode.previousElementSibling.reportValidity();}" class="menu-item-btn">Save</button>
                <button onclick="addMenuItem()" class="menu-item-btn">Add Item <i class="bi bi-plus"></i></button>
            </div>
        </div>
    </section>
    <div class="menu-add-modal" id="addMenu" style="font-family: 'Reem Kufi', sans-serif !important;">
        <div class="menu-item-header" style="justify-content: space-between">
            <p style="font-size: 20px">Add Menu Item</p>
            <div class="closer" onclick="this.parentNode.parentNode.style.display = 'none';hideProtection()">                
                <i class="bi bi-x-lg"></i>
            </div>
        </div>
        <form action="/addMenuItem" class="menu-item-body" method="POST">
            @csrf
            <div class="menu-item-image" id="menu-image">

            </div>
            <div class="menu-item-texts">
                <label for="item-name" class="labels"></label>
                <input type="text" name="name" class="menu-item-inp" value="" required id="item-name" placeholder="Item's name">
                <label for="item-desc" class="labels"></label>
                <textarea name="desc" class="aria-edit" cols="30" rows="10" required id="item-desc" placeholder="Item's description"></textarea>
            </div>
            <div class="menu-item-price">
                <input type="number" name="price" class="menu-item-price-inp" value="" required id="item-price" placeholder="Price"> $
            </div>
        </form>
        <div class="menu-item-footer">
            <button class="menu-item-btn" onclick="this.parentNode.style.display = 'none';hideProtection()">Cancel</button>
            <button class="menu-item-btn" id="deleteBTN">Delete</button>
            <button class="menu-item-btn" onclick="this.parentNode.previousElementSibling.submit()">Save</button>
        </div>
    </div>
</body>
</html>
<script src="js/script.js" defer></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
    var image = document.getElementById('previewBanner');
    var inputImage = document.getElementById('banner');
    var cropper;

    inputImage.onchange = function() {
      image.style.display = 'block';
      var file = this.files[0];
      var reader = new FileReader();

      reader.onload = function(e) {
        image.src = e.target.result;

        // Destroy the old cropper instance
        if (cropper !== undefined) {
          cropper.destroy();
        }

        // Create a new cropper instance
        cropper = new Cropper(image, {
          aspectRatio:  16 / 7,
          background: false,
          viewMode: 1,
          autoCropArea: 1,
        });
      };

      reader.readAsDataURL(file);
    };
    let image2 = document.getElementById('pp-preview');
    document.getElementById('pp-input').onchange = function() {
      var file = this.files[0];
      var reader = new FileReader();

      reader.onload = function(e) {
        image2.src = e.target.result;

        // Destroy the old cropper instance
        if (cropper !== undefined) {
          cropper.destroy();
        }

        // Create a new cropper instance
        cropper = new Cropper(image2, {
            aspectRatio: 1,
            viewMode: 1,
            autoCropArea: 1,
            background: false,
        });
      };

      reader.readAsDataURL(file);
    };
    document.getElementById('crop').addEventListener('click', function() {
    if (inputImage.files.length == 0) {
        document.getElementById('banner-error').innerText = 'Please select an image';
    } else {
        document.getElementById('crop').innerHTML = '<div class="loader2"></div>';
    var croppedImageDataURL = cropper.getCroppedCanvas().toDataURL('image/png'); 
    
    var byteString = atob(croppedImageDataURL.split(',')[1]);
    var mimeString = croppedImageDataURL.split(',')[0].split(':')[1].split(';')[0]
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++) {
      ia[i] = byteString.charCodeAt(i);
    }
    var blob = new Blob([ab], {type: mimeString});
    for (var i = 0; i < byteString.length; i++) {
      ia[i] = byteString.charCodeAt(i);
    }
    var blob = new Blob([ab], {type: mimeString});

    // Check the size of the blob
    if (blob.size > 2 * 1024 * 1024) {
      console.log('Error: Image size exceeds 2MB');
      document.getElementById('banner-error').innerText = 'Image must size less then 2MB.(You can zoom the image to reduce size)';
      document.getElementById('crop').innerText = 'Save';
      return;
    }
    var formData = new FormData();
    formData.append('image', blob, 'image.png');
    formData.append('_token', '{{ csrf_token() }}'); // Add this line

    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/saveBanner', true);

    xhr.onload = function () {
      if (this.status == 200) {
        document.getElementById('banner-error').innerText = this.responseText;
        document.getElementById('banner-error').style.color = 'green';
        document.getElementById('crop').innerHTML = 'Reload Page';
        document.getElementById('crop').addEventListener('click', function() {
          location.reload();
        });
      } else {
        document.getElementById('banner-error').innerText = 'Failed to upload image, verify the size of the image and try again.';
        document.getElementById('crop').innerText = 'Save';
      }
    };

    xhr.onerror = function () {
      document.getElementById('banner-error').innerText = 'An error occurred during the upload';
    };

    xhr.send(formData);
    }
});
function sendFormWithAjax(form) {
    if (document.getElementById('pp-input').files.length == 0) {
        let formData = new FormData(form);
        formData.append('_token', '{{ csrf_token() }}');
        let xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.onload = function () {
            if (this.status == 200) {
                document.getElementById('info-error').innerText = this.responseText;
                document.getElementById('info-error').style.color = 'green';
                document.getElementById('save').innerHTML = 'Reload Page';
                document.getElementById('save').addEventListener('click', function() {
                    location.reload();
                });
            } else {
                document.getElementById('info-error').innerText = this.responseText;
            }
        };
        xhr.send(formData);
    } else {
        document.getElementById('save').innerHTML = '<div class="loader2"></div>';
    var croppedImageDataURL = cropper.getCroppedCanvas().toDataURL('image/png'); 
    
    var byteString = atob(croppedImageDataURL.split(',')[1]);
    var mimeString = croppedImageDataURL.split(',')[0].split(':')[1].split(';')[0]
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++) {
      ia[i] = byteString.charCodeAt(i);
    }
    var blob = new Blob([ab], {type: mimeString});

    }
    if (blob.size > 2 * 1024 * 1024) {
      console.log('Error: Image size exceeds 2MB');
      document.getElementById('info-error').innerText = 'Image must size less then 2MB.(You can zoom the image to reduce size)';
      document.getElementById('crop').innerText = 'Save';
      return;
    }
    let formData = new FormData(form);
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('image', blob, 'image.png');
    let xhr = new XMLHttpRequest();
    xhr.open('POST', form.action, true);
    xhr.onload = function () {
        if (this.status == 200) {
            document.getElementById('info-error').innerText = this.responseText;
            document.getElementById('info-error').style.color = 'green';
            document.getElementById('save').innerHTML = 'Reload Page';
            document.getElementById('save').addEventListener('click', function() {
                location.reload();
            });
        } else {
            document.getElementById('info-error').innerText = this.responseText;
        }
    };
    xhr.send(formData);
}
</script>
<script>
    AOS.init();
</script>
<script>
    $('.business-type').select2({
        placeholder: 'Select an option'
    });
</script>
@extends('layouts.guest')
@section('content')
<section class="login-main">
    <main class="flip-card">
        <div class="logins-wrapper flip-card-inner">
            <div class="login-container flip-card-front" id="login">
                <div class="top-login">
                    <h1 class="login-h1" style="color: #fff">Quick<img src="assets/table.svg" class="table-icon" alt="">able</h1>
                </div>
                <h2 class="login-title">Login</h2>
                <form action="/log" onsubmit="return false;" method="post" class="login-form" id="login-form">
                    @csrf
                    <div class="input-container">
                        <label for="email" class="input-label">Email</label>
                        <input type="email" name="email" id="email1" class="input-field" required @if (session('failed_email'))
                            value="{{session('failed_email')}}"
                        @endif>
                    </div>
                    <div class="input-container">
                        <label for="password" class="input-label">Password</label>
                        <input type="password" name="password" id="password" class="input-field" required>
                    </div>
                    <a href="/forgot" class="forgot"><p class="error">{{ session('message') }}</p> Forgot password ?</a>
                    <div class="login-btns">
                        <button type="submit" class="login-button" onclick="validation('login')">Login</button>
                    </div>
                    <a class="forgot" onclick="switchLogin()">Don't have an account ? Register </a>
                </form>
            </div>
            <div class="register-container flip-card-back" id="register">
                <div class="top-login">
                    <h1 class="login-h1" style="color: #fff">Quick<img src="assets/table.svg" class="table-icon" alt="">able</h1>
                </div>
                <h2 class="login-title">Register</h2>
                <form action="register" onsubmit="return false;" method="post" class="register-form" id="register-form">
                    @csrf
                    <div class="passwords">
                        <div class="input-container">
                            <label for="first" class="input-label">First Name</label>
                            <input type="text" name="firstname" id="first" class="input-field" required>
                        </div>
                        <div class="input-container">
                            <label for="last" class="input-label">Last Name</label>
                            <input type="text" name="lastname" id="last" class="input-field" required>
                        </div>
                    </div>
                    <div class="input-container">
                        <label for="email" class="input-label">Email <p id="email-error"></p></label>
                        <input type="email" name="email" id="email2" class="input-field" required oninput="checkEmailAjax(this)">
                    </div>
                    <div class="passwords">
                        <div class="input-container">
                            <label for="pass1" class="input-label">Password</label>
                            <input type="password" name="pass1" id="pass1" class="input-field" required>
                        </div>
                        <div class="input-container">
                            <label for="pass2" class="input-label">Confirm password</label>
                            <input type="password" name="pass2" id="pass2" class="input-field" required>
                        </div>
                    </div>
                    <a class="forgot"><p class="error">{{ session('message2') }}</p></a>
                    <div class="login-btns">
                        <button type="submit" class="login-button" onclick="validation('register')" id="login-submit">Register</button>
                    </div>
                    <a class="forgot" onclick="switchLogin()">Already have an account ? Login </a>
                </form>
            </div>
        </div>
    </main>
    <div class="next-text">
        <h1 class="login-fixed">Quick<img src="assets/table.svg" class="table-icon" style="filter: invert(1);height:100px" alt="">able</h1>
        <h1 id="login-animation"></h1>
    </div>
</section>
<div class="alert-modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Title</h2>
            <div class="modal-close" onclick="this.parentNode.parentNode.parentNode.style.display = 'none'">
                <i class="bi bi-x-lg"></i>
            </div> 
        </div>
        <div class="modal-body">
            <p class="modal-description">Description</p>
        </div>
        <div class="modal-footer">
            <button class="modal-buttons">Ok</button>
            <button class="modal-buttons">Cancel</button>
        </div>
    </div>
</div>
@endsection
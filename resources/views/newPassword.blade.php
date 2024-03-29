@extends('layouts.guest')
@section('content')
<section class="login-main">
    <main class="flip-card">
        <div class="logins-wrapper flip-card-inner">
            <div class="login-container flip-card-front" style="height: 450px" id="login">
                <div class="top-login">
                    <h1 class="login-h1" style="color: white;"><img src="assets/LOGO.svg" class="table-icon" alt=""></h1>
                </div>
                <h2 class="login-title">New Password</h2>
                <form action="/changePassword" method="post" class="login-form" id="login-form">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('email') }}">
                    <div class="input-container">
                        <label for="pass1" class="input-label">New Password</label>
                        <input type="text" name="pass1" id="pass1" class="input-field" required>
                    </div>
                    <div class="input-container">
                        <label for="pass2" class="input-label">Confirm Password</label>
                        <input type="text" name="pass2" id="pass2" class="input-field" required>
                    </div>
                    <a href="/login" class="forgot"><p class="error">{{ session('message') }}</p>Log in</a>
                    <div class="login-btns">
                        <button class="login-button" type="submit">Reset Password</button>
                    </div>
                    <a class="forgot" href="/login?login">Log In with a diffrent account</a>
                </form>
            </div>
    </main>
    <div class="next-text">
        <h1 class="login-fixed"><img src="assets/LOGO.svg" style="filter: invert(1);height:100px" alt=""></h1>
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
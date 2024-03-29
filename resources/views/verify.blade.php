@extends('layouts.guest')
@section('content')
<section class="login-main">
    <main class="flip-card">
        <div class="logins-wrapper flip-card-inner">
            <div class="login-container flip-card-front" id="login">
                <div class="top-login">
                    <h1 class="login-h1" style="color: white;"><img src="assets/LOGO.svg" class="table-icon" alt=""></h1>
                </div>
                <h2 class="login-title">Verify Email</h2>
                <form action="/verifyCode" method="post" class="login-form" id="login-form">
                    @csrf
                    <div class="input-container">
                        <label for="email" class="input-label">We sent a verification code to this Email</label>
                        <input type="email" name="email" id="email1" value="{{ session('email') }}" style="font-style:italic" readonly class="input-field" required>
                    </div>
                    <div class="input-container">
                        <label for="password" class="input-label">Code</label>
                        <input type="text" name="code" id="password" class="input-field" required>
                    </div>
                    <a href="" class="forgot"><p class="error">{{ session('message') }}</p>Log Out</a>
                    <div class="login-btns">
                        <button type="submit" class="login-button">Verify</button>
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
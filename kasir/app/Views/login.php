<?php
// Ambil data pengaturan dari database
$db = db_connect();
$pengaturan = $db->table('pengaturan_app')->get()->getRow();
$level = session()->get('level'); // Ambil level user dari session
?>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="position-relative">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-6 mx-4">
      <!-- Login -->
      <div class="card p-7">
        <!-- Logo -->
        <div class="app-brand justify-content-center mt-5">
          <a href="index.html" class="app-brand-link gap-3">
           <div class="app-brand justify-content-center mt-5">
            <a href="<?= base_url() ?>" class="app-brand-link gap-3">
              <img src="<?= base_url(!empty($pengaturan->logo) ? 'uploads/' . esc($pengaturan->logo) : 'assets/img/logo-white.png') ?>" 
              alt="Logo" 
              style="max-height: 50px;"/>
              <span class="app-brand-text demo text-heading fw-semibold">
                <?= esc($pengaturan->judul ?? 'Home') ?>
              </span>
            </a>
          </div>

          <span style="color: #9055fd">
            
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z"
            fill="currentColor" />
            <path
            opacity="0.077704"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z"
            fill="black" />
            <path
            opacity="0.077704"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z"
            fill="black" />
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z"
            fill="currentColor" />
            <path
            opacity="0.077704"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z"
            fill="black" />
            <path
            opacity="0.077704"
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z"
            fill="black" />
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
            fill="currentColor" />
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z"
            fill="white"
            fill-opacity="0.15" />
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
            fill="currentColor" />
            <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z"
            fill="white"
            fill-opacity="0.3" />
          </svg>
        </span>
      </span>
      
    </a>
  </div>
  <!-- /Logo -->

  <div class="card-body mt-1">
   <link rel="shortcut icon" href="<?= base_url(!empty($pengaturan->logo) ? 'uploads/' . esc($pengaturan->logo) : 'assets/img/logo-white.png') ?>" type="image/x-icon">
   <h4 class="mb-1">Welcome to <?= esc($pengaturan->judul ?? 'Home') ?> ! 👋🏻</h4>
   <p class="mb-5">Please sign-in to your account</p>


   <?php if (session()->getFlashdata('error')): ?>
   <p><?= session()->getFlashdata('error') ?></p>
 <?php endif; ?>
 
 <form id="formAuthentication" class="mb-5" action="<?= base_url('home/aksi_login') ?>" method="post">
  <div class="form-floating form-floating-outline mb-5">
    <input
    type="text"
    class="form-control"
    id="username"
    name="username"
    placeholder="Enter your email or username"
    autofocus />
    <label for="username">Email or Username</label>
  </div>
  <div class="mb-5">
    <div class="form-password-toggle">
      <div class="input-group input-group-merge">
        <div class="form-floating form-floating-outline">
          <input
          type="password"
          id="password"
          class="form-control"
          name="password"
          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
          aria-describedby="password" />
          <label for="password">Password</label>
        </div>
        <span class="input-group-text">
          <i id="togglePassword" class="fa fa-eye"></i>
        </span>

      </div>
    </div>
  </div>
  <div class="g-recaptcha" data-sitekey="6LeCA-8qAAAAACtGYDJketIE7D5rtGivxAF05ckN">
  </div>
  <div class="mb-5 pb-2 d-flex justify-content-between pt-2 align-items-center">
    <a href="<?= base_url('home/forgot_password') ?>" class="form-check mb-0">
      <span>Forgot Password?</span>
    </a>
  </div>
  <div class="mb-5">
    <button class="btn btn-primary d-grid w-100" type="submit">login</button>
  </div>
</form>
<!-- 
              <p class="text-center mb-5">
                <span>New on our platform?</span>
                <a href="auth-register-basic.html">
                  <span>Create an account</span>
                </a>
              </p> -->
            </div>
          </div>
          <!-- /Login -->
          <img
          src="<?=base_url('assets/img/illustrations/tree-3.png')?>"
          alt="auth-tree"
          class="authentication-image-object-left d-none d-lg-block" />
          <img
          src="<?=base_url('assets/img/illustrations/auth-basic-mask-light.png')?>"
          class="authentication-image d-none d-lg-block"
          height="172"
          alt="triangle-bg"
          data-app-light-img="illustrations/auth-basic-mask-light.png"
          data-app-dark-img="illustrations/auth-basic-mask-dark.png" />
          <img
          src="<?=base_url('assets/img/illustrations/tree.png')?>"
          alt="auth-tree"
          class="authentication-image-object-right d-none d-lg-block" />
        </div>
      </div>
    </div>

    <script>
        // Toggle visibility for New Password
      document.getElementById("togglePassword").addEventListener("click", function() {
    let passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
        this.classList.remove("fa-eye");
        this.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        this.classList.remove("fa-eye-slash");
        this.classList.add("fa-eye");
    }
});

      </script>

      <script src='https://www.google.com/recaptcha/api.js'></script>
      <script>
        function validateCaptcha() {
          var response = grecaptcha.getResponse();
          if(response.length === 0) {
            alert("Please complete the CAPTCHA before submitting.");
          } else {
            document.getElementById('login-form').submit();
          }
        }
      </script>

      <!-- Core JS -->
      
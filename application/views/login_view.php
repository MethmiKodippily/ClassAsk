<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <link rel="icon" type="image/png" href="/assets/images/logo.png">

        <link rel="stylesheet" href="/assets/css/login-register.css">

        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </head>
    <body>
        <input type="hidden" id="base" value="<?php echo base_url(); ?>">
        <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <header>Login to Your Account </header>
                    <form action="<?php echo base_url('auth/login'); ?>" method="POST">
                        <div class="field input-field">
                            <input name="email" type="email" placeholder="Email" class="input">
                        </div>
                        <small><?php echo $this->session->flashdata('email_error'); ?></small>

                        <div class="field input-field">
                            <input name="password" type="password" placeholder="Password" class="password">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>
                        <small><?php echo $this->session->flashdata('password_error'); ?></small>

                        <div class="form-link">
                            <a href="#" class="forgot-pass">Forgot password?</a>
                        </div>

                        <div class="field button-field">
                            <button type="submit">Login</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Don't have an account? <a href="<?php echo base_url('register'); ?>" class="link signup-link">Signup here</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="#" class="field google">
                        <img src="/assets/images/google.png" alt="" class="google-img">
                        <span>Continue with Google</span>
                    </a>
                </div>

            </div>
        </section>

        <script src="/assets/js/login-register.js"></script>
    </body>
</html>

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
            <div class="form signup">
                <div class="form-content">
                    <header>Signup</header>
                    <form action="<?php echo base_url('auth/register'); ?>" method="POST">
                        <div class="field input-field">
                            <input type="text" name="fname" placeholder="First name" class="input">
                        </div>
                        <small><?php echo $this->session->flashdata('fname_error'); ?></small>

                        <div class="field input-field">
                            <input type="text" name="lname" placeholder="Last name" class="input">
                            <small><?php echo form_error("lname"); ?></small>
                        </div>
                        <small><?php echo $this->session->flashdata('lname_error'); ?></small>

                        <div class="field input-field">
                            <select name="type" class="input">
                                <option value="" disabled selected>Select your role</option>
                                <option value="s">Student</option>
                                <option value="t">Teacher</option>
                            </select>
                        </div>
                        <small><?php echo $this->session->flashdata('type_error'); ?></small>

                        <div class="field input-field">
                            <input type="email" name="email" placeholder="Email" class="input">
                        </div>
                        <small><?php echo $this->session->flashdata('email_error'); ?></small>

                        <div class="field input-field">
                            <input type="password" name="password" placeholder="Password" class="password">
                        </div>
                        <small><?php echo $this->session->flashdata('password_error'); ?></small>

                        <div class="field input-field">
                            <input type="password" name="cpassword" placeholder="Repeat password" class="password">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>
                        <small><?php echo $this->session->flashdata('cpassword_error'); ?></small>

                        <div class="field button-field">
                            <button type="submit">Signup</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="<?php echo base_url('login'); ?>" class="link login-link">Login here</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="#" class="field google">
                        <img src="/assets/images/google.png" alt="" class="google-img">
                        <span>Signup with Google</span>
                    </a>
                </div>

            </div>
        </section>

        <script src="/assets/js/login-register.js"></script>
    </body>
</html>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <link rel="icon" type="image/png" href="/assets/images/logo.png">

        <link rel="stylesheet" type="text/css" href="/assets/css/base.css">

        <?php if ($title === 'Home') : ?>
            <link rel="stylesheet" type="text/css" href="/assets/css/home.css">
        <?php elseif ($title === 'Account') : ?>
            <link rel="stylesheet" type="text/css" href="/assets/css/account.css">
        <?php elseif ($title === 'Question') : ?>
            <link rel="stylesheet" type="text/css" href="/assets/css/question.css">
        <?php endif; ?>

        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.6/underscore-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.6.0/backbone-min.js"></script>
    </head>

    <body>
        <input type="hidden" id="base" value="<?php echo base_url(); ?>">
        <input type="hidden" id="pageName" value="<?php echo $title ?>">

        <nav>
            <div class="logo-name">
                <div class="logo-image">
                    <img src="/assets/images/logo.png" alt="">
                </div>

                <span class="logo_name">ClassAsk</span>
            </div>

            <div class="menu-items">
                <ul class="nav-links">
                    <li><a href="#">
                        <i class="bx bx-home"></i>
                        <span class="link-name">Home</span>
                    </a></li>
                    <li><a href="<?php echo base_url('account'); ?>">
                        <i class="bx bx-user"></i>
                        <span class="link-name">Account</span>
                    </a></li>
                    <li><a href="#">
                        <i class="bx bx-conversation"></i>
                        <span class="link-name">Questions</span>
                    </a></li>
                </ul>
            </div>
        </nav>

        <section class="body-content">
            <div class="top">
                <i class="bx bx-menu sidebar-toggle"></i>

                <div class="auth-box">
                    <button class="top-button signin" >Sign In</button>
                    <button class="top-button register" >Register</button>
                    <button class="top-button logout" >Logout</button>
                </div>
                
            </div>
        
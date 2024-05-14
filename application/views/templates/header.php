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
        <link rel="stylesheet" type="text/css" href="/assets/css/side-panel.css">
        <link rel="stylesheet" type="text/css" href="/assets/css/top-panel.css">

        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.13.6/underscore-min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.6.0/backbone-min.js"></script>
    </head>

    <body>
        <input type="hidden" id="base" value="<?php echo base_url(); ?>">
        
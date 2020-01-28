<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WordPress
* @subpackage Started_Theme
* @since 1.0.0
*/
?>
<!DOCTYPE html>
<html lang="zxx" dir="ltr">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Started Theme</title>
<link rel="shortcut icon" type="image/png" href="https://placehold.co/20x20" >
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Ibarra+Real+Nova&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo get_bloginfo('template_url');?>/assets/front/css/main.css" />
<script src="<?php echo get_bloginfo('template_url');?>/assets/front/js/uikit.js"></script>
</head>

<body>

<header class="uk-header-beackground">
<div data-uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; cls-inactive: uk-navbar-transparent uk-light; top: 600">
<nav class="uk-navbar-container uk-letter-spacing-small">
<div class="uk-container">
<div class="uk-position-z-index" data-uk-navbar>
<div class="uk-navbar-left">
<a class="uk-navbar-item uk-logo uk-text-bold uk-hidden@m" href="#">Started Theme</a>
<ul class="uk-navbar-nav uk-visible@m">
<li><a href="#">Fashion</a></li>
<li><a href="#">Eating</a></li>
<li><a href="#">Exercise</a></li>
<li><a href="#">Mind</a></li>
</ul>
</div>
<div class="uk-navbar-center">
<a class="uk-navbar-item uk-logo uk-text-bold uk-visible@m" href="#">Started Theme</a>
</div>
<div class="uk-navbar-right">
<ul class="uk-navbar-nav uk-visible@m">
<li><a href="#">Travel</a></li>
<li><a href="#">Business</a></li>
<li><a href="#">Sign Up</a></li>
</ul>
<div>
<a class="uk-navbar-toggle" data-uk-search-icon href="#"></a>
<div class="uk-drop uk-border-rounded" data-uk-drop="mode: click; pos: left-center; offset: 0">
<form class="uk-search uk-search-navbar uk-width-1-1">
<input class="uk-search-input uk-text-demi-bold" type="search" placeholder="Search..." autofocus>
</form>
</div>
</div>          
<a class="uk-navbar-toggle uk-hidden@m" href="#offcanvas" data-uk-toggle><span
data-uk-navbar-toggle-icon></span></a>
</div>
</div>
</div>
</nav>
<hr class="uk-margin-remove uk-light">
</div>



</header>
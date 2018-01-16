<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="author" content="Mosaddek" />
    <meta name="keyword" content="slick, flat, dashboard, bootstrap, admin, template, theme, responsive, fluid, retina" />
    <meta name="description" content="" />
    <link rel="shortcut icon" href="javascript:;" type="image/png">

    <title>Stratus</title>

    
    <style>
        
   /*
Template Name: SlickLab
Build with : BS 3 +
Author: Mosaddek Hossain
*/

/************************
    Table of Content
**************************/

/*

1. logo
2. sidebar left
3. sidebar collapsed
4. header section
5. sticky header
6. non sticky header
7. sidebar left widget
8. left notification
9. notification list
10. language switch
11. mail notification
12. yamm css
13. mega-menu
14. right notification
15. body content
16. page heading
17. state overview
18. text color
19. boxed view
20. tools
21. footer content
22. mobile visit
23. monthly page view
24. team member
25. cpu graph
26. sale monitor
27. dashboard v map
28. flot chart
29. code high light style
30. right side bar
31. chat
32. info
33. settings
34. weather widget
35. login page
36. lock
37. 404 page
38. 500 page
39. Checkbox and Radio buttons
40. to do list
41. mail inbox
42. form layout
43. picker
44. Table
45. general
46. toastr
47. font awesome & simple icon
48. slider
49. profile
50. invoice
51. widget
52. Data Table
53. form
54. ion slider
55. nestable
56. timeline
57. summernote
58. form validation
59. form wizard
60. map
61. calendar
62. slick carousel

*/


@import url(//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic);
@import url(//fonts.googleapis.com/css?family=Abel);

@import url('bootstrap.min.css');
@import url('bootstrap-reset.css');
@import url('jquery-ui-1.10.3.css');
@import url('font-awesome.css');
@import url('simple-line-icons.css');
@import url('icomoon-weather.css');
@import url('default-theme.css');


body {
    font-family: 'Source Sans Pro', sans-serif;
    color: #323232;
    line-height: 20px;
    overflow-x: hidden;
    font-size: 14px;
    font-weight: 400;
     -rendering:optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-font-smoothing: antialiased;
    position: relative;
}


input,select,textarea {
    font-family: 'Source Sans Pro', sans-serif;
    color: #767676;
}

a {
    /*color: #91918E;*/
}

a:focus, a:active, a:hover {
    outline: none;
    -webkit-transition:all 0.3s;
    -moz-transition:all 0.3s;
    transition:all 0.3s;
    text-decoration: none;
    color: #7cd8a9;
}

h1,h2,h3,h4,h5 {
    font-family: 'Source Sans Pro', sans-serif;
}

.m-t-0 {
    margin-top: 0;
}
.m-t-10 {
    margin-top: 10px;
}


.m-t-20 {
    margin-top: 20px;
}


.m-t-30 {
    margin-top: 30px;
}


.m-t-40 {
    margin-top: 40px;
}


.m-t-50 {
    margin-top: 50px;
}

.m-b-0 {
    margin-bottom: 0;
}

.m-b-10 {
    margin-bottom: 10px;
}


.m-b-20 {
    margin-bottom: 20px;
}


.m-b-30 {
    margin-bottom: 30px;
}


.m-b-40 {
    margin-bottom: 40px;
}


.m-b-50 {
    margin-bottom: 50px;
}


/*---------------
    logo
---------------*/


.logo {
    height: 60px;
    line-height: 60px;
    position: absolute;
    top: 0;
    left: 0;
    width: 240px;
    z-index: 100;
    padding-left: 20px;
}


.logo a {
    font-size: 22px;
    color: #fff;
    margin: 0;
    text-decoration: none;
    display: inline-block;
    float: none;
}


.logo a i {
    font-size: 24px;
    color: #7cd8a9;
    padding-right: 5px;
}

.logo a .brand-name {
    float: right;
}

.logo a i, .logo a img {
    display: inline;
    vertical-align: middle;
    margin-right: 10px;
}

.icon-logo {
    display: none;
}

.icon-logo a {
    color: #7cd8a9;
}

.icon-logo a:hover {
    color: #fff;
}

.sidebar-collapsed .icon-logo {
    height: 60px;
    padding-top: 5px;
    line-height: 45px;
    display: block !important;
    position: absolute;
    left: -52px;
    width: 52px;
    font-size: 24px;
    text-align: center;
}


/*---------------------
    sidebar left
-----------------------*/

.sidebar-left {
    width: 240px;
    position: absolute;
    top: 50px;
    left: 0;
}

.sticky-sidebar  {
    position: fixed;
    height: 100%;
    overflow-y: auto;
    z-index: 100;
}

.sidebar-collapsed .sticky-sidebar {
    overflow-y: visible;
    position: absolute;
}


.sidebar-scroll {
    padding: 0px;
    max-height: 700px !important;
    overflow-y: scroll !important;
}

.sidebar-left .search-content {
    display: none;
}

.sidebar-left .search-content::after {
    content: '';
    display: block;
    clear: both;
}

.sidebar-left .search-content input {
    padding: 10px;
    width: 90%;
    margin: 20px 10px 20px 12px;
    border-radius: 30px;
    border: none;
}

.sidebar-left .search-content input:focus {
    width: 90%;
}

.noti-arrow {
    margin-right: 15px;
    margin-top: 2px;
    font-weight: normal;
}

.side-navigation {
    margin-bottom: 10px;
    margin-top: 1px;
}

.navigation-title {
    font-size: 11px;
    font-weight: normal;
    margin: 0;
    padding: 10px 20px;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.side-navigation > li > a {
    color: #fff;
    padding:15px 20px;
    border-radius: 0;
}
.side-navigation > li > a span{display: inline-block;width:80%; vertical-align: middle;}
.side-navigation > li > a:hover,
.side-navigation > li > a:active {
    /*background-color: #000;*/
    border-radius: 0;
    -webkit-border-radius: 0;
}

.side-navigation > li.menu-list > a {
    position: relative;
}

.side-navigation > li.nav-active > ul {
    display: block;
}

.side-navigation > li.menu-list > a:after {
    content: "\f105";
    display: inline-block;
    font-family: "FontAwesome";
    padding-right: 20px;
    position: absolute;
    right: 0;
}


.side-navigation > li.nav-active > a:after {
    content: "\f107";
    display: inline-block;
    font-family: "FontAwesome";
    padding-right: 20px;
    position: absolute;
    right: 0;
}


.side-navigation > li.menu-list.active > a:after,
.side-navigation > li.nav-active.active > a:after,
.side-navigation > li.nav-active.active > a:after:hover{
    content: "\f107";
}

.side-navigation li .fa, .side-navigation li .ico {
    font-size: 14px;
    vertical-align: middle;
    margin-right: 10px;
    width: 16px;
    text-align: center;
}

.side-navigation .child-list {
    list-style: none;
    display: none;
    margin:0;
    padding: 0 0 1px 0;
}

.side-navigation .child-list > li > a {
    color: #fff;
    font-size: 13px;
    display: block;
    padding: 10px 5px 10px 50px;
    -moz-transition: all 0.2s ease-out 0s;
    -webkit-transition: all 0.2s ease-out 0s;
    transition: all 0.2s ease-out 0s;
}

.side-navigation .child-list > li > a:hover,
.side-navigation .child-list > li > a:active,
.side-navigation .child-list > li > a:focus {
    text-decoration: none;
    -moz-transition: all 0.2s ease-out 0s;
    -webkit-transition: all 0.2s ease-out 0s;
    transition: all 0.2s ease-out 0s;
}

.side-navigation .child-list > li .fa {
    font-size: 12px;
    opacity: 0.5;
    margin-right: 5px;
    text-align: left;
    width: auto;
    vertical-align: baseline;
}

.side-navigation .child-list > li.active > a {
    color: #7cd8a9;
    /*background-color: rgba(0,0,0,0.2);*/
}

.side-navigation .child-list ul {
    margin-left: 12px;
    border: 0;
}


.side-navigation .menu-list.active ul {
    display: block;
}

.user-nav {
    margin-bottom: 0;
}

.user-nav  > li > a {
    padding: 10px 20px;
}


/*---------------------
    sidebar collapsed
-----------------------*/


.sidebar-collapsed .logo,
.sidebar-collapsed .side-navigation > li.nav-active > a:after,
.sidebar-collapsed .side-navigation > li.menu-list > a:after{
    display: none;
}

.sidebar-collapsed .header-section {
    margin-left: 0px;
}

.sidebar-collapsed .sidebar-left {
    width: 52px;
    top: 52px;
}

.sidebar-collapsed .sidebar-left-info {
    padding: 0;
}

h5.left-nav-title {
    color: #7cd8a9;
    margin-left: 20px;
    text-transform: uppercase;
}

.sidebar-collapsed .side-navigation {
    margin: 0px 0 20px 0;
}

.sidebar-collapsed .side-navigation li a {
    text-align: center;
    padding:15px 10px;
    position: relative;
}

.sidebar-collapsed .side-navigation > li.menu-list > a {
    background-image: none;
}

.sidebar-collapsed .side-navigation li a span {
    position: absolute;
    padding:15px;
    left: 52px;
    top: 0;
    min-width: 175px;
    text-align: left;
    z-index: 1000;
    display: none;
}

.sidebar-collapsed .side-navigation li a span .badge,
.sidebar-collapsed .side-navigation li a span .label {
    display: none !important;
}

.sidebar-collapsed .side-navigation li.active a span {
    -moz-border-radius: 0;
    -webkit-border-radius:0;
    border-radius:0;
}

.sidebar-collapsed .side-navigation ul,
.sidebar-collapsed .side-navigation .menu-list.nav-active ul{
    display: none;
}

.sidebar-collapsed .side-navigation .menu-list.nav-hover ul,
.sidebar-collapsed .side-navigation li.nav-hover a span{
    display: block;
}


.sidebar-collapsed .side-navigation > li.nav-hover > a,
.sidebar-collapsed .side-navigation > li.nav-hover.active > a,
.sidebar-collapsed .side-navigation li.nav-hover.active a span,
.sidebar-collapsed .side-navigation li.nav-hover a span{
    color: #fff;
}


.sidebar-collapsed .side-navigation li.nav-hover ul {
    display: block;
    position: absolute;
    top: 50px;
    left: 52px;
    margin: 0;
    min-width: 175px;
    z-index: 100;
}

.sidebar-collapsed .side-navigation ul a {
    text-align: left;
    padding: 10px 15px;
}


.sidebar-collapsed .side-navigation li a i {
    margin-right: 0;
}

.sidebar-collapsed .body-content {
    margin-left: 52px;
}

.sidebar-collapsed .sidebar-widget,
.sidebar-collapsed .navigation-title{
    display: none;
}


/*---------------------
    header section
-----------------------*/


.header-section {
    background: #fff;
    border-bottom: 1px solid #E8E8E8;
}

.header-section::after {
    clear: both;
    display: block;
    content: '';
}

.toggle-btn {
    width: 55px;
    height: 60px;
    line-height: 30px;
    font-size: 14px;
    padding:15px;
    cursor: pointer;
    float: left;
    text-align: center;
    color: #384246;
    -moz-transition: all 0.2s ease-out 0s;
    -webkit-transition: all 0.2s ease-out 0s;
    transition: all 0.2s ease-out 0s;
}

.toggle-btn:hover,
.notification-menu .dropdown-toggle:hover,
.notification-menu .dropdown-toggle:focus,
.notification-menu .dropdown-toggle:active,
.notification-menu .dropdown-toggle.active,
.notification-menu .open .dropdown-toggle.dropdown-toggle{
    background: #f7f7f7;
    color: #8b8b8b;
}

.search-content input {
    box-shadow: none;
    float: right;
    font-size: 14px;
    height: 30px;
    margin: 15px 10px 0 10px;
    width: 100px;
    border-radius: 30px;
    background: #f3f3f3;
    border: none;
}

.search-content input,
.search-content input:focus {
    -webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
}

.search-content input:focus {
    box-shadow: none;
    border-color: #eff0f4;
    width: 210px;
}


/*---------------------
    sticky header
-----------------------*/


.sticky-header .logo {
    position: fixed;
    top: 0;
    left: 0;
    width: 240px;
    z-index: 100;
}

.sticky-header .sidebar-left {
    top: 60px;
}

.sticky-header .header-section {
    position: fixed;
    top: 0;
    left: 240px;
    width: 100%;
    z-index: 1000;
}

.sticky-header .body-content {
    padding-top: 60px;
}

.sticky-header .right-notification {
    margin-right: 240px;
}

.sticky-header.sidebar-collapsed .header-section {
    left: 52px;
}

.sticky-header.sidebar-collapsed .right-notification {
    margin-right: 52px;
}


/*-----------------------------
    non sticky header
-----------------------------*/

.non-sticky-header .header-section .logo{
    display: none;
}

.non-sticky-header .sidebar-left{
    top: 0px;
}

.non-sticky-header  .side-navigation {
    margin-top: 60px;
}


.non-sticky-header .right-notification {
    margin-right:0px;
}



/*-------------------------
    sidebar left widget
---------------------------*/


.sidebar-widget {
    padding:0 20px;
    margin-bottom: 100px;
}

.sidebar-widget h4 {
    font-size: 11px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.6);
    margin-bottom: 10px;
    padding-top: 10px;
    letter-spacing: 2px;
}

.sidebar-widget p {
    color: rgba(255,255,255,0.5);
    font-size: 12px;
    font-weight: 400;
}

.sidebar-widget ul {
    list-style: none;
}

.sidebar-widget .progress{
    margin-bottom: 20px;
}



/*---------------------------
     left notification
---------------------------*/

.left-notification {
    float: left;
}

.notification-menu {
    list-style: none;
    padding-left: 0px;
}

.notification-menu > li{
    float: left;
    position: relative;
}
@keyframes fadeInUp {
    0% {
        opacity: 0;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0);
    }

    100% {
        opacity: 1;
        -webkit-transform: none;
        transform: none;
    }
}

.fadeInUp {
    -webkit-animation-name: fadeInUp;
    animation-name: fadeInUp;
}

.notification-menu > li.open .dropdown-menu{
    -webkit-animation-name: fadeInUp;
    animation-name: fadeInUp;
}

.notification-menu .dropdown-toggle {
    padding: 12px 10px;
    border-color: #fff;
    background: none;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    border-radius: 0;
    border: none;
}

.notification-menu .dropdown-toggle:hover,
.notification-menu .open .dropdown-toggle.dropdown-toggle {
    background: #f7f7f7;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}


.notification-menu .dropdown-toggle .caret {
    margin-left: 5px;
}

.notification-menu .dropdown-menu {
    margin-top: 0px;
    -moz-border-radius: 0;
    -webkit-border-radius: 0;
    border-radius: 0;
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-top: 1px solid rgba(0,0,0,0);
    border-left: 1px solid #ececec;
    border-right: 1px solid #ececec;
    border-bottom: 1px solid #ececec;
}

.notification-menu .dropdown-menu li {
    display: block;
    margin: 0;
    float: none;
    background: none;
    padding: 15px;
}

.notification-menu .dropdown-usermenu li {
    padding: 0;
}

.notification-menu .dropdown-menu li a {
    color: #fff;
    font-size: 13px;
    padding: 7px 10px;
    -moz-transition: all 0.2s ease-out 0s;
    -webkit-transition: all 0.2s ease-out 0s;
    transition: all 0.2s ease-out 0s;
}

.notification-menu .dropdown-menu li a:hover {
    background: #f7f7f7;
    color: #2b2b2c;
}


.notification-menu .dropdown-title {
    padding: 0;
    min-width: 300px;
}

.notification-menu .info-number {
    padding: 0px 18px;
    height: 60px;
    line-height: 60px;
    font-size: 16px;
    background: none;
    color: #8b8b8b;
    border-color: #fff;
    -moz-transition: all 0.2s ease-out 0s;
    -webkit-transition: all 0.2s ease-out 0s;
    transition: all 0.2s ease-out 0s;
    float: left;
}

.title {
    border-bottom: 1px solid #efefef;
    display: inline-block;
    width: 100%;
}

.dropdown-title .title {
    color: #797979;
    padding: 20px 15px;
    font-size: 14px;
    margin-top: -1px;
    margin-bottom: 0;
}

.dropdown-title .title.purple:after,
.dropdown-title .title.green:after,
.dropdown-title .title.yellow:after{
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    content: "";
    display: inline-block;
    left: 20px;
    position: absolute;
    top: -6px;
}

.dropdown-title .title.purple:after {
    border-bottom: 6px solid #9c78cd;
}

.dropdown-title .title.green:after {
    border-bottom: 6px solid #52d192;
}

.dropdown-title .title.yellow:after {
    border-bottom: 6px solid #ffd200;
}

.dropdown-title .title.purple {
    border-top:1px solid #9c78cd;
}

.dropdown-title .title.green {
    border-top:1px solid #65cea7;
}

.dropdown-title .title.yellow {
    border-top:1px solid #ffd200;
}


.info-number .badge {
    font-size: 11px;
    font-weight: normal;
    line-height: 13px;
    padding: 2px 6px;
    position: absolute;
    right: 5px;
    top: 10px;

}

/*----------------------*/

.bg-info,
.info-number .bg-info{
    color: #fff;
    background-color: #6bd3f3;
}

.bg-success,
.info-number .bg-success{
    color: #fff;
    background-color: #53d192;
}

.bg-warning,
.info-number .bg-warning{
    color: #fff;
    background-color: #ffd200;
}

.bg-primary,
.info-number .bg-primary{
    color: #fff;
    background-color: #9c78cd;
}


.bg-danger,
.info-number .bg-danger{
    color: #fff;
    background-color: #e55957;
}

.bg-dark,
.info-number .bg-dark{
    color: #fff;
    background-color: #2b2b2c;
}


/*-------------------------
    notification list
--------------------------*/


.notification-list {
    padding:0 15px;
    display: inline-block;
}

.notification-list a {
    display: inline-block;
    width: 100%;
    padding: 20px 0;
    border-top: 1px solid #f3f3f3;
    color: #2b2b2c;
    text-decoration: none;
    font-size: 14px;
}

.noti-information .notification-list {
    padding: 0;
}

.noti-information .notification-list a {
    padding: 20px;
}

.noti-information .notification-list a:hover {
    background: #fafafa;
}

.notification-list a:first-child{
    border-top: none;
}

.notification-list-scroll{
    height: 240px;
    overflow-y: scroll;
}

.notification-list a small {
    color: #bdbdbd;
    padding-left: 5px;
}

.notification-list a span.icon {
    margin-right: 15px;
    font-size: 16px;
    float: left;
}

.title-row {
    position: relative;
}

a.btn-view-all {
    position: absolute;
    right: 15px;
    top: 15px;
    padding: 3px 10px;
    border-radius: 30px;
    text-decoration: none;
    white-space: nowrap;
}

.notification-list p,
.notification-list p small{
    margin: 0;
    padding: 0;
}

.notification-list p small {
    color: #a9a9a9;
}


.task-list .progress {
    margin: 10px 0 0 0px;
    height: 10px;
}

.task-info {
    float: left;
    width: 87%;
}

.noti-information .mail-list .un-read, .noti-information .mail-list .read {
    right: 20px;
}


/* --------------------------------
       language switch
-----------------------------------*/
.language-switch li a img{
    float: right;
    margin-top: 2px;
}

.language-switch span {
    float: left;
}

.language-switch li a {
    margin: 5px 0 !important;
}


/*---------------------
    mail notification
----------------------*/

.mail-list .single-mail {
    position: relative;
}

.mail-list .un-read,
.mail-list .read{
    position: absolute;
    right: 0px;
    top: 32px;
    font-size: 12px;
    color: #dfdfe2;
}


.notification-list.mail-list a span.icon {
    padding: 3px 10px;
    margin-top: 7px;
}

/**/

.not-list span.icon {
    border-radius: 50%;
    width: 35px;
    height: 35px;
    line-height: 33px;
    font-size: 12px;
    padding: 0!important;
    text-align: center;
}

.not-list span.icon i{
    font-size: 14px;
}


.notification-list.not-list a span.icon {
    margin-top: 5px;
    margin-bottom: 25px;
}

/*-------------------------
    yamm css
-------------------------*/

.yamm .nav,
.yamm .collapse,
.yamm .dropup,
.yamm .dropdown {
    position: static;
}
.yamm .container {
    position: relative;
}
.yamm .dropdown-menu {
    left: auto;
}
.yamm .yamm-content {
    padding: 20px;
}
.yamm .dropdown.yamm-fw .dropdown-menu {
    left: 0;
    right: 0;
}


/*--------------------
    mega-menu
--------------------*/

.mega-menu {
    float: left;
    /*margin:0px 0 0 20px;*/
    padding: 0 ;
}

.mega-menu .navbar-nav {
    height: 60px;
}


.mega-menu .navbar-nav > li > a {
    padding-top: 20px;
    padding-bottom: 20px;
}

.mega-menu ul li a {
    margin-bottom: 15px;
    display: inline-block;
    color:#8b8b8b;
    font-size: 13px;
}

.mega-menu ul li  a:hover,
.mega-menu ul li  a:focus {
    background-color: #f7f7f7 !important;
}


.mega-menu ul ul li  a:hover,
.mega-menu ul ul li  a:focus {
    background: none !important;

}
.mega-menu ul ul li a {
    width: 100%;
    margin: 10px 0;
}


.mega-menu .nav .open>a,
.mega-menu .nav .open>a:hover,
.mega-menu .nav .open>a:focus{
    background-color: #fff;
}

.mega-menu ul li a i {
    padding-right: 5px;
    width: 20px;
}

.mega-menu ul li.dropdown a:hover {
    background: none;
}

.mega-menu #main-content {
    margin-left: 0px;
}

.mega-menu .title {
    color:#323232;
    font-size:14px;
    text-transform: none;
    font-weight: bold;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.mega-menu .d-title ,
.mega-menu .d-desk {
    display: block;
}

.mega-menu .d-desk {
    color:#aaa;
    font-size: 11px;
}

.custom-nav-img .desk {
    line-height: 25px;
    font-size: 13px;
    color:#8b8b8b;
}

.custom-nav-img {
    position: static;
}

.yamm-content {
    position: relative;
}

.mega-bg {
    background-image: url("../img/mega-menu/corner_image.jpg");
    background-repeat: no-repeat;
    background-position: bottom right;
    position: absolute;
    right: 0;
    bottom: -5px;
    width:300px;
    height: 130px;
}

.mega-menu .dropdown-menu {
    /*z-index: 11000!important;*/
}

.icon-img {
    float: left;
    margin-right: 10px;
}

.icon-desk {
    display: inline-block;
}

.mega-menu .dropdown-menu {
    box-shadow:none;
    border-radius: 0;
    border-color:#f1f2f7 ;
}

.wide-full {
    width: 77%;
    /*width: auto;*/
}

/*-----------------------
    right notification
------------------------*/

.right-notification {
    float: right;
    margin-right: 40px;
    height: 60px;
}

.right-notification .notification-menu > li > a {
    /*padding-top: 15px;*/
    /*padding-bottom: 16px;*/
}

.right-notification .notification-menu li a {
    height: 60px;
    line-height: 60px;
    padding: 0 15px;
}

.right-notification .notification-menu li li a {
    height: auto;
    line-height: normal;
    padding: 15px;
}


.right-notification .notification-menu li a{
    color: #8b8b8b;
}

.right-notification .notification-menu > li > a > img {
    width: 29px;
    height: 29px;
    border-radius: 50%;
    margin-right: 10px;
}

.right-notification .notification-menu li a i {
    font-size: 16px;
    position: absolute;
    right: 15px;
}

.right-notification .input-group {
    margin-top: 7px;
}


.right-notification .rounded {
    border-radius: 100px;
    background: #f3f3f3;
    border: none;
    box-shadow: none;
}

.right-notification .search .btn-sm,
.right-notification .search .btn-group-sm > .btn {
    font-size: 13px;
    line-height: 1.6;
    outline: none;
}

.right-notification .search input.form-control {
    width: 122px;
}

.right-notification .search .twitter-typeahead {
    float: left;
}

.search .input-group-btn > .btn  {
    border: none;
    background: none;
}

.search .input-group {
    background: #f3f3f3;
    border-radius: 100px;

}

.right-notification .notification-menu > li > a > span.fa-angle-down {
    margin-left: 5px;
}


.typeahead,
.tt-query,
.tt-hint {
    /*width: 396px;*/
    height: 31px;
    padding: 8px 0px 8px 10px;
    font-size: 13px;
    line-height: 30px;
    border: 2px solid #ccc;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    border-radius: 8px;
    outline: none;
}

@media screen and (-webkit-min-device-pixel-ratio:0) {

    /* Safari and Chrome */
    .typeahead,
    .tt-query,
    .tt-hint {
        height: 30px;
    }
    /* Safari only override */

    /*::i-block-chrome,.flex-direction-nav-featured a{*/
    /**/
    /*}*/
}


.tt-hint {
    color: #999
}

.tt-dropdown-menu {
    width: 130px;
    margin-top: 12px;
    padding: 8px 0;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 0px;
}

.tt-suggestion {
    padding: 3px 10px;
    font-size: 14px;
    line-height: 24px;
}

.tt-suggestion.tt-cursor {
    color: #fff;
}

.tt-suggestion p {
    margin: 0;
}

.gist {
    font-size: 14px;
}

/*---------*/

.right-notification .search input.form-control:focus {
    /*width: 130px;*/
}


.right-notification .search input.form-control,
.right-notification .search input.form-control:focus{
    -webkit-transition: all .3s ease;
    -moz-transition: all .3s ease;
    -ms-transition: all .3s ease;
    -o-transition: all .3s ease;
    transition: all .3s ease;
}


.dropdown-usermenu.purple:after {
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    content: "";
    display: inline-block;
    /*right: 6%;*/
    left: 6%;
    position: absolute;
    top: -6px;
}

.dropdown-usermenu.purple:after {
    border-bottom: 6px solid #9c78cd;
}


.right-notification .notification-menu .dropdown-menu li a:hover {
    background: #f7f7f7;
}


.right-notification .notification-menu .dropdown-menu li a:hover {
    /*color: #fff;*/
}


.dropdown-usermenu.purple {
    border-top: 1px solid #9c78cd;
}

.dropdown-usermenu {
    min-width: 230px;
}

.notification-menu .dropdown-menu {
    padding: 0;
}

#all_user_project{width: 433px;}

ul.drpdown-scroll{max-height: 300px; overflow-y: scroll;padding-left:0;}
/*---------------------
    body content
-----------------------*/

.body-content {
    margin-left: 240px;
    background: #f3f3f3;
    min-height: 900px;
    position: relative;
}

.wrapper {
    padding: 20px;
}


.wrapper::after {
    clear: both;
    display: block;
    content: '';
    margin-bottom: 30px;
}

.wrapper.no-pad {
    display: table-cell;
}



/*------------------
    page heading
-------------------*/

.page-head {
    padding: 10px 20px;
    background: #e8e8e8;
    position: relative;
}

.page-head h3 {
    margin-top: 0;
    font-size: 20px;
    font-weight: 300;
}
.page-head .sub-title {
    color: #a3a3a3;
    font-size: 14px;
}


/*.state-information {
    position: absolute;
    right: 20px;
    top: 20px;
}*/

.state-information .state-graph {
    float: right;
    margin-left: 60px;
    text-align: center;
}

.state-information .state-graph .info {
    font-size: 12px;
    color: #555555;
}

.state-graph .chart {
    margin-bottom: 5px;
}


/*---------------------
    state overview
-----------------------*/

.state-overview .symbol, .state-overview .value {
    display: inline-block;
    text-align: center;

}

.state-overview .value  {
    float: right;
    text-align: left;
}

.state-overview .value h1, .state-overview .value p  {
    margin: 0;
    padding: 0;
}

.state-overview .value h1 {
    font-weight: 300;
}

.state-overview .symbol i {
    font-size: 25px;
}

.state-overview .symbol {
    width: 30%;
    padding: 50px 15px;
}

.state-overview .value {
    width: 68%;
    margin-top: 30px;
    border-left: 1px solid;
    padding-left: 10%;
}

.state-overview .value.gray {
    border-color:#eaeaeb ;
}
.state-overview .value.white {
    border-color:rgba(255,255,255,.2) ;
}

/*----------------------*/

.state-overview .green {
    background: #53d192;
    color: #fff;
}

.state-overview .purple {
    background: #a979d1;
    color: #fff;
}

.state-overview .red {
    background: #ff6c60;
    color: #fff;
}

.state-overview .yellow {
    background: #f8d347;
    color: #fff;
}

.state-overview .blue {
    background: #57c8f2;
    color: #fff;
}


/*-------------------------------
    text color
--------------------------------*/


.green-color, .text-success {
    color: #53d192;
}

.purple-color, .text-primary {
    color: #a979d1;
}

.blue-color, .text-info {
    color: #6bd3f3;
}

.yellow-color, .text-warning {
    color: #ffd200;
}

.red-color, .text-danger {
    color: #e55957;
}


/*---------------------
    boxed view
-----------------------*/

.boxed-view {
    background: #5ac29c;
}

.boxed-view .container{
    position: relative;
    background: #32323a;
    padding: 0;
}

.boxed-view .container .header-section .logo{
    display: none;
}

.boxed-view .container .sidebar-left{
    top: 0px;
}

.boxed-view .container  .side-navigation {
    margin-top: 60px;
}

.boxed-view .right-notification {
    margin-right:0px;
}


/*---------------------
    tools
-----------------------*/


.tools {
    margin: -5px;
}
.tools a {
    border-radius: 2px;
    color: #C5C5CA;
    float: left;
    padding: 10px;
    text-decoration: none;
    font-size: 11px;
}

.tools a:hover {
    background: #7cd8a9;
    color: #fff;
}


.refresh-block{
    width: 100%;
    height: 100%;
    background-color: rgba(255,255,255,.8);
    -webkit-transition: all .05s ease;
    transition: all .05s ease;
    top: 0px;
    left: 0px;
    position: absolute;
    z-index: 1000;
    border-radius: 2px;
}

.refresh-block .refresh-loader{
    display: inline-block;
    position: absolute;
    text-align: center;
    top: 50%;
    left: 50%;
    margin-left: -16px;
    margin-top: -16px;
}
.refresh-block .refresh-loader i{
    display: inline-block;
    line-height: 32px;
    color: #000;
    font-size: 16px;
}

/*---------------------
    footer content
-----------------------*/


footer {
    background: #e9e9eb;
    padding: 15px 20px;
    color: #232425;
    font-size: 12px;
    position: absolute;
    bottom: 0;
    width: 100%;
}

footer.sticky-footer {
    position: fixed;
    bottom: 0;
    width: 100%;
}




/*---------------------------
    mobile visit
----------------------------*/

.mobile-visit {
    margin: 0px;
    padding-left: 0;
}


.mobile-visit .page-view-label{
    margin-top: 18px;
}


.mobile-visit li {
    padding: 35px 0px;
    margin-left: 4%;
    list-style: none;
    float: left;
    width: 33%;
}

.mobile-visit li:first-child{
    width: 20%;
}

.easy-pie-chart {
    display: inline-block;
    padding:0 20px 20px 0   ;
}

.easy-pie-chart .iphone-visitor {
    color: #43c584;
}

.easy-pie-chart .android-visitor{
    color: #a979d1;
}

.visit-title {
    display: inline-block;
    color: #555555;
}

.visit-title i {
    font-size: 20px;
    padding-right: 10px;
}

.visit-title i,
.visit-title span {
    float: left;
}


/*---------------------------
    monthly page view
----------------------------*/

.monthly-page-view {
    margin: 0px;
    padding-left: 0;
}

.monthly-page-view li {
    padding: 20px 0px;
    list-style: none;
}

.monthly-page-view li:last-child .chart {
    margin-top: 10px;
}

.page-view-label span {
    display: block;
    color: #bdc1c3;
}
.page-view-value {
    font-size: 26px;
    color: #555555 !important;
    font-weight: 400;
    margin-bottom: 10px;
}



/*------------------
    team member
-------------------*/

.post-wrap aside {
    display: table-cell;
    float: none;
    height: 100%;
    padding: 0;
    vertical-align: top;
}

.pro-box {
    border-collapse: collapse;
    border-spacing: 0;
    display: table;
    table-layout: fixed;
    width: 100%;
}


.team-member .action-set a,
.team-member .team-title a{
    color: #fff;
}

.team-member .action-set,
.team-member .team-title,
.team-member .sub-title {
    display: inline-block;
    width: 100%;
}

.team-member .action-set {
    margin-top: 30px;
    margin-bottom: 20px;
}

.team-member .m-name {
    margin-bottom: 5px;
    font-size: 16px;
    font-weight: 600;
}

.team-member .sub-title {
    font-size: 13px;
    color: rgba(255,255,255,.5);
}

.team-member .call-info {
    margin: 72px 0;
}

.team-member .call-info a {
    width: 38px;
    height: 38px;
    line-height: 38px;
    text-align: center;
    border: 1px solid #fff;
    border-radius: 50%;
    color: #fff;
    display: inline-block;
}

.team-member .call-info a:hover {
    background: #fff;
}

.team-member .call-info a i {
    font-size: 14px;
}

.team-member .call-info img {
    width: 100px;
    border-radius: 50%;
    margin:10px;
}

.team-member .status {
    margin: 30px 0;
    display: inline-block;
}

.team-member .status h5 {
    font-size: 14px;
    text-transform: uppercase;
    font-weight: bold;
    margin-bottom: 5px;
}

.team-member .status span {
    font-size: 13px;
}

.team-list {
    padding: 0;
    margin:0;
    list-style: none;
}

.team-list li a {
    display: inline-block;
    width: 100%;
    padding:14px 15px;
    border-bottom: 1px solid #f3f3f3;
    color: #333;
}

.team-list li:hover {
    background: #fafafa;
}

.team-list li a span {
    display: inline-block;
    margin-right: 10px;
}

.team-list li .thumb-small {
    width: 50px;
    height: 50px;
    display: inline-block;
    position: relative;
}

.team-list li .thumb-small .dot {
    width: 12px;
    height: 12px;
    display: inline-block;
    position: absolute;
    background: #e6e6e6;
    border-radius: 50%;
    top: auto;
    right: 0;
    bottom: 0;
    left: auto;
    border: 2px solid #fff;
}

.team-list li .thumb-small .dot.online {
    background: #5cc691;
}

.team-list li .thumb-small .dot.away {
    background: #ffd200;
}

.team-list li .thumb-small .dot.busy {
    background: #ff6a6a;
}

.team-list li .thumb-small .dot.offline {
    background: #e6e6e6;
}

.team-list li .thumb-small img {
    width: 100%;
    height: auto;
}

.circle {
    border-radius: 50%;
}

.team-list li .name {
    margin-top: 15px;
    display: inline-block;
}

.add-more-member {
    padding: 18px 15px;
}

.add-more-member a, a.light-color {
    color: #bdc1c3;
}

.add-more-member a:hover, a.light-color:hover {
    color: #2b2b2c;
}

a.add-btn {
    padding:4px 10px;
    color: #fff;
    display: inline-block;
    margin-top: -3px;
}


a.add-btn:hover {
    color: #fff;
}

a.add-btn {
    background: #9c78cd;
}


.team-member .call-info a:hover {
    color: #a389d3;
}

.action-tools a {
    color: #c5c5ca;
}


/*----------------
    cpu graph
------------------*/

.cpu-graph {
    padding: 32px 20px;
}

.cpu-graph .c-info {
    margin-top: 40px;
}

.cpu-graph .c-info h3 {
    color: #5dbddb;
    font-size: 16px;
    text-transform: uppercase;
}

.cpu-graph .c-info p {
    color: #b1b5b7;
    font-size: 14px;
    line-height: 25px;
}

.cpu-graph .easy-pie-chart {
    margin-top: 15px;
}

.cpu-graph .easy-pie-chart span {
    background: #90d7ed;
    width: 60px;
    height: 60px;
    line-height: 50px;
    border-radius: 50%;
    display: inline-block;
    color: #fff;
    border: 5px solid #e9f7fb;
    text-align: center;
}



/*------------------
    sale monitor
-------------------*/

.sale-monitor .title{
    margin: 0 0 40px 0;
}

.sale-monitor .title h3{
    font-size: 14px;
    text-transform: uppercase;
    color: #555;
    margin: 20px 0 10px 0;
}

.sale-monitor .title p{
    font-size: 14px;
    color: #b1b5b7;
}

.sale-monitor .states {
    width: 90%;
}

.sale-monitor .states .info {
    display: inline-block;
    width: 100%;
    font-size: 13px;
}


/*---------------------------
    dashboard v map
----------------------------*/


.w-map-size {
    width: 100%;
    height: 300px;
    position: relative;
    margin-top: 10px;
}

.jvectormap-zoomin, .jvectormap-zoomout,
.jqvmap-zoomin, .jqvmap-zoomout {
    border:1px solid #eaeaea;
    background: #fff;
    border-radius: 0;
    color: #545454;
    width: 28px;
    height: 28px;
    line-height: 20px;
    text-align: center;
    cursor: pointer;
}

.jvectormap-zoomin:hover, .jvectormap-zoomout:hover,
.jqvmap-zoomin:hover, .jqvmap-zoomout:hover {
    background: #eaeaea;
}

.jvectormap-zoomin, .jqvmap-zoomin {
    position: absolute;
    z-index: 70;
    top: 0px;
}

.jvectormap-zoomout, .jqvmap-zoomout {
    position: absolute;
    z-index: 70;
    top: 27px;
}


/*---------------------------
    flot chart
----------------------------*/


#flotTip {
    background: rgba(0,0,0,0.8);
    padding: 5px 10px;
    border-radius: 3px;
    color: #fff;
}

.pieLabel div {
    font-size: 11px !important;
    font-weight: normal;
    line-height: normal;
}

.legend table {
    left: 35px;
}

.legend > div {
    left: 33px !important;
    opacity: 0.85;
}

.earning-chart-space{
    width: 100%;
    height:268px;
    text-align: center;
    margin:0 auto;
}

.earning-chart-info {
    padding: 15px  0 0 0
}

.earning-chart-info h4{
    /*margin-top: 0;*/
    margin-bottom: 5px;
}

.series-list input {
    margin-right: 10px;
}

.f-c-space {
    width: 100%;
    height:280px;
    text-align: center;
    margin:0 auto;
}

/*---------------------------
    code high light style
----------------------------*/


.highlight pre code {
    color: #333333;
    font-size: inherit;
}

.nt {
    color: #2F6F9F;
}

.na {
    color: #4F9FCF;
}

.s {
    color: #D44950;
}

.c {
    color: #999999;
}


.r-close-btn {
    position: absolute;
    right: 10px;
    color: #fff;
    top: 15px;
    cursor: pointer;
    width: 30px;
    height: 30px;
    text-align: center;
    line-height: 30px;
    border-radius: 2px;
    -webkit-transition:all 0.3s;
    -moz-transition:all 0.3s;
    transition:all 0.3s;
}

.r-close-btn:hover {
    color: #fff;
}


/*---------------------------
    right side bar
----------------------------*/

.sb-toggle-right {
    width: 55px;
    height: 60px;
    line-height: 30px;
    font-size: 14px;
    padding: 15px;
    cursor: pointer;
    text-align: center;
    color: #384246;
    -moz-transition: all 0.2s ease-out 0s;
    -webkit-transition: all 0.2s ease-out 0s;
    transition: all 0.2s ease-out 0s;
}

.sb-toggle-right:hover {
    background: #f7f7f7;
}


.sb-slidebar {
    background-color: #fff !important;
    /*margin-top: 60px;*/
    border-left: 1px solid #e9e9e9;
    color: #2b2b2c;
}
.sb-slidebar .side-title {
    padding: 10px 0px;
    text-transform: uppercase;
    color: #FF6C60;
}

.right-bar .tab-content {
    padding: 20px;
}

.sb-slidebar .tab-content>.active {
    display: none;
    visibility: hidden;
}

.sb-slidebar.sb-active .tab-content>.active {
    display: block;
    visibility: visible;
}

.right-bar .nav-tabs li a,
.right-bar .nav-tabs li a:hover,
.right-bar .nav-tabs li.active a {
    padding: 20px 15px;
    border-radius: 0;
    border: none;
}

.right-bar .nav-tabs li a {
    color: #fff;
    margin-right: 0px;
}

.right-bar .nav-tabs li a:hover,
.right-bar .nav-tabs li.active a {
    color: #2b2b2c;
    background: #fff;
}

.right-bar .nav-tabs {
    background: #2b2b2c;
    color: #fff;
}


/*---------------
    chat
----------------*/

.chat-list {
    position: relative;
    margin-bottom: 20px;
}

.chat-list h3{
    font-size: 14px;
    text-transform: uppercase;
    color: #000;
    margin: 0 0 5px;
}

.chat-list h5{
    font-size: 12px;
    color: #a5a5a5;
    margin: 0;
}

.chat-list a {
    color: #323232;
}

.chat-list .add-people {
    position: absolute;
    right: 0;
    top: 5px;
}

.side-title {
    display: table;
    margin: 0 0 20px;
    overflow: hidden;
}
.side-title h2  {
    float: left;
    padding: 0 10px 0 0;
    margin: 0;
    font-size: 14px;
    text-transform: uppercase;
    color: #2b2b2c;
    font-weight: bold;
}

.side-title .title-border-row {
    position: relative;
    display: table-cell;
    vertical-align: middle;
    height: 1px;
    width: 100%;
}

.side-title .title-border {
    height: 1px;
    border-top: 1px solid #e8e8e8;
    position: relative;
    display: block;
    width: 100%;
    box-sizing: content-box;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    -o-box-sizing: content-box;
}

.team-list.chat-list-side li:hover {
    background: #f3f3f3;
}

.team-list.chat-list-side li .thumb-small {
    width: 30px;
    height: 30px;
}

.team-list.chat-list-side li .thumb-small {
    margin-top: 5px;
}

.team-list.chat-list-side li .thumb-small .dot {
    right: -3px;
    top: 0px;
}

.team-list.chat-list-side li .name {
    margin-top: 0;
    font-size: 14px;
    color: #2b2b2c;
}

.inline small {
    display: block;
}

.team-list.chat-list-side {
    margin: 0 -20px 20px -20px;
}

.team-list.chat-list-side li a {
    display: table;
    padding: 10px 20px;
    border: none;
    position: relative;
}

.team-list.chat-list-side li .thumb-small ,
.team-list.chat-list-side li .inline {
    display: table-cell;
    float: none;
    vertical-align: middle;
}

.team-list.chat-list-side li .inline {
    padding-left: 20px;
    text-align: left;
}

.team-list.chat-list-side li .settings {
    position: absolute;
    right: 10px;
    top: 16px;
}


.right-bar .tab-pane .team-list.chat-list-side:last-child,
.right-bar .tab-pane .aside-widget:last-child {
    padding-bottom: 100px;
}

.right-bar .tab-pane .aside-widget .team-list.chat-list-side:last-child {
    padding-bottom: 0px;
}


.right-bar .tab-pane .aside-widget{
    margin: 0px -20px;
    padding: 0px 20px;
}


/*---------------------
        info
---------------------*/

.chat-list.info h3{
    margin-top: 5px;
}

.chat-list.info .add-people {
    top: -3px;
}

.side-title-alt {
    background: #f3f3f3;
    border-top: 1px solid #e8e8e8;
    border-bottom: 1px solid #e8e8e8;
    padding: 10px 20px;
    position: relative;
    margin: 0 -20px 0 -20px;

}

.side-title-alt h2 {
    font-size: 15px;
    margin:0;
    color: #2b2b2c;
}

.side-title-alt a.close {
    position: absolute;
    right: 20px;
    top: 10px;
    font-size: 14px;
}

.team-list.chat-list-side.info {
    margin-bottom: 0;
}

.team-list.chat-list-side.info li .inline {
    padding-left: 0px;
}

.team-list.chat-list-side.info li  {
    padding: 15px 20px;
    border-bottom: 1px solid #e9e9e9;
}

.team-list.chat-list-side.info li:last-child  {
    border-bottom: none;
}

.team-list.chat-list-side.info li:hover {
    background: #35b575;
}

.team-list.chat-list-side.info li span.value {
    display: block;
}

.team-list.chat-list-side.info.statistics li .inline{
    width: 85%;
}

.border-less-list li {
    border-bottom: none !important;
}

.info.sale-monitor .states {
    width: 100%;
}

.info.sale-monitor .progress {
    margin-bottom: 5px;
}

/*---------------------
        settings
-----------------------*/

.settings-head {
    margin-bottom: 0;
}

.settings-head h3{
    font-size: 17px;
    text-transform: capitalize;
}

.setting-list {
    margin-bottom: 20px !important;
}

.bottom-border {
    border-bottom: 1px solid #eeeeee;
    padding-bottom: 15px;
}


/*-------------------
    weather widget
--------------------*/

.weather-widget {
    width: 100%;
    float: left;
    background: #fff;
    margin-bottom: 20px;
}

.weather-widget .weather-state {
    background-color: #00c4a9;
    background-image: url(../img/weather_background.jpg);
    background-size: cover;
    height: 261px;
    width: 45%;
    text-align: center;
}

.weather-widget .weather-state .weather-icon {
    font-size: 60px;
    color: #fff;
    display: block;
    margin: 20px 0 60px 0;
}
.weather-widget .weather-state .weather-type {
    display: block;
    text-align: center;
    padding: 20px 0;
    font-size: 28px;
    color: #fff;
    font-weight: 300;
    line-height: 28px;
}

.weather-widget .weather-state,
.weather-widget .weather-info {
    float: left;
    padding:20px;
}


.weather-widget .weather-info {
    width: 54%;
}

.weather-widget .weather-info .degree {
    font-size: 72px;
    display: block;
    font-weight: 100;
    margin-top: 20px;
}

.weather-widget .weather-info .degree:after {
    content: "o";
    position: relative;
    top: -40px;
    font-size: 20px;
    font-weight: 400;
}

.weather-widget .weather-info .weather-city {
    color:#bdc1c3;
    font-size: 20px;
    font-weight: 300;
    margin-top: 20px;
    display: block;
}

.weather-widget .weather-info {
    position: relative;
}

.weather-widget .weather-info .switch-btn {
    position: absolute;
    right: 20px;
    top: 30px;
}


/*----------------------------
        login page
------------------------------*/

.login-body {
    background-color: #2b2b2d;
}

.login-body .login-logo {
    margin: 0;
    text-align: center;
    background: #1b1b1d;
    color: #fff;
    font-size: 18px;
    text-transform: uppercase;
    display: inline-block;
    width: 100%;
    padding: 50px 0;
}

.form-signin {
    max-width: 330px;
    margin: 50px auto 0;
}

h2.form-heading {
    margin: 0;
    padding:30px 15px;
    text-align: center;
    background: #222224;
    color: #fff;
    font-size: 18px;
    text-transform: uppercase;
    display: inline-block;
    width: 100%;
}

.form-signin .checkbox {
    margin-bottom: 14px;
}

.radios {
    display: inline-block;
    margin-bottom: 15px;
    width: 100%;
}

.radios .col-sm-6, .radios .col-lg-6 {
    padding-left: 0;
}

.form-signin .checkbox, .radios label {
    font-weight: normal;
    color: #565658;
}


.form-signin .checkbox input[type="checkbox"],
.radios input[type="radio"]{
    margin-right: 5px;
}

.form-signin .form-control {
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    z-index: 2;
}

.form-signin input[type="text"], .form-signin input[type="password"] {
    margin-bottom: 15px;
    border-radius: 4px;
    border: none;
    background: #222224;
    box-shadow: none;
    font-size: 13px;
    color: #fff;
    padding: 12px;
}


.form-signin p {
    /*text-align: center;*/
    color: #b6b6b6;
    font-size: 14px;
}

.modal-body p {
    color: #333;
}

.form-signin a, .registration, .login-body label  {
    color: #565658;
}

.registration a {
    color: #fff;
}


.form-signin a:hover {
    color: #b6b6b6;
}


.login-social-link  {
    display: inline-block;
    margin-top: 20px;
    margin-bottom: 15px;
    width: 100%;
}

.login-social-link a {
    color: #fff;
    padding: 10px 38px;
    border-radius: 2px;
    width: 46.5%;
    text-align: center;
}

.login-social-link a:hover {
    color: #fff;
}

.login-social-link a i {
    font-size: 20px;
    padding-right: 10px;
}

.login-social-link a.facebook {
    background: #3b5999;
    margin-right: 22px;
    float:left;
}

.login-social-link a.facebook:hover {
    background: #344f87;
}

.login-social-link a.twitter {
    background: #63c6ff;
    float:left;
}

.login-social-link a.twitter:hover {
    background: #4c98c4;
}

.modal-body input[type="text"] {
    background: #fff;
    border: 1px solid #ddd;
    color: #333;
}


/*----------------
    lock
------------------*/

.lock span {
    display: block;
    font-size: 14px;
    color: #49494a;
    text-transform: none;
}

.lock span.u-name {
    font-size: 18px;
    color: #fff;
    margin: 10px 0;
}

.d-log a {
    color: #49494a;
}

.user-avatar img {
    border-radius: 50%;
    width: 112px;
    height: 112px;
    margin-top: -20px;
    margin-bottom: 25px;
}

.lock-row, .log-row {
    margin-bottom: 50px;
}



/*----------------------
    404 page
-----------------------*/

.body-404, .body-500 {
    background: #2b2b2d;
    color: #fff;
}

.error-wrapper {
    text-align: center;
    margin-top: 10%;
}

.error-wrapper .icon-404{
    background: url("../img/404.png") no-repeat;
    width: 337px;
    height: 218px;
    display: inline-block;
    margin-left: 30px;
}

.error-wrapper .icon-403{
    background: url("../img/403.png") no-repeat;
    width: 337px;
    height: 218px;
    display: inline-block;
    margin-left: 30px;
}

.error-wrapper h2 {
    font-size: 20px;
    font-weight: normal;
    margin: -5px 0 30px -70px;
    display: inline-block;
    width: 245px;
    padding: 20px;
    border-radius: 4px;
    text-transform: capitalize;
}

.error-wrapper .green-bg {
    background: #5bc690;
}


.error-wrapper a.back-btn:hover {
    color: #5bc690;
}

.error-wrapper p, .error-wrapper a {
    font-size: 18px;
}

.error-wrapper p   {
    color: #a978d1;
}

.error-wrapper a.back-btn {
    color: #fff;
}


/*-----------------
    500 page
------------------*/


.error-wrapper .purple-bg {
    background: #a978d1;
}

.body-500 .error-wrapper p a {
    color: #a978d1;
}

.body-500 .error-wrapper p {
    color: #63c18d;
}

.error-wrapper .icon-500{
    background: url("../img/500.png") no-repeat;
    width: 331px;
    height: 219px;
    display: inline-block;
}

.body-500 .error-wrapper h2 {
    margin: -5px 0 30px -50px;
    width: 300px;
}


/*----------------------------------
    Checkbox and Radio buttons
-------------------------------------*/

.radio label, .checkbox label {
    min-height: 20px;
    padding-left: 5px;
    margin-bottom: 0;
    font-weight: normal;
    cursor: pointer;
    padding-right: 10px;
}

.checkbox-custom,
.radio-custom {
    margin: 10px 0 10px 0;
    padding-left: 0px;
    display: block;
}

.checkbox-custom.inline,
.radio-custom.inline {
    padding-left: 0px;
    display: inline-block;
    margin: 10px 0 10px 0;
}

.checkbox-custom label,
.radio-custom label {
    display: inline-block;
    cursor: pointer;
    position: relative;
    padding-left: 30px !important;
    margin-right: 15px;
}

.checkbox-custom label:before,
.radio-custom label:before {
    content: "";
    display: inline-block;
    width: 16px;
    height: 16px;
    margin-right: 5px;
    position: absolute;
    left: 0px;
    border: 1px solid #dbdbdb;
    margin-top: 4px;
}


.checkbox-custom input[type=radio][disabled] + label:after {
    background-color: #e6e6e6;
}

.checkbox-custom label {
    /*white-space: nowrap;*/
    white-space: inherit;
    -webkit-transition: all .2s;
    transition: all .2s;
}

.checkbox-custom label:before {
    top: -1px;
    -webkit-transition: all .2s;
    transition: all .2s;
}

.checkbox-custom label::after {
    display: inline-block;
    width: 16px;
    height: 16px;
    position: absolute;
    left: 2.5px;
    top: 1px;
    font-size: 12px;
    -webkit-transition: all .2s;
    transition: all .2s;
}

.checkbox-custom input[type=checkbox] {
    display: none !important;
}

.checkbox-custom input[type=checkbox]:checked + label:before {
    border-width: 8px;
}

.checkbox-custom input[type=checkbox]:checked + label::after {
    font-family: 'FontAwesome';
    content: "\F00C";
    color: #fff;
}

.checkbox-custom input[type=checkbox][disabled] + label {
    opacity: 0.5;
}

.checkbox-custom input[type=checkbox][disabled] + label:before {
    background-color: #e2e5e9;
}

.radio-custom label {
    margin-bottom: 6px;
}

.radio-custom label:before {
    border-radius: 50%;
    -webkit-transition: all .2s;
    transition: all .2s;
}

.radio-custom input[type=radio]:checked + label:before {
    border-width: 6px;
}

.radio-custom input[type=radio] {
    display: none;
}

.radio-custom input[type=radio][disabled] + label {
    opacity: 0.5;
}

.radio-custom.radio-success input[type=radio]:checked + label:before,
.checkbox-custom.check-success input[type=checkbox]:checked + label:before{
    border-color: #53D192;
}

.radio-custom.radio-primary input[type=radio]:checked + label:before,
.checkbox-custom.check-primary input[type=checkbox]:checked + label:before{
    border-color: #8f67b1;
}

.radio-custom.radio-info input[type=radio]:checked + label:before,
.checkbox-custom.check-info input[type=checkbox]:checked + label:before{
    border-color: #119dc9;
}

.radio-custom.radio-warning input[type=radio]:checked + label:before,
.checkbox-custom.check-warning input[type=checkbox]:checked + label:before{
    border-color: #ecc200;
}

.radio-custom.radio-danger input[type=radio]:checked + label:before,
.checkbox-custom.check-danger input[type=checkbox]:checked + label:before{
    border-color: #e55957;
}

.radio-custom.radio-dark input[type=radio]:checked + label:before,
.checkbox-custom.check-dark input[type=checkbox]:checked + label:before{
    border-color: #333;
}



/*------------------
    to do list
-------------------*/

.todo-list-item {
    padding-left: 0;
}
.todo-list-item li {
    background:#f9f9f9;
    position:relative;
    padding:13px;
    margin-bottom:5px;
/*    cursor:move;*/
    list-style: none;
    border-top: #f3f3f3 1px solid;
    border-right: #f3f3f3 1px solid;
    border-bottom: #f3f3f3 1px solid;
    border-left: #f3f3f3 1px solid;
}


.todo-list-item li:before{
    content: "";
    display: inline-block;
    height: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    width: 3px;
    background-color: #a288d2;

}

.todo-list-item li.todo-done:before{
    content: "";
    display: inline-block;
    height: 100%;
    position: absolute;
    top: 0px;
    left: 0px;
    width: 3px;
    background-color: #5FC29D;

}

.todo-done .todo-title{
    text-decoration:line-through;
    color: #b1b5b7;
}
.todo-list-item li p {
    margin-bottom:0px;
}
.action-todo {
    position:absolute;
    right:15px;
    top:13px;
}
.action-todo a {
    height:24px;
    width:24px;
    display:inline-block;
    float:left;
}
.action-todo a i {
    height:24px;
    width:24px;
    display:inline-block;
    text-align:center;
    line-height:24px;
    color:#ccc;
}
.action-todo a:hover i {
    color:#666;
}
.todo-done i {
    font-size:14px;
}
.todo-remove i {
    font-size:14px;
}

.line-through {
    text-decoration:line-through;
}
.todo-action-bar {
    margin-top:20px;
}

/* To-Do Check*/

.chk-todo{
    margin-right: 10px;
    position: relative;
    top: -2px;
}

.btn-todo-select button,.btn-add-task button {
    width:100%;
    font-size: 12px;
}
.todo-search-wrap {
    padding:0px;
}
.todo-search {
    -moz-border-radius:3px !important;
    -webkit-border-radius:3px !important;
    border-radius:3px !important;
}
.action-todo a.todo-remove:hover i{
    color: red !important;

}



/*------------------------
    mail inbox
------------------------*/

.mail-box {
    border-collapse: collapse;
    border-spacing: 0;
    display: table;
    table-layout: fixed;
    width: 100%;
}

.mail-box aside {
    display: table-cell;
    float: none;
    height: 100%;
    padding: 0;
    vertical-align: top;
}

.mail-box .sm-side {
    width: 25%;
    background: #f5f5f5;
}
.mail-box .lg-side {
    width: 75%;
    background: #fff;
}

.mail-box .sm-side .m-title {
    background: #e9e9eb;
    padding: 10px 20px;
    color: #32323a;
    min-height: 80px;
}

.mail-box .sm-side .m-title h3 {
    margin: 8px 0 0 0;
    font-size: 20px;
    font-weight: 400;
}

.mail-box .sm-side .m-title span {
    color: #a3a3a3;
    font-size: 14px;
}

.inbox-body {
    padding: 20px;
    /*margin-bottom: 20px;*/
}
.inbox-body .btn-group {
    margin-bottom: 20px;
}

.btn-compose {
    background: #e55957;
    padding: 12px 0;
    text-align: center;
    width: 100%;
    color: #fff;
}
.btn-compose:hover, .btn-compose:focus {
    background: #c74d4c;
    color: #fff;
}

ul.inbox-nav  {
    display: inline-block;
    width: 100%;
    margin: 0;
    padding: 0;
}

.inbox-divider {
    border-bottom: 1px solid #e0e0e1;
}

ul.inbox-nav li {
    display: inline-block;
    line-height: 45px;
    width: 100%;
}

ul.inbox-nav li a  {
    color: #6a6a6a;
    line-height: 45px;
    width: 100%;
    display: inline-block;
    padding: 0 20px;
    border-right: 2px solid #f5f5f5;
}

ul.inbox-nav li a:hover, ul.inbox-nav li.active a, ul.inbox-nav li a:focus  {
    color: #222223;
    background: #fff;
    border-right: 2px solid #53d192;
}

ul.inbox-nav li a i {
    padding-right: 10px;
    font-size: 16px;
    color: #aaaaaa;
}

ul.inbox-nav li a span.label {
    margin-top: 13px;
}

ul.labels-info li h4 {
    padding-left:15px;
    padding-right:15px;
    padding-top: 5px;
    color: #5c5c5e;
    font-size: 13px;
    text-transform: uppercase;
}

ul.labels-info li, .inbox-small-cells .checkbox label {
    margin: 0;
}

ul.labels-info li a {
    color: #6a6a6a;
    border-radius: 0;
    border-right: 2px solid #f5f5f5;
}

ul.labels-info li a:hover, ul.labels-info li a:focus {
    color: #222223;
    background: #fff;
    border-right: 2px solid #53d192;
}

ul.labels-info li a i {
    padding-right: 10px;
}

.nav.nav-pills.nav-stacked.labels-info p {
    margin-bottom: 0;
    padding: 0 22px;
    color: #9d9f9e;
    font-size: 11px;
}

.inbox-head {
    padding:20px 15px;
    background: #f3f3f3;
    color: #333;
    min-height: 80px;
}

.inbox-head  h3 {
    margin: 0;
    display: inline-block;
    padding-top: 6px;
    font-weight: 300;
}

.all-check {
    background: #fff;
    border: 1px solid #e7e7e7;
    padding-left: 10px;
    height: 32px;
    margin-right: -1px;
}

.all-check .checkbox-custom {
    width: 30px;
    margin: 5px 0 0 0;
    position: relative;
    top: -10px;
}

.inbox-small-cells .checkbox-custom {
    margin: 0;
    height: 35px;
    width: 20px;
}

.all-check .checkbox-custom label:before {
    /*top: -10px;*/
}

.table-inbox .checkbox {
    margin: 5px 0 0 0;
    width: 10px;
}

.table-inbox {
    margin-bottom: 20px;
    font-size: 13px;
}

.table-inbox > tbody > tr > td {
    border-top: none;
    vertical-align: middle;
}

.table-inbox tr td{
    padding:5px 15px  !important;
}


.table-inbox tr td:hover{
    cursor: pointer;
}

.table-inbox tr td .fa-star.inbox-started ,.table-inbox tr td .fa-star:hover{
    color: #ffd200;
}

.table-inbox tr td .fa-star{
    color: #d5d5d5;
}

.table-inbox tr.unread td {
    font-weight: 600;
}

.table-inbox .avatar img, .table-inbox .avatar span {
    width: 30px;
    height: 30px;
    line-height: 30px;
    display: inline-block;
}

.table-inbox .avatar span {
    /*background: #929292;*/
    text-align: center;
    color: #fff;
}

ul.inbox-pagination  {
    float: right;
}

ul.inbox-pagination li {
    float: left;
}

.mail-option {
    display: inline-block;
    width: 100%;
}

.mail-option .chk-all, .mail-option .btn-group {
    margin-right: 5px;
}

.mail-option .chk-all, .mail-option .btn-group a.btn {
    border: 1px solid #e7e7e7;
    padding: 5px 10px;
    display: inline-block;
    background: #fcfcfc;
    color: #afafaf;
}

.inbox-pagination {
    margin-bottom: 0;
    list-style: none;
}

.inbox-pagination a.np-btn  {
    border: 1px solid #e7e7e7;
    padding: 5px 15px;
    display: inline-block;
    background: #fcfcfc;
    color: #afafaf;
}

.mail-option .chk-all input[type=checkbox] {
    margin-top: 0;
}

.mail-option .btn-group a.all {
    padding: 0;
    border: none;
}

.inbox-pagination a.np-btn {
    margin-left: 5px;
}

.inbox-pagination li span {
    display: inline-block;
    margin-top: 7px;
    margin-right: 5px;
}

.fileinput-button {
    border: 1px solid #e6e6e6;
    background: #eeeeee;
}

.inbox-body .modal .modal-body input, .inbox-body .modal .modal-body textarea{
    border: 1px solid #e6e6e6;
    box-shadow: none;
}

.inbox-body .btn {
    border-radius: 0;
}

.btn-send, .btn-send:hover {
    background: #00A8B3;
    color: #fff;
}

.btn-send:hover {
    background: #009da7;
}

.modal-header h4.modal-title {
    font-weight: normal;
}

.modal-body label {
    font-weight: 400;
}

.heading-inbox h4{
    font-size: 30px;
    font-weight: 300;
    color: #444;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
    margin-top: 0px;
    margin-bottom: 20px;
}

.sender-info {
    margin-bottom: 20px;
}

.sender-info .date {
    margin: 5px 20px 0 0;
    color: #a3a3a3;
}

.sender-info img {
    width: 50px;
    height: 50px;
}

.s-info {
    margin-left: 15px;
    display: inline-block;
}

.s-info strong {
    display: block;
}

.s-info span {
    color: #a3a3a3;
}

.sender-dropdown {
    border:1px solid #eaeaea;
    padding:0 3px;
    color: #777;
    font-size: 10px;
    width: 18px;
    display: inline-block;
}

.view-mail a {
    color: #9c78cd;
}

.view-mail p {
    line-height: 25px;
}

.attachment-mail {
    margin-top: 30px;
}

.attachment-mail h5 {
    font-weight: bold;
}

.attachment-mail ul {
    width: 100%;
    display: inline-block;
    margin-bottom: 20px;
    list-style: none;
    padding: 0;
}

.attachment-mail ul li {
    float: left;
    width: 180px;
    margin-right: 10px;
    margin-bottom: 10px;
    border: 1px solid #dfdfdf;
    text-align: center;
}

.attachment-mail ul li a{
    padding: 5px;
    display: inline-block;
    height: 110px;
    line-height: 98px;
}

.attachment-mail ul li img {
    width: 100%;
}

.attachment-mail ul li span {
    float: right;
}
.attachment-mail .file-name {
    float: left;
    background: #f5f5f5;
    width: 100%;
    padding: 8px;
    border-top: 1px solid #dfdfdf;
    font-size: 12px;
    cursor: pointer;
}


.attachment-mail .file-name i {
    padding-right: 5px;
}


.no-pad {
    padding: 0px;
}


.mail-box .checkbox-custom label::after {
    top: 3px;
}

.mail-box .mail-option .checkbox-custom label::after {
    top: 1px;
}

.team-member-info{
    background-color: #9c78cd;
    width:100%;
}
.reply-mail {
    border-top: 1px solid #e1e1e1;
    padding-top: 30px;
}


/*compose-mail*/


.compose-mail {
    width: 100%;
    display: inline-block;
    position: relative;
}


.compose-mail .compose-options {
    color: #979797;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    position: absolute;
    right: 10px;
    top: 7px;
}

.compose-options a {
    color: #545454;
    margin-left: 5px;
}


.compose-mail .form-group label {
    margin-bottom: 0;
    font-weight: normal;
}

.compose-editor input {
    margin-top: 15px;
}

.compose-editor .form-horizontal .form-group {
    margin: 0;
}

.compose-btn {
    float: left;
    margin-bottom: 40px;
}

.compose-editor textarea {
    border-color: #dfdfdf;
    box-shadow: none;
    border-radius: 0;
}

.compose-mail .form-horizontal .control-label {
    text-align:left;
}



/*---------------
    form layout
--------------*/

.form-control {
    border: 1px solid #dfdfdf;
    box-shadow: none;
    border-radius: 0;
}

.form-control:focus {
    box-shadow: none;
}

.bv-form .help-block {
    margin-bottom: 0;
}
.bv-form .tooltip-inner {
    text-align: left;
}
.nav-tabs li.bv-tab-success > a {
    color: #3c763d;
}
.nav-tabs li.bv-tab-error > a {
    color: #a94442;
}

div.tagsinput , .colpick, .colpick_field, .colpick_hex_field,
.select2-container .select2-choices .select2-search-field input,
.select2-container .select2-choice, .select2-container .select2-choices{
    border-radius: 0;
    box-shadow: none;
}


.bootstrap-touchspin .input-group-btn-vertical .bootstrap-touchspin-up , .select2-search input{
    border-radius: 0;
    border-top-right-radius: 0;
}

.select2-search input {
    background: none;
}

.bootstrap-touchspin .input-group-btn-vertical .bootstrap-touchspin-down {
    margin-top: -2px;
    border-radius: 0;
    border-bottom-right-radius: 0px;
}

.select2-container-active .select2-choice, .select2-container-multi.select2-container-active .select2-choices {
    box-shadow: none;
}

.select2-container .select2-choice .select2-arrow {
    width: 25px;
}

.select2-container .select2-choice .select2-arrow b, .select2-container .select2-choice div b {
    background-position: 3px 3px;
}

.select2-container .select2-choice abbr {
    right: 30px;
}

.spinner .input-group-btn:first-child > .btn, .spinner .input-group-btn:first-child > .btn-group {
    margin-right: -2px;
}

.ui-widget-content {
    list-style: none;
    padding: 10px 15px;
    width: 50%;
}

.ui-widget-content li a {
    color: #323232;
    line-height: 30px;
    display: block;
}


.icheck-row label {
    text-align: left;
    padding: 0 10px;
}


/*--------------------------
      picker
---------------------------*/

.add-on {
    float: right;
    margin-top: -37px;
    padding: 3px;
    text-align: center;
}

.add-on .btn {
    padding: 8px;
}


.colorpicker.dropdown-menu {
    min-width: 130px;
    padding: 5px;
}

.datepicker.dropdown-menu {
    z-index: 1060;
    padding: 5px;
}

.custom-date-range .input-group-addon {
    border-left: 1px solid #EEEEEE;
    border-right: 1px solid #EEEEEE;
}

.input-group-btn.add-on:last-child>.btn  {
    margin-left: -31px;
}



/*-------------
    Table
--------------*/

.custom-table tr th,
.custom-table tr td {
    vertical-align: middle !important;
}

.custom-table tr td .progress {
    margin-bottom: 0px;
}

.table-hover > tbody > tr:hover {
    background-color: #f9f9f9;
}

/*-------------
    general
--------------*/

.btn-gap .btn {
    float: left;
    margin-right: 5px;
}

.breadcrumb li a {
    color: #4d4d4f;
}

.breadcrumb li a:hover {
    color: #2b2b2c;
}

.light-color {
    color: #fff !important;
}

.pulse {
    margin:100px auto 40px;
    padding:5px 10px;
    border:1px solid #ddd;
    color:#000;
    text-align:center;
    text-shadow:none;
}
.pulse {margin:20px; float:left; }
.end {text-align:right;font-style:italic;}


/*carousel*/

.carousel-indicators li {
    background:  rgba(0, 0, 0, 0.2) ;
    border:  none;
    transition:background-color 0.25s ease 0s;
    -moz-transition:background-color 0.25s ease 0s;
    -webkit-transition:background-color 0.25s ease 0s;
}

.carousel-indicators .active {
    background:#a978d1;
    height: 10px;
    margin: 1px;
    width: 10px;
}

.carousel-indicators.out {
    bottom: -5px;
}

.carousel-indicators.out {
    bottom: -5px;
}

.carousel-control {
    color: #999999;
    text-shadow: none;
    width: 45px;
}

.carousel-control i {
    display: inline-block;
    height: 25px;
    left: 50%;
    margin-left: -10px;
    margin-top: -10px;
    position: absolute;
    top: 50%;
    width: 20px;
    z-index: 5;
}


.carousel-control.left, .carousel-control.right {
    background: none;
    filter:none;
}

.carousel-control:hover, .carousel-control:focus {
    color: #CCCCCC;
    opacity: 0.9;
    text-decoration: none;
}

.carousel-inner h3 {
    font-weight: 300;
    font-size: 16px;
    margin: 0;
}

.carousel-inner {
    margin-bottom: 15px;
}


/*-------*/


.isolate-tabs {
    margin-bottom: 20px;
}

.isolate-tabs li a {
    color: #333;
}

.isolate-tabs .panel-body{
    background: #fff;
    border-left: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
    border-right: 1px solid #ddd;
}

.isolate-tabs .nav-tabs.nav-justified > li > a,
.isolate-tabs .nav-tabs > li > a{
    border-radius: 0;
}

.panel-heading.tab-dark .nav {
    border: medium none;
    font-size: 13px;
    margin:  -15px;
}

.tab-dark {
    background: #32323a;
    border-bottom: none;
}

.tab-dark .nav-tabs > li > a {
    margin-right: 1px;
}

.tab-dark  .nav > li > a {
    position: relative;
    display: block;
    padding: 12px 15px;
}

.tab-dark li a i {
    padding: 0 5px;
}

.panel-heading .nav > li > a,
.panel-heading .nav > li.active > a, .panel-heading .nav > li.active > a:hover, .panel-heading .nav > li.active > a:focus {
    border-width: 0;
    border-radius: 0;
}

.panel-heading .nav > li > a {
    color: #fff;
}

.panel-heading .nav > li.active > a, .panel-heading .nav > li > a:hover {
    color: #32323a;
    background: #fff;
}

.panel-heading {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

.tab-right {
    height: 42px;
    line-height: 13px;
}

.panel-heading.tab-right .nav-tabs > li > a {
    margin-left: 1px;
    margin-right: 0px;
}

.m-bot-none {
    margin-bottom: 0;
}

.wht-color {
    color: #fff;
}

.close-sm {
    font-size: 14px;
}

.pager a{
    color: #333;
}

/* collapsible*/

.panel-group .panel-heading .panel-title > a {
    display: block;
    font-size: 12px;
    font-weight: normal;
}

.panel-group .panel-heading .panel-title > a.collapsed:after {
    content: "\f067";
    color: #8b8b8b;
}
.panel-group .panel-heading .panel-title > a:hover:after {
    color: #333 !important;
}
.panel-group .panel-heading .panel-title > a:after {
    font-family: 'FontAwesome';
    content: "\f068";
    float: right;
    color: #333;
}


/*-------------------
        toastr
--------------------*/


.toastr-row label {
    font-weight: 400;
}

.checkbox-list .checker span {
    float: left;
    margin-right: 10px;
}

.toastr-pad  input, .toastr-row label{
    margin-bottom: 10px;
}

#toast-container > div, #toast-container > :hover{
    -moz-box-shadow: none;
    -webkit-box-shadow: none;
    box-shadow: none;
}

pre {
    border-radius: 0;
    border: 1px solid #ddd;
    background: none;
}

/*------------------------------------
    font awesome & simple icon
---------------------------------------*/

.font-awesome-icon h4 {
    margin-top: 20px;
}

.fontawesome-list div, .simple-icon-list div  {
    line-height: 35px;
}

.fontawesome-list div i, .simple-icon-list div i {
    width: 30px;
    display: inline-block;
}

.font-awesome-icon .page-header {
    border-bottom: 1px solid #ddd;
}



/*----------------------------
        slider
----------------------------*/

table.sliders tr td {
    padding: 30px 0;
    border:none;
}

.slider {
    margin-top: 3px;
}

.slider.ui-widget-content, .ui-slider.ui-widget-content {
    list-style: none;
    padding: 0;
    width: auto;
}

.slider-info {
    padding-top: 10px;
}

.sliders .ui-widget-header {
    background: #9c78cd !important;
    border-radius: 0px !important;
    -webkit-border-radius: 0px !important;
}

.ui-corner-all, .ui-corner-bottom, .ui-corner-right, .ui-corner-br {
    border-bottom-right-radius: 0 !important;
}
.ui-corner-all, .ui-corner-bottom, .ui-corner-left, .ui-corner-bl {
    border-bottom-left-radius: 0 !important;
}
.ui-corner-all, .ui-corner-top, .ui-corner-right, .ui-corner-tr {
    border-top-right-radius: 0 !important;
}
.ui-corner-all, .ui-corner-top, .ui-corner-left, .ui-corner-tl {
    border-top-left-radius: 0 !important;
}


#eq span {
    height:120px; float:left; margin:15px
}


.ui-widget-content {
    background: #f0f2f7 !important;
    border: none !important;
    border-radius: 0px !important;
    -webkit-border-radius: 0px !important;
}

.ui-slider-horizontal {
    height: 5px !important;
}

.ui-slider-horizontal .ui-slider-handle {
    top: -0.50em   !important;
}

.ui-state-default,
.ui-widget-content .ui-state-default,
.ui-widget-header .ui-state-default {
    background: #fff !important;
    border: 1px solid #d8dadf !important;
    border-radius: 50% !important;
    -webkit-border-radius: 50% !important;
}

.ui-widget-content .ui-slider-handle:after{
    content: "\f111";
    font-family: fontawesome;
    position: absolute;
    left: 5.5px;
    top: 4px;
    font-size: 8px;
    color: #b1b3b7;
}

.ui-slider-vertical {
    width: 5px !important;
}

.ui-slider-vertical .ui-slider-handle {
    left: -0.5em  !important;
}

.ui-slider .ui-slider-handle {
    cursor: default;
    height: 1.3em;
    position: absolute;
    width: 1.3em;
    z-index: 2;
}

.bound-s {
    width: 90px;
    margin-bottom: 15px;
}

/*
-----------------
*/

.ion-list div {
    margin-bottom: 30px;
    display: inline-block;
    width: 100%;
}


.m-b-less {
    margin-bottom: 0;
}

.breadcrumb.bg-less {
    padding: 0;
}
.bg-less {
    background: none;
}

/**/

.sales-chart {
    display: inline-block;
    text-align: center;
    width: 100%;
    height: 215px;
}



/* star rating */
.rating {
    unicode-bidi: bidi-override;
    direction: rtl;
}
.rating span.star,
.rating span.star {
    font-family: FontAwesome;
    font-weight: normal;
    font-style: normal;
    display: inline-block;
    font-size: 22px;
}
.rating span.star:hover,
.rating span.star:hover {
    cursor: pointer;
}
.rating span.star:before,
.rating span.star:before {
    content: "\f006";
    padding-right: 5px;
    color: #BEC3C7;
}
.rating span.star:hover:before,
.rating span.star:hover:before,
.rating span.star:hover ~ span.star:before,
.rating span.star:hover ~ span.star:before {
    content: "\f005";
    color: #986cbc;
}


/*addon btn*/

.addon-btn {

}

.addon-btn.btn-sm i {
    width: 30px;
    height: 30px;
    margin: -6px -10px;
    margin-right: 10px;
    line-height: 30px;
}

.addon-btn.btn-sm i.pull-right {
    margin-right: -11px;
    margin-left: 10px;
}


.addon-btn i.pull-right {
    margin-right: -13px;
    margin-left: 12px;
}

.addon-btn.btn-lg i.pull-right {
    margin-right: -17px;
    margin-left: 15px;
}

.addon-btn.btn-lg i {
    width: 50px;
    height: 45px;
    margin: -10px -16px;
    margin-right: 15px;
    line-height: 45px;
}

.addon-btn i {
    float: left;
    width: 35px;
    height: 35px;
    line-height: 35px;
    margin: -6px -12px;
    margin-right: 10px;
    text-align: center;
    background-color: rgba(0,0,0,0.1);
    border-radius: 2px 0 0 2px;
}

.addon-btn i.pull-right {
    border-radius: 0 2px 2px 0;
}

.addon-btn.btn-default i {
    background-color: transparent;
    border-right: 1px solid #c6cbcf;
}

.addon-btn.btn-default i.pull-right {
    background-color: transparent;
    border-left: 1px solid #c6cbcf;
}



/*---------------
    profile
--------------*/

.profile-hero {
    position: relative;
    background: url("../img/profile-banner.jpg") no-repeat;
    background-size: cover;
    width: 100%;
    height: 359px;
}

.profile-intro {
    text-align: center;
    padding: 40px 0;
    color: #fff;
    text-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
}

.profile-intro img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
}

.profile-intro h1 {
    font-size: 34px;
    font-weight: normal;
    margin: 20px 0 5px 0;
}

.profile-intro span {
    font-size: 14px;

}

.profile-intro .s-n {
    margin-top: 15px;
}

.profile-intro .s-n a {
    display: inline-block;
    margin: 0 10px;
    color: #fff;
    font-size: 16px;
}

.profile-intro .s-n a:hover, .p-list li a:hover {
    color:#3bc781;
}

.profile-follow, .profile-value-info {
    position: absolute;
    bottom: 20px;
    color: #fff;
}


.profile-follow  {
    left: 20px;
}


.profile-value-info {
    right: 20px;
}

.profile-value-info .info {
    color: #fff;
    display: inline-block;
    margin-left:40px ;
    text-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
}

.profile-value-info .info span {
    display: block;
    font-size: 24px;
}

.profile-desk {
    border-collapse: collapse;
    border-spacing: 0;
    display: table;
    table-layout: fixed;
    width: 100%;
    /*min-height: 600px;*/

}

.profile-desk .p-short-info {
    width: 30%;
    background: #fff;
}
.profile-desk aside {
    display: table-cell;
    float: none;
    /*height: 100%;*/
    padding: 20px;
    vertical-align: top;
}

.profile-desk .p-aside {
    width: 70%;
    background: #f3f3f3;
}


.profile-info {
    border:1px solid #e9e9e9
}

.profile-info textarea, .profile-info textarea:focus{
    border: none;
    font-size: 14px;
    box-shadow: none;
}

.profile-info .panel-footer {
    background-color:#f9f9f9 ;
    border-top: none;
}

.profile-info .panel-footer ul li a {
    color: #adadad;
}

.profile-info .panel-footer .btn {
    margin-top: 4px;
}

.profile-timeline ul {
    list-style: none;
    padding: 0;
}

.profile-timeline ul li {
    padding: 15px 0;
    border-top: 1px solid #e6e5e5;
    display: inline-block;
    width: 100%;

}

.profile-timeline ul li .avatar {
    width: 30px;
    float: left;
    margin-right: 10px;
}

.profile-timeline ul li .avatar img{
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: inline-block;
}

.profile-timeline ul li .avatar-desk {
    float: left;
    width: 90%;
}

.profile-timeline ul li .avatar-desk span {
    display: block;
    color: #c3c3c3;
    margin-bottom: 15px;
}

.profile-timeline ul li .avatar-desk .gallery a {
    display: inline-block;
    margin-right: 10px;
}

.title {
    border-bottom: 1px solid #efefef;
    margin-bottom:20px;
    padding-bottom: 10px;
    display: inline-block;
    width: 100%;
}

.title h1 {
    font-size: 20px;
    margin: 0;
    font-weight: 300;
    color: #474748;
}

.team-m img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.team-m a {
    position: relative;
    width: 50px;
    height: 50px;
    margin: 0 16px 16px 0;
    display: inline-block;
}

.team-m a .dot.online {
    background: #5cc691;
}

.team-m a .dot.offline {
    background: #e6e6e6;
}

.team-m a .dot.busy {
    background: #ff6a6a;
}

.team-m a .dot.away {
    background: #ffd200;
}

.team-m a .dot {
    width: 12px;
    height: 12px;
    display: inline-block;
    position: absolute;
    background: #e6e6e6;
    border-radius: 50%;
    top: 0;
    right: 3px;
    left: auto;
    border: 2px solid #fff;
}

.widget {
    margin-bottom: 30px;
}

.widget p, .widget a.v-all  {
    color: #9e9e9e;
}

.bio-row {
    width: 100%;
    float: left;
}

.bio-row p span {
    width: 100px;
    display: inline-block;
    color: #333;
}

.p-list {
    list-style: none;
    padding:0;
}

.p-list li a {
    color:#999999;
    margin-bottom: 20px;
    display: block;
}

.p-list li a i {
    padding-right: 5px;
}

.work-progress .states {
    width: 100%;
}

.twt-feed {
    background: #f3f3f3;
    padding: 20px;
    text-align: center;
    position: relative;
}
.twt-feed:after {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    border-right: 5px solid #fff;
    border-bottom: 45px solid #fff;
    border-left: 45px solid #27baff;
    border-top: 6px solid #27baff;
    transform: rotate(-180deg);
    -ms-transform: rotate(-180deg);
    -webkit-transform: rotate(-180deg);
}

.twt-feed:before {
    content: "\f099";
    font-family: fontawesome;
    left: 25px;
    position: absolute;
    top: 25px;
    z-index: 100;
    font-size: 18px;
    color: #fff;
}

.twt-feed img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 5px solid #fff;
}

.twt-feed h2, .twt-feed h2 a {
    font-size: 22px;
    text-transform: uppercase;
    color: #333;
}

.twt-feed a {
    color: #27baff;
}

/*------------------------------
        invoice
-------------------------------*/

.invoice {
    margin-bottom: 20px;
    display: inline-block;
    width: 100%;
}

.invoice h1 {
    color: #d5d5d5;
    font-size: 48px;
    text-transform: uppercase;
    font-family: 'Abel', sans-serif;
}

.total-purchase {
    font-size: 16px;
    font-weight: bold;
    color: #2b2b2c;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.amount {
    background: #656565;
    color: #fff;
    font-size: 48px;
    font-family: 'Abel', sans-serif;
    padding: 30px;
}

.inv-info  span {
    padding-right: 20px;
}


/*------------------------------
        widget
-------------------------------*/

.state-alt.state-overview .value {
    border: none;
}

.state-alt .symbol span {
    width: 60px;
    height: 60px;
    line-height: 60px;
    text-align: center;
    border-radius: 50%;
    display: inline-block;
}

.state-alt .symbol span i {
    width: 60px;
    height: 60px;
    line-height: 60px;
    color: #fff;
}

.state-alt .symbol {
    padding: 25px 15px;
}

.state-alt .value {
    margin-top: 30px;
}

.state-alt .value h1{
    font-size: 24px;
    color: #2b2b2c;
    font-weight: 400;
}

.state-alt .value p{
    color: #a4a4a4;
}

.y-border {
    border-left: 2px solid #ffd200;
}

.g-border {
    border-left: 2px solid #53d192;
}

.p-border {
    border-left: 2px solid #9c78cd;
}

.b-border {
    border-left: 2px solid #6BD3F3;
}

/* widget profile */

.user-head img{
    width: 100%;
    height: auto;
}

.user-desk {
    text-align: center;
}

.user-desk {
    position: relative;
}

.user-desk .avatar  {
    position: absolute;
    top: -80px;
    left: 50%;
    margin-left: -57px;
}


.user-desk .avatar img {
    width: 115px;
    height: 115px;
    border-radius: 50%;
}

.user-desk h4 {
    margin-top: 60px;
    margin-bottom: 3px;
    font-weight: bold;
    letter-spacing: 2px;
}

.user-desk span {
    font-size: 13px;
    color: #b7b7b7;
}

.user-desk .s-n {
    margin-top: 10px;
}

.user-desk .s-n a {
    color: #c9c9c9;
    margin: 0 5px;
    font-size: 16px;
}
.user-desk .s-n a:hover {
    color: #53d293;
}

.user-p-list {
    padding: 0;
    margin: 20px 0;
    list-style: none;
}

.user-p-list li a {
    background: #f3f3f3;
    padding: 10px;
    display: block;
    width: 80%;
    margin: 0 auto 5px;
    color: #2e2e2f;
    border-radius: 3px;
}
.user-p-list li a:hover, .user-p-list li.active  a{
    background: #53d293;
    color: #fff;
}

/*w-tabs*/

.w-tabs .panel-body, .w-tabs .nav-tabs.nav-justified > li > a,
.w-tabs .nav-tabs.nav-justified > .active > a,
.w-tabs .nav-tabs.nav-justified > .active > a:hover,
.w-tabs .nav-tabs.nav-justified > .active > a:focus{
    border: none;
}

.w-tabs .nav-tabs.nav-justified > li > a {
    padding: 15px;
    background: #454545;
    color: #fff;
}

.w-tabs .nav-tabs.nav-justified > .active > a,
.w-tabs .nav-tabs.nav-justified > .active > a:hover,
.w-tabs .nav-tabs.nav-justified > .active > a:focus {
    background: #53d293;
}

.w-foot:hover {
    background: #dd5e45;
}

.w-tabs .nav-tabs.nav-justified > li > a i {
    font-size: 20px;
}

.p-s-info .panel-body {
    padding: 30px 20px;
}

.s-l {
    margin-top: 10px;
}

.p-s-info .media-body a {
    color: #989898;
    text-decoration: underline;

    display: inline-block;
}

.p-s-info .media-body .s-l i {
    padding-right: 5px;
    float: left;
    margin-top: 4px;
    color: #bbbbbb;
}

.p-s-info .media-body .space-i i {
    padding-right: 5px;
    color: #bbbbbb;
}

.p-s-info .media-body .space-i span {
    margin-right: 15px;
}

.light-bg {
    background: #fff !important;
}

.twt-feed.light-bg:after {
    border-right: 5px solid #f3f3f3;
    border-bottom: 45px solid #f3f3f3;
}

.page-view-value.wht-color, .w-foot a {
    color: #fff !important;
}

.w-setting .team-list.chat-list-side {
    margin: 0 -15px 0px -15px !important;
}

.w-setting .team-list li .inline {
    width: 88% !important;
}

.w-login {
    color: #a1b1c2;
    text-decoration: underline;
}

.w-foot  {
    color: #fff;
    background: #454545;
    border-radius: 0;
    border: none;
    text-align: center;
    padding: 20px;
}

.w-foot:hover {
    cursor: pointer;
}

.w-pad {
    padding: 10px;
}

.weather-wallpaper img, .k-avatar img {
    width: 100%;
    height: auto;
}

.weather-wallpaper {
    position: relative;
}

.w-location {
    position: absolute;
    top: 30px;
    color: #fff;
    width: 100%;
    text-align: center;
}

.w-location i {
    display: block;
    font-size: 70px;
    line-height: 80px;
}

.w-location span {
    font-size: 18px;
    margin-top: -15px;
    display: inline-block;
}

.w-location .degree:after {
    content: "o";
    position: relative;
    top: -12px;
    font-size: 14px;
}

.weather-list {
    padding: 0;
    list-style: none;
}

.weather-list li {
    width: 24%;
    text-align: center;
    display: inline-block;
    color: #989898;
}

.weather-list li.active {
    color: #333;
}

.weather-list li h5 {
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
}

.weather-list li i {
    font-size: 25px;
}


.weather-list .degree:after {
    content: "o";
    position: relative;
    top: -8px;
    font-size: 12px;
    color:#989898 ;
}

.w-p-view li{
    padding: 0;
}

.carousel-inner .item .media {
    padding: 0 30px;
}

.news-c .carousel-indicators {
    display: none;
}

.carousel.news-c  {
    padding: 45px 15px;
}

.news-c .carousel-inner {
    margin-bottom: 0;
}

.n-comments {
    vertical-align: middle;
}

.n-comments span {
    display: block;
}

.n-comments strong {
    font-size: 30px;
}

.news-c .media-body {
    border-right: 1px solid #e5e5e5;
    padding-right: 20px;
    width: 80%;
}

.w-pie-chart {
    margin: 0 auto 20px;
}

.w-info {
    color:#9ea6ab
}

.w-info h3 {
    font-size: 18px;
}

.w-info p {
    font-size: 13px;
}

.k-item {
    font-size: 32px;
    font-style: italic;
    color: #c6c6c6;
    font-weight: 300;
}

.k-info {
    margin: 40px 0;
}

.k-info h2{
    font-size: 26px;
}

.k-info p{
    color: #9e9e9e;
}

.btn-dark {
    background: #454545;
    color: #fff;
}

.btn-dark:hover {
    background: #000000;
    color: #fff;
}

.s-p-info .avatar img {
    width: 130px;
    height: 130px;
}

.s-p-info h2 {
    font-size: 18px;
    color: #454545;
    font-weight: bold;
    letter-spacing: 2px;
    margin-bottom: 5px;
}

.s-p-info p {
    color: #a4a4a4;
}

.social-btn {
    margin-top: 50px;
}

.social-btn a {
    width: 65px;
    height: 55px;
    line-height: 55px;
    font-size: 18px;
    color: #fff;
    text-align: center;
    display: inline-block;
    border-radius: 3px;
    margin: 0 5px;
}

.social-btn a.fb {
    background: #4b6cb6;
}

.social-btn a.twt {
    background: #59c2e6;
}

.social-btn a.drb {
    background: #ec4989;

}


.fav-list .media-left img {
    width: 40px;
    height: 40px;
}

.media.fav-list {
    margin-bottom: 20px;
}

.media.fav-list:last-child {
    margin-bottom: 0;
}

.fav-list .media-heading {
    font-size: 16px;
    text-transform: none;
}

.w-m-list {
    padding: 0;
    list-style: none;
    margin-bottom: 0;
}

.w-m-list li i {
    color: #bbbbbb;
    padding-right: 10px;
}

.w-m-list li i:after {
    content: '|';
    padding-left: 10px;
}

.w-m-list li  {
    margin-bottom: 10px;
    padding:5px ;
}

.w-m-list li:hover  {
    background: #8f67b1;
    color: #fff;
}

.w-m-list li:hover i, .w-m-list li:hover .text-muted {
    color: #fff;
}

.black-bg {
    background: #32323a;
}




/*--------------------
    Data Table
---------------------*/

.tbl-head{
    padding: 20px;
    padding-bottom: 0px;
    text-align: right
}
.tbl-top{
    padding: 20px;
    border-bottom: #ccc 1px solid;
}

.table.dataTable.no-footer{
    border-bottom: #ccc 1px solid;
}

.data-table.table > thead > tr > th, .data-table.table > tbody > tr > th, .data-table.table > tfoot > tr > th, .data-table.table > thead > tr > td, .data-table.table > tbody > tr > td, .data-table.table > tfoot > tr > td{
    border-bottom: #ccc 0px solid;
}
.tbl-footer{
    padding: 0px 20px;
}
.tbl-info{
    margin-top: 20px;
}

.tbl-info-large{
    padding: 0px 20px 20px 0px;
}

td.details-control {
    background: url('../img/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('../img/details_close.png') no-repeat center center;

}

.dataTables_wrapper .ColVis_Button, ul.ColVis_collection, ul.ColVis_collection li, ul.ColVis_collection li:hover {
    box-shadow: none;
    border-radius: 2px;
    border-color: #ddd;
    outline: none;
    background: -webkit-linear-gradient(top, #fff 0%, #fff 89%, #fff 100%);
    background: -moz-linear-gradient(top, #fff 0%, #fff 89%, #fff 100%);
    background: -ms-linear-gradient(top, #fff 0%, #fff 89%, #fff 100%);
    background: -o-linear-gradient(top, #fff 0%, #fff 89%, #fff 100%);
    background: linear-gradient(top, #fff 0%, #fff 89%, #fff 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='##fff',GradientType=0 );
}

ul.ColVis_collection li:hover {
    background: #efefef;
}

.dataTables_wrapper button.ColVis_Button {
    height: auto;
    padding: 10px 15px;
}

.dataTables_wrapper.no-footer .dataTables_scrollBody {
    border-bottom: 1px solid #ddd;
}


/*---------------
    form
----------------*/

.form-control:focus {
    box-shadow: none;
}

.input-group-btn > .btn {
    position: relative;
    background: #eee;
    border-radius: 0;
    border: 1px solid #dfdfdf;
}


.radio-box, .check-box {
    margin-bottom: 10px;
}

.radio-box input, .check-box input,
.checkbox-inline input{
    margin-right: 10px;
}

.radio-inline, .checkbox-inline {
    padding-left: 0;
}

.btn:focus, .btn:active:focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn.active.focus {
    outline: none;
}

.input-group-addon {
    border: 1px solid #dfdfdf;
    border-radius: 0px;
}

.input-group-lg > .form-control, .input-group-lg > .input-group-addon, .input-group-lg > .input-group-btn > .btn,
.input-group-sm > .form-control, .input-group-sm > .input-group-addon, .input-group-sm > .input-group-btn > .btn{
    border-radius: 0px;
}

.sm-input {
    width: 175px;
}


.form-horizontal.tasi-form .form-group, .s-row {
    border-bottom: 1px solid #eff2f7;
    padding-bottom: 15px;
    margin-bottom: 15px;
}

.form-horizontal.tasi-form .form-group:last-child {
    border-bottom: none;
    padding-bottom: 0px;
    margin-bottom: 0px;
}


.form-horizontal.tasi-form .form-group .help-block {
    margin-bottom: 0;
}


.round-input {
    border-radius: 500px;
    -webkit-border-radius: 500px;
}


.form-horizontal.tasi-form .checkbox-inline > input {
    margin-top: 1px;
    border:none;
}

.iconic-input {
    position: relative;
}

.iconic-input i {
    color: #CCCCCC;
    display: block;
    font-size: 15px;
    height: 16px;
    margin: 10px 5px 8px 10px;
    position: absolute;
    text-align: center;
    width: 16px;
}

.iconic-input input {
    padding-left: 30px !important;
}

.iconic-input.right input {
    padding-left: 10px !important;
    padding-right: 30px !important;
}

.iconic-input.right i {
    float: right;
    right: 5px;
}

input.spinner[type="text"], input.spinner[type="password"], input.spinner[type="datetime"], input.spinner[type="datetime-local"], input.spinner[type="date"], input.spinner[type="month"], input.spinner[type="time"], input.spinner[type="week"], input.spinner[type="number"], input.spinner[type="email"], input.spinner[type="url"], input.spinner[type="search"], input.spinner[type="tel"], input.spinner[type="color"] {
    background: url("../img/spinner.gif") right no-repeat !important;
}


.has-success .form-control:focus,
.has-warning .form-control:focus,
.has-error .form-control:focus {
    box-shadow: none;
}


/*-------------------
    ion slider
-------------------*/


.ion-list div {
    margin-bottom: 30px;
    display: inline-block;
    width: 100%;
}



/*------------------------------
        nestable
-------------------------------*/

.dd-handle, .dd3-content {
    height: 40px;
    padding: 10px;
    color: #333;
    font-weight: normal;
    border: 1px solid #dfdfdf;
    background: #fff;
    border-radius: 3px;
}

.dd-item > button {
    height: 30px;
    outline: none;
}

.dd3-content {
    padding-left: 50px;
}

.dd3-handle {
    width: 40px;
}

.dd3-item > button {
    margin-left: 40px;
}

.dd3-handle:before {
    top: 6px;
    color: #333;
    font-size: 30px;
}

.dd3-content:hover, .dd-handle:hover {
    color: #333;
    background: #f8f8f8;
}

.dd3-handle:hover {
    background: #404040;
    border: 1px solid #404040;
}

.dd3-handle:hover:before {
    color: #fff;
}


.dd-handle.dd3-handle {
    border-radius: 3px 0 0 3px;
}

.s-animated {
    -webkit-animation-duration: 1s;
    animation-duration: 1s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
}



/*------------------
    timeline
-------------------*/


.time-line-wrapper {
    border-collapse: collapse;
    border-spacing: 0;
    display: table;
    position: relative;
    table-layout: fixed;
    width: 100%;
}

.time-line-caption {
    display: table-caption;
    text-align: center;
}

.time-line-wrapper:before {
    background-color: #d1d1d1;
    bottom: 5px;
    content: "";
    left: 50%;
    position: absolute;
    top: 25px;
    width: 1px;
    z-index: 0;
}

h3.time-line-title {
    margin: 0;
    color: #333;
    font-size: 16px;
    font-weight: bold;
    margin:0 0 20px 0;
    text-transform: uppercase;
    height: 40px;
}

.time-line-row:before, .time-line-row.alt:after {
    content: "";
    display: block;
    width: 50%;
}

.time-line-row {
    display: table-row;
}

.time-line-info .title {
    margin-bottom: 15px;
}

.time-line-info {
    display: table-cell;
    vertical-align: top;
    width: 50%;
}

.time-line-info h1 {
    font-size: 16px;
    font-weight: bold;
    margin: 0;
}

.time-line-info .panel {
    display: block;
    margin-left: 25px;
    position: relative;
    text-align: left;
    background: #fff;
}

.time-line-row .time-line-info .arrow {
    border-bottom: 8px solid transparent;
    border-top: 8px solid transparent;
    display: block;
    height: 0;
    left: -7px;
    position: absolute;
    top: 13px;
    width: 0;
}
.time-line-row .time-line-info .arrow {
    border-right: 8px solid #fff !important;
}

.time-line-row.alt .time-line-info .arrow-alt {
    border-bottom: 8px solid transparent;
    border-top: 8px solid transparent;
    display: block;
    height: 0;
    right: -7px;
    position: absolute;
    top: 13px;
    width: 0;
    left: auto;
}

.time-line-row.alt .time-line-info .arrow-alt {
    border-left: 8px solid #fff !important;
}

.time-line-wrapper .time-line-ico-box {
    left: -30px;
    position: absolute;
    top: 15px;
}

.time-line-wrapper .time-line-ico-box {
    background: #C7CBD6;
    box-shadow: 0 0 0 5px #f3f3f3;
}

.time-line-info span a {
    text-transform: uppercase;
}

.time-line-info h1.red, .time-line-info span a.red {
    color: #EF6F66;
}

.time-line-info h1.green, .time-line-info span a.green  {
    color: #39B6AE;
}
.time-line-info h1.blue, .time-line-info span a.blue {
    color: #56C9F5;
}
.time-line-info h1.purple, .time-line-info span a.purple {
    color: #8074C6;
}
.time-line-info h1.light-green, .time-line-info span a.light-green {
    color: #A8D76F;
}

.time-line-wrapper .time-line-ico-box.red,
.time-line-wrapper .time-line-subject.red{
    background: #fa6f6a;
    color: #fff;
}

.time-line-wrapper .time-line-ico-box.green,
.time-line-wrapper .time-line-subject.green{
    background: #5bc690;
    color: #fff;
}

.time-line-wrapper .time-line-ico-box.blue,
.time-line-wrapper .time-line-subject.blue{
    background: #69c2fe;
    color: #fff;
}

.time-line-wrapper .time-line-ico-box.purple,
.time-line-wrapper .time-line-subject.purple{
    background: #a978d1;
    color: #fff;
}

.time-line-wrapper .time-line-ico-box.yellow,
.time-line-wrapper .time-line-subject.yellow{
    background: #ffd200;
    color: #fff;
}

.time-line-wrapper .time-line-ico-box.gray,
.time-line-wrapper .time-line-subject.gray{
    background: #9a9a9a;
    color: #fff;
}

.time-line-wrapper .time-line-ico-box {
    border: 0px solid #FFFFFF;
    border-radius: 50%;
    -webkit-border-radius: 50%;
    display: block;
    height: 12px;
    width: 12px;
    z-index: 100;
}

.time-line-row.alt .time-line-ico-box {
    left: auto;
    right: -32px;
}

.time-line-wrapper .time-icon:before {
    font-size: 16px;
    margin-top: 5px;
}
.time-line-wrapper .time-line-subject {
    /*left: -174px;*/
    left: -324px;
    position: absolute;
    text-align: right;
    top: 0px;
    /*width: 150px;*/
    width: 301px;
    background: #fff;
    padding: 10px 20px;
    border-radius: 5px 0 0 5px;
    word-wrap: break-word;
}

.time-line-wrapper .time-line-subject i {
    margin-top: 4px;
    padding-right: 10px;
}

.time-line-info h5 span {
    color: #999999;
    display: block;
    font-size: 12px;
    margin-bottom: 4px;
}


.time-line-row.alt:before {
    display: none;
}
.time-line-row:before, .time-line-row.alt:after {
    content: "";
    display: block;
    width: 50%;
}

.time-line-info p {
    font-size: 13px;
    margin-bottom: 20px;
}

.time-line-info p:last-child{
    margin-bottom: 0;
}

.time-line-info .panel {
    margin-bottom: 30px;
}

.time-line-info .album {
    margin-top: 20px;
}

.time-line-info .album a {
    margin-top: 5px;
    margin-left: 5px;
    float: left;
}

.time-line-info .notification {
    background: none repeat scroll 0 0 #FFFFFF;
    margin-top: 20px;
    padding: 8px;
}


.time-line-row.alt .panel {
    margin-left: 0;
    margin-right: 25px;
    text-align: right;
}

.time-line-row.alt .time-line-subject {
    left: auto;
    /*right: -175px;*/
    right: -328px;
    text-align: left;
    border-radius: 0 5px 5px 0;
}

.panel-timeline {
    position: relative;
}

.fb-timeliner {
    position: absolute;
    left: 0;
    top: 0;
    z-index: 10;
}

.fb-timeliner ul {
    margin: 0px;
    list-style: none;
    padding: 0;

}

.fb-timeliner ul li {
    margin-bottom: 3px;
}

.fb-timeliner ul li a{
    color: #9a9a9a;
    border-left: 4px solid #d9d9d9;
    padding-left:10px;
    padding-top: 3px;
    padding-bottom: 3px;
    display: block;
}

.fb-timeliner ul li a:hover{
    color: #999797;
    border-left: 4px solid #4a4a51;
    padding-left:10px;
}

.fb-timeliner ul li.active a{
    color: #4a4a51;
    border-left: 4px solid #4a4a51;
    padding-left:10px;
}


/*-------------------
    summernote
-------------------*/

.note-editor .note-toolbar {
    background-color: #f3f3f3;
    border-bottom: 1px solid #dfdfdf;
    margin: 0;
}

.note-editor {
    position: relative;
    border: 1px solid #dfdfdf;
}

.note-editor .note-statusbar {
    background-color: #fff;
}

.note-editor .note-statusbar .note-resizebar {
    height: 15px;
    border-top: 1px solid #dfdfdf;
    padding-top: 3px;
}

.note-popover .popover .popover-content, .note-toolbar {
    padding: 5px 0 10px 5px;
}



/*------------------
    form validation
------------------*/

.cmxform .form-group label.error {
    display: inline-block;
    margin: 8px 0;
    color: #e55957;
    font-weight: 400;
    white-space: nowrap;
}

.cmxform .form-group .chk-fv label.error  {
    margin-left: 30px !important;
    display: inline-block;
    margin: 0;
}

.m-t-less-6 {
    margin-top: -6px;
}

/*------------------
    form wizard
------------------*/

.wizard > .content {
    background: #fff;
}

.wizard > .content > .body {
    padding:0px;
}

.wizard > .content > .body ul > li {
    display: block;
}

.wizard > .steps .number {
    font-size: 13px;
    text-align: center;
    background: #ccc;
    color: #323232;
    width: 30px;
    height: 30px;
    display: inline-block;
    line-height: 30px;
    border-radius: 50%;
    margin-right: 10px;
}

.wizard > .steps .disabled a, .wizard > .steps .disabled a:hover, .wizard > .steps .disabled a:active {
    background: #e8e8e8;
    color: #323232;
    cursor: default;
}

.wizard > .steps a, .wizard > .steps a:hover, .wizard > .steps a:active, .wizard > .content {
    border-radius: 2px;
}

.wizard > .steps .current a,
.wizard > .steps .current a:hover,
.wizard > .steps .current a:active {
    background: #53D192;
}


.wizard > .steps .current a .number,
.wizard > .steps .current a:hover .number,
.wizard > .steps .current a:active .number{
    background: #fff;
    color: #53D192;
}

.wizard > .steps .done a, .wizard > .steps .done a:hover, .wizard > .steps .done a:active {
    background: #989898;
    /*color: #323232;*/
}

.wizard > .content > .body label.error {
    margin-left: 0;
    color: #e55957;
}

.wizard > .actions {
    margin-bottom: 30px;
}

.wizard > .actions a, .wizard > .actions a:hover, .wizard > .actions a:active {
    background: #53D192;
    color: #fff;
    border-radius: 2px;
}
.wizard > .actions .disabled a, .wizard > .actions .disabled a:hover, .wizard > .actions .disabled a:active {
    background: #e2e2e2;
    color: #323232;
}

.wizard > .content > .body label {
    display: inline-block;
    margin-top: 10px;
}

.wizard > .content > .body ul > li {
    display: block;
    line-height: 30px;
}



/*---------------
    profile
--------------*/

.profile-hero {
    position: relative;
    background: url("../img/profile-banner.jpg") no-repeat;
    background-size: cover;
    width: 100%;
    height: 359px;
}

.profile-intro {
    text-align: center;
    padding: 40px 0;
    color: #fff;
    text-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
}

.profile-intro img {
    width: 70px;
    height: 70px;
    border-radius: 50%;
}

.profile-intro h1 {
    font-size: 34px;
    font-weight: normal;
    margin: 20px 0 5px 0;
}

.profile-intro span {
    font-size: 14px;

}

.profile-intro .s-n {
    margin-top: 15px;
}

.profile-intro .s-n a {
    display: inline-block;
    margin: 0 10px;
    color: #fff;
    font-size: 16px;
}

.profile-intro .s-n a:hover, .p-list li a:hover {
    color:#3bc781;
}

.profile-follow, .profile-value-info {
    position: absolute;
    bottom: 20px;
    color: #fff;
}


.profile-follow  {
    left: 20px;
}


.profile-value-info {
    right: 20px;
}

.profile-value-info .info {
    color: #fff;
    display: inline-block;
    margin-left:40px ;
    text-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
}

.profile-value-info .info span {
    display: block;
    font-size: 24px;
}

.profile-desk {
    border-collapse: collapse;
    border-spacing: 0;
    display: table;
    table-layout: fixed;
    width: 100%;
    /*min-height: 600px;*/

}

.profile-desk .p-short-info {
    width: 30%;
    background: #fff;
}
.profile-desk aside {
    display: table-cell;
    float: none;
    /*height: 100%;*/
    padding: 20px;
    vertical-align: top;
}

.profile-desk .p-aside {
    width: 70%;
    background: #f3f3f3;
}


.profile-info {
    border:1px solid #e9e9e9;
    min-height: 120px;
}

.profile-info textarea, .profile-info textarea:focus{
    border: none;
    font-size: 14px;
    box-shadow: none;
}

.profile-info .panel-footer {
    background-color:#f9f9f9 ;
    border-top: none;
}

.profile-info .panel-footer ul li a {
    color: #adadad;
}

.profile-info .panel-footer .btn {
    margin-top: 4px;
}

.profile-timeline ul {
    list-style: none;
    padding: 0;
}

.profile-timeline ul li {
    padding: 15px 0;
    border-top: 1px solid #e6e5e5;
    display: inline-block;
    width: 100%;

}

.profile-timeline ul li .avatar {
    width: 30px;
    float: left;
    margin-right: 10px;
}

.profile-timeline ul li .avatar img{
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: inline-block;
}

.profile-timeline ul li .avatar-desk {
    float: left;
    width: 90%;
}

.profile-timeline ul li .avatar-desk span {
    display: block;
    color: #c3c3c3;
    margin-bottom: 15px;
}

.profile-timeline ul li .avatar-desk .gallery a {
    display: inline-block;
    margin-right: 10px;
    margin-bottom: 10px;
}

.title {
    border-bottom: 1px solid #efefef;
    margin-bottom:20px;
    padding-bottom: 10px;
    display: inline-block;
    width: 100%;
}

.title h1 {
    font-size: 20px;
    margin: 0;
    font-weight: 300;
    color: #474748;
}

.team-m img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
}

.team-m a {
    position: relative;
    width: 50px;
    height: 50px;
    margin: 0 16px 16px 0;
    display: inline-block;
}

.team-m a .dot.online {
    background: #5cc691;
}

.team-m a .dot.offline {
    background: #e6e6e6;
}

.team-m a .dot.busy {
    background: #ff6a6a;
}

.team-m a .dot.away {
    background: #ffd200;
}

.team-m a .dot {
    width: 12px;
    height: 12px;
    display: inline-block;
    position: absolute;
    background: #e6e6e6;
    border-radius: 50%;
    top: 0;
    right: 3px;
    left: auto;
    border: 2px solid #fff;
}

.widget {
    margin-bottom: 30px;
}

.widget p, .widget a.v-all  {
    color: #9e9e9e;
}

.bio-row {
    width: 100%;
    float: left;
}

.bio-row p span {
    width: 100px;
    display: inline-block;
    color: #333;
}

.p-list {
    list-style: none;
    padding:0;
}

.p-list li a {
    color:#999999;
    margin-bottom: 20px;
    display: block;
}

.p-list li a i {
    padding-right: 5px;
}

.work-progress .states {
    width: 100%;
}

.twt-feed {
    background: #f3f3f3;
    padding: 20px;
    text-align: center;
    position: relative;
}
.twt-feed:after {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    border-right: 5px solid #fff;
    border-bottom: 45px solid #fff;
    border-left: 45px solid #27baff;
    border-top: 6px solid #27baff;
    transform: rotate(-180deg);
    -ms-transform: rotate(-180deg);
    -webkit-transform: rotate(-180deg);
}

.twt-feed:before {
    content: "\f099";
    font-family: fontawesome;
    left: 25px;
    position: absolute;
    top: 25px;
    z-index: 100;
    font-size: 18px;
    color: #fff;
}

.twt-feed img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 5px solid #fff;
}

.twt-feed h2, .twt-feed h2 a {
    font-size: 22px;
    text-transform: uppercase;
    color: #333;
}

.twt-feed a {
    color: #27baff;
}


/*--------------
      map
---------------*/

.gmaps {
    height: 310px;
    width: 100%;
}

.map-search .form-group, .map-search .form-group input {
    width: 100%;
}

.vmap-space {
    width: 100%;
    height: 350px;
}



/*--------------------
        calendar
---------------------*/

.has-toolbar.fc {
    margin-top: 50px;
}

.fc-header-title {
    display: inline-block;
    margin-top: -50px;
    vertical-align: top;
}

.fc-view {
    margin-top: -50px;
    overflow: hidden;
    width: 100%;
}

.fc-header-left .fc-button-today .fc-button-inner {
    background: #f2f2f2 !important;
    border-color: #f2f2f2;
    border-style: none solid;
    color: #8B8B8B;
}

.fc-header-left .fc-button-today {
    border-radius:2px !important;
}

.fc-state-default, .fc-state-default .fc-button-inner {
    background: #f2f2f2 !important;
    border-color: #f2f2f2;
    border-style: none solid;
    color: #c2c2c2;
}

.fc-header-right .fc-state-default .fc-button-inner,
.fc-header-left .fc-state-default:hover .fc-button-inner{
    background: #53D192 !important;
    border-color: #53D192;
    border-style: none solid;
    color: #fff;
}

.fc-header-right .fc-state-default .fc-button-inner:hover,
.fc-header-right .fc-state-active  .fc-button-inner{
    background: #2f9f67 !important;
    border-color: #2f9f67;
    border-style: none solid;
    color: #fff;
}


.fc-header .fc-button {
    margin-right: 1px;
}

.fc-event-skin {
    background-color: #5fc6e6 !important;
    border-color: #5fc6e6 !important;
    color: #FFFFFF !important;
}

.fc-grid th {
    height: 30px;
    line-height: 30px;
    text-align: center;
    background: #f6f6f6 !important;
}

.fc-header-title h2 {
    font-size: 20px !important;
    color: #404047;
    font-weight: normal;
    margin-top: 8px;
}

.fc-widget-header, .fc-widget-content {
    border-color: #ebebeb !important;
    color:#a3a3a3 !important;
    font-weight: normal;
}

.external-event {
    cursor: move;
    display: inline-block !important;
    margin-bottom: 6px !important;
    margin-right: 6px !important;
    padding: 8px 15px;
    border-radius: 0;
    font-size: 12px;
    font-weight: normal;
    font-family: 'Source Sans Pro', sans-serif;
}

#external-events p input[type="checkbox"]{
    margin: 0;
}

.drg-event-title {
    font-weight: 300;
    margin-top: 0;
    margin-bottom: 20px;
}

.fc-content .fc-event {
    border-radius:0px;
    padding: 4px 6px;
}

.fc-corner-left {
    border-radius: 2px 0 0 2px;
    -webkit-border-radius: 2px 0 0 2px;
}

.fc-corner-right {
    border-radius: 0 2px 2px 0;
    -webkit-border-radius: 0 2px 2px 0;
}

.drp-rmv {
    padding-top: 10px;
    margin-top: 10px;
}


/*-------------------------------
        slick carousel
--------------------------------*/


.slick-carousal {
    background: url("../img/news_image.jpg") no-repeat;
    padding: 20px 10px;
    color: #fff;
    position: relative;
    width: 100%;
    height:278px;
    background-size: cover;
}

.overlay-c-bg {
    background: rgba(68,68,68,.9);
    width: 100%;
    height: 278px;
    position: absolute;
    left: 0;
    top: 0;
}

.slick-carousal h1 {
    text-align: center;
    font-size: 14px;
    margin: 40px 20px;
    line-height: 20px;
    font-weight: normal;
    font-style: italic;
}

.slick-carousal h3, .slick-carousal .date {
    text-align: center;
    font-size: 12px;
    margin: 5px;
    font-weight: normal;
    text-transform: uppercase;
}

.slick-carousal .date {
    display: block;
    margin: 0;
}

a.view-all {
    color: #fff;
    border:1px solid rgba(255,255,255,0.20);
    padding: 5px 15px;
    text-align: center;
    border-radius: 25px;
    -webkit-border-radius: 25px;
    margin-bottom: 18px;
    display: inline-block;
    text-transform: uppercase;
    font-size: 12px;
    margin-top: 20px;
}

a.view-all:hover {
    background: rgba(255,255,255,0.20);
    color: #000;
}


.slick-carousal #owl-demo .item img{
    display: block;
    width: 100%;
    height: auto;
}

.slick-carousal .owl-buttons {
    position: absolute;
    top: 50%;
    margin-top: -8px;
    width: 100%;

}

.slick-carousal .owl-carousel .owl-item {
    overflow: hidden;
}

.slick-carousal .owl-prev, .owl-next {
    position: absolute;
}

.slick-carousal .owl-next {
    right: 0;
}

.slick-carousal .owl-buttons .owl-prev {
    text-indent: -9999px;
    background: url("../img/left-arrow.png") no-repeat;
    width: 16px;
    height: 16px;
    display: inline-block;
}

.slick-carousal .owl-buttons .owl-next {
    text-indent: -9999px;
    background: url("../img/right-arrow.png") no-repeat;
    width: 16px;
    height: 16px;
    display: inline-block;
}

/*----------------------
    different theme layout
-----------------------*/

.d-theme img{
    width: 100%;
    height: auto;
    border: 1px solid #D9D9D9;
}


/*----------------------
    gallery
-----------------------*/

.gal-tools a {
    color: #555;
    margin-left: 20px;
}

.gal-tools a:hover {
    color: #53d192;
}

.gal-tools a i {
    padding-right: 5px;
}

.gal-upload .file-caption {
    display: none;
}


.gallery {
    margin: 0 0 0 -20px;
    padding: 0;
}

.gallery li{
    display: inline-block;
    width: 100%;
    margin: 0 0 20px 21px;
}

.gallery li img{
    width: 25%;
    margin: 0px 15px 15px 0px;
    float: left;
}

/*=== MY CSS ===*/
.nopadleft { padding-left: 0px !important; }
.nopadtop { padding-top: 0px !important; }
.nopadright{padding-right: 0;}
/* SIDE BAR CSS */
.logo a { font-size: inherit; }

/* ADD USER PAGE */
.form-control { border-radius: 5px; }
.sub-btn { margin-top: 20px; }

/* USER PROFILE */
.user-profile .form-group p { font-size: 17px; margin-bottom: 20px; }
.user-profile .form-group p span { display: inline-block; width: 140px; }

#upload_error   { display: none; z-index: 99999999; }
#upload_error .toast-top-right  { top: 70px !important; }

#upload_warning   { display: none; z-index: 99999999; }
#upload_warning .toast-top-right  { top: 70px !important; }

#upload_success   { display: none; z-index: 99999999; }
#upload_success .toast-top-right  { top: 70px !important; }


/*DOCUMENT PAGE*/
.status-panel span.switchery { margin-top: 15px; }

.notification-menu .project-drop { padding:10px;  }
.notification-menu .project-drop li { border-bottom: 1px solid #ccc; padding-top:10px; }
.addendum_bid_id    { display: none; }

/*
 *  STYLE 2
 */

#style-2::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 0 rgba(0,0,0,0.0);
    border-radius: 0px;
    background-color: transparent;
}

#style-2::-webkit-scrollbar
{
    width: 5px;
    background-color: transparent;


}

#style-2::-webkit-scrollbar-thumb
{
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 0px rgba(0,0,0,.0);
    background-color: #7cd8a9;
}

pre
{
    width: 95%;
}
.scroll-pane
{
    width: 100%;
    height: 700px;
    overflow: auto;
}
.horizontal-only
{
    height: auto;
    max-height: 700px;
}



.document_folder_list   { list-style: outside none none; padding: 0;  }
.document_folder_list i { margin-right: 5px; color: #333; }
.document_folder_list a { color: #333; }
.document_folder_list ul    { padding-left: 30px; display: none; }
.document_folder_list ul li { list-style: none;  }

.tab-parent { clear: both; }
.dataTables_wrapper .dt-buttons {float: left;margin: 15px 10px 15px;}
.dataTables_wrapper .dt-buttons .dt-button { color: #fff; background: #5cc691; border-radius: 3px; padding: 5px 12px; margin-right: 10px; }

.dataTables_filter {float: right;margin:15px 15px 0px;}
#add_gallery_grid_wrapper .dataTables_filter {float: right;margin:0 0 20px;}
.dataTables_filter input[type=search]{ border-radius: 3px; border:1px solid #ccc; margin-left:10px;  }
.dataTables_wrapper .dataTables_info { float: right; }
.dataTables_wrapper .dataTables_paginate { float: right; clear: both; }
/*.dataTables_wrapper .paginate_button { color: #333; border: 1px solid #333; border-radius: 3px; padding: 1px 6px; margin:5px 10px 0 0; display: inline-block; }
.dataTables_wrapper .paginate_button.disabled { background:#666; color:#fff; opacity: 0.1; }
.dataTables_wrapper .paginate_button.disabled:hover { cursor: not-allowed; background:  }
.dataTables_wrapper .paginate_button.current { background: #333; color: #fff; }*/

.dataTables_wrapper .dataTables_paginate {
  float: right;
  text-align: right;
  padding-top: 0.25em;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
  box-sizing: border-box;
  display: inline-block;
  min-width: 1.5em;
  padding: 0.1em 0.5em;
  margin-left: 2px;
  text-align: center;
  text-decoration: none !important;
  cursor: pointer;
  *
  cursor: hand;
  color: #333333 !important;
  border: 1px solid transparent;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
  color: #333333 !important;
  border: 1px solid #cacaca;
  background-color: white;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, white), color-stop(100%, gainsboro));*/
  /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top, white 0%, gainsboro 100%);
  /* Chrome10+,Safari5.1+ */
   background: -moz-linear-gradient(top, white 0%, gainsboro 100%);
  /* FF3.6+ */
   background: -ms-linear-gradient(top, white 0%, gainsboro 100%);
  /* IE10+ */
   background: -o-linear-gradient(top, white 0%, gainsboro 100%);
  /* Opera 11.10+ */
   background: linear-gradient(to bottom, white 0%, gainsboro 100%);
  /* W3C */
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
  cursor: default;
  color: #666 !important;
  border: 1px solid transparent;
  background: transparent;
  box-shadow: none;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  color: white !important;
  border: 1px solid #111111;
  background-color: #585858;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111111));
  /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top, #585858 0%, #111111 100%);
  /* Chrome10+,Safari5.1+ */
  background: -moz-linear-gradient(top, #585858 0%, #111111 100%);
  /* FF3.6+ */
  background: -ms-linear-gradient(top, #585858 0%, #111111 100%);
  /* IE10+ */
  background: -o-linear-gradient(top, #585858 0%, #111111 100%);
  /* Opera 11.10+ */
  background: linear-gradient(to bottom, #585858 0%, #111111 100%);
  /* W3C */
}
.dataTables_wrapper .dataTables_paginate .paginate_button:active {
  outline: none;
  background-color: #2b2b2b;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #2b2b2b), color-stop(100%, #0c0c0c));
  /* Chrome,Safari4+ */
  background: -webkit-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
  /* Chrome10+,Safari5.1+ */
  background: -moz-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
  /* FF3.6+ */
  background: -ms-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
  /* IE10+ */
  background: -o-linear-gradient(top, #2b2b2b 0%, #0c0c0c 100%);
  /* Opera 11.10+ */
  background: linear-gradient(to bottom, #2b2b2b 0%, #0c0c0c 100%);
  /* W3C */
  box-shadow: inset 0 0 3px #111;
}

table.dataTable thead .sorting,
table.dataTable thead .sorting_asc,
table.dataTable thead .sorting_desc {
    cursor: pointer;
}

table.dataTable thead .sorting,
table.dataTable thead .sorting_asc,
table.dataTable thead .sorting_desc,
table.dataTable thead .sorting_asc_disabled,
table.dataTable thead .sorting_desc_disabled {
    background-repeat: no-repeat;
    background-position: center right
}

table.dataTable thead .sorting {
    background-image: url("../img/sort_both.png")
}

table.dataTable thead .sorting_asc {
    background-image: url("../img/sort_asc.png")
}

table.dataTable thead .sorting_desc {
    background-image: url("../img/sort_desc.png")
}

table.dataTable thead .sorting_asc_disabled {
    background-image: url("../img/sort_asc_disabled.png")
}

table.dataTable thead .sorting_desc_disabled {
    background-image: url("../img/sort_desc_disabled.png")
}

table.dataTable tbody tr {
    background-color: #ffffff
}

table.dataTable tbody tr.selected {
    background-color: #B0BED9
}

table.dataTable tbody th,
table.dataTable tbody td {
    padding: 8px 10px;
}

table.dataTable th,
table.dataTable td {
    white-space: nowrap;
}

table.dataTable.row-border tbody th,
table.dataTable.row-border tbody td,
table.dataTable.display tbody th,
table.dataTable.display tbody td {
    border-top: 1px solid #ddd
}

table.dataTable.row-border tbody tr:first-child th,
table.dataTable.row-border tbody tr:first-child td,
table.dataTable.display tbody tr:first-child th,
table.dataTable.display tbody tr:first-child td {
    border-top: none
}

table.dataTable.cell-border tbody th,
table.dataTable.cell-border tbody td {
    border-top: 1px solid #ddd;
    border-right: 1px solid #ddd
}

table.dataTable.cell-border tbody tr th:first-child,
table.dataTable.cell-border tbody tr td:first-child {
    border-left: 1px solid #ddd
}

table.dataTable.cell-border tbody tr:first-child th,
table.dataTable.cell-border tbody tr:first-child td {
    border-top: none
}

table.dataTable.stripe tbody tr.odd,
table.dataTable.display tbody tr.odd {
    background-color: #f9f9f9
}

table.dataTable.stripe tbody tr.odd.selected,
table.dataTable.display tbody tr.odd.selected {
    background-color: #acbad4
}

table.dataTable.hover tbody tr:hover,
table.dataTable.display tbody tr:hover {
    background-color: #f6f6f6
}

table.dataTable.hover tbody tr:hover.selected,
table.dataTable.display tbody tr:hover.selected {
    background-color: #aab7d1
}

table.dataTable.order-column tbody tr>.sorting_1,
table.dataTable.order-column tbody tr>.sorting_2,
table.dataTable.order-column tbody tr>.sorting_3,
table.dataTable.display tbody tr>.sorting_1,
table.dataTable.display tbody tr>.sorting_2,
table.dataTable.display tbody tr>.sorting_3 {
    background-color: #fafafa
}

table.dataTable.order-column tbody tr.selected>.sorting_1,
table.dataTable.order-column tbody tr.selected>.sorting_2,
table.dataTable.order-column tbody tr.selected>.sorting_3,
table.dataTable.display tbody tr.selected>.sorting_1,
table.dataTable.display tbody tr.selected>.sorting_2,
table.dataTable.display tbody tr.selected>.sorting_3 {
    background-color: #acbad5
}

table.dataTable.display tbody tr.odd>.sorting_1,
table.dataTable.order-column.stripe tbody tr.odd>.sorting_1 {
    background-color: #f1f1f1
}

table.dataTable.display tbody tr.odd>.sorting_2,
table.dataTable.order-column.stripe tbody tr.odd>.sorting_2 {
    background-color: #f3f3f3
}

table.dataTable.display tbody tr.odd>.sorting_3,
table.dataTable.order-column.stripe tbody tr.odd>.sorting_3 {
    background-color: whitesmoke
}

table.dataTable.display tbody tr.odd.selected>.sorting_1,
table.dataTable.order-column.stripe tbody tr.odd.selected>.sorting_1 {
    background-color: #a6b4cd
}

table.dataTable.display tbody tr.odd.selected>.sorting_2,
table.dataTable.order-column.stripe tbody tr.odd.selected>.sorting_2 {
    background-color: #a8b5cf
}

table.dataTable.display tbody tr.odd.selected>.sorting_3,
table.dataTable.order-column.stripe tbody tr.odd.selected>.sorting_3 {
    background-color: #a9b7d1
}

table.dataTable.display tbody tr.even>.sorting_1,
table.dataTable.order-column.stripe tbody tr.even>.sorting_1 {
    background-color: #fafafa
}

table.dataTable.display tbody tr.even>.sorting_2,
table.dataTable.order-column.stripe tbody tr.even>.sorting_2 {
    background-color: #fcfcfc
}

table.dataTable.display tbody tr.even>.sorting_3,
table.dataTable.order-column.stripe tbody tr.even>.sorting_3 {
    background-color: #fefefe
}

table.dataTable.display tbody tr.even.selected>.sorting_1,
table.dataTable.order-column.stripe tbody tr.even.selected>.sorting_1 {
    background-color: #acbad5
}

table.dataTable.display tbody tr.even.selected>.sorting_2,
table.dataTable.order-column.stripe tbody tr.even.selected>.sorting_2 {
    background-color: #aebcd6
}

table.dataTable.display tbody tr.even.selected>.sorting_3,
table.dataTable.order-column.stripe tbody tr.even.selected>.sorting_3 {
    background-color: #afbdd8
}

table.dataTable.display tbody tr:hover>.sorting_1,
table.dataTable.order-column.hover tbody tr:hover>.sorting_1 {
    background-color: #eaeaea
}

table.dataTable.display tbody tr:hover>.sorting_2,
table.dataTable.order-column.hover tbody tr:hover>.sorting_2 {
    background-color: #ececec
}

table.dataTable.display tbody tr:hover>.sorting_3,
table.dataTable.order-column.hover tbody tr:hover>.sorting_3 {
    background-color: #efefef
}

table.dataTable.display tbody tr:hover.selected>.sorting_1,
table.dataTable.order-column.hover tbody tr:hover.selected>.sorting_1 {
    background-color: #a2aec7
}

table.dataTable.display tbody tr:hover.selected>.sorting_2,
table.dataTable.order-column.hover tbody tr:hover.selected>.sorting_2 {
    background-color: #a3b0c9
}

table.dataTable.display tbody tr:hover.selected>.sorting_3,
table.dataTable.order-column.hover tbody tr:hover.selected>.sorting_3 {
    background-color: #a5b2cb
}

.left { float: left !important; }
.right { float: right !important; }
.no-mar { margin:0px !important; }
.no-pad { padding:0px !important; }

.progress-sm {height:17px; position: relative; text-align: center;}
.progress-sm .sr-only {position: absolute;margin: auto;height: 20px;width: 90px;z-index: 999;color: #000;left: 0;top: 0;right: 0; clip:inherit; }

.dz-preview { position: relative; }
.dz-preview .remove_file_drop {background: url('../img/cross-icon.png') no-repeat;width: 24px;height: 24px;position: absolute;right: -5px;top: -5px;content: "";z-index: 999; color: transparent;}
#alert_message { z-index: 100000; }
#add_gallery_list li { width: 100% !important; margin: 0 0 20px 21px; list-style: disc; display: inline-grid !important; }

.table > tbody > tr > td { vertical-align: middle !important; }
.data-table .progress-sm { margin:0px !important; }


.page-head {  }
.page-head h3 {/* float: left; */margin: 0;display: inline;vertical-align: -webkit-baseline-middle;/* text-transform: capitalize;*/}
.page-head .state-information { float: right;/*width: 200px;*/ }
.project-head .progress-sm { margin:8px 20px 0; }

.project-table { overflow-x: scroll; }
.project-table table { width: 100%; }
.project-table .progress-sm { margin:0px; }
.project-table .table > tbody > tr > td { padding: 15px 8px; }

.survy-head .progress-sm { margin:5px 0 0; }
#view_users_table > tbody > tr > td a { margin:0 3px; }

/* TEST RESULT PAGES */
.mt-6 { margin-top: 6px; }

/*      Uzair Styles      */

.loading_data{position: absolute;margin:auto;left:0;right:0;top:0;bottom:0;z-index: 999999; background: rgba(255,255,255,0.9);height:100%;}
.view-users tr td:last-child{width: 15%;}
.view-firms tr td:last-child{width: 5%;}
.btn-info, .input-group-btn>.btn.btn-info{  background-color: #66b78e; border-color: #58a07c;  color: #FFFFFF;}
.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .open .dropdown-toggle.btn-info, .input-group-btn>.btn.btn-info{ background-color: #5eab84; border-color: #58a07c; color: #FFFFFF;}
.mt-15 { margin-top: 15px; }

table.view-contacts tr td:last-child{width: 25%;}
/*table.view-contacts td:nth-child(odd){background: #efefef;}*/
table.add-contacts tr td:last-child{width: 25%;}
/*table.add-contacts td:nth-child(odd){background: #efefef;}*/
/*table.custom-grid tr td:last-child{width: 15%;}*/
table.custom-grid tr:nth-child(odd){background: #efefef;}
table.custom-grid th{background: rgba(183, 181, 181, 0.3);}
table.custom-grid {border-collapse: inherit;/*border-spacing: 1px 1px;*/}


#project_location { /*display: inline-block !important;*/ z-index: 9999 !important; position: relative !important; left: 0px !important; top: -50px !important; }

/* labor-comp-summry */
.left { float: left !important; }
.right { float: right !important; }
.labor-comp-summry .checkbox-custom { margin: 0px; }
.labor-comp-summry .checkbox-custom label:before, .radio-custom label:before { margin: 0px; }
.map-wrapper{position: relative;display: block;width: 100%;margin:0 auto;overflow: hidden;padding-top: 100px;}


/* MEETNG CSS */
.meeting-sheet h4 { background: #ccc; color: #000; border: 1px solid #000; font-size: 20px; font-weight: bold; max-width: 400px; margin:20px auto; padding: 5px 0; }
.meeting-sheet p { font-size: 16px; }
.meeting-sheet p span { font-weight: bold; margin-right: 20px; }
.meeting-sheet table { margin-top: 30px; }
/* PDF VIEW CSS*/
.pdf-logo { border-bottom: 1px solid #000; padding-bottom: 20px; }
.pdf-view h2 { font-size: 20px; font-weight: bold; }
.pdf-view h2 span { display: block; }
.pdf-view .pdf-head { border-bottom: 1px solid #000; padding-bottom: 20px; }
.pdf-view ul { margin:0px; padding: 0px; }
.pdf-view .point-list.cmp-name ul { margin-top:0px;  }
.pdf-view .point-list.cmp-name ul li:first-child { list-style:disc; }
.pdf-view .point-list.cmp-name ul li { margin-left: 15px; }
.pdf-view .pdf-head ul li { font-size: 16px; font-weight: bold; list-style: none; }
.pdf-view h3 { font-size: 20px; }
.point-list { border-bottom: 1px solid #000; padding-bottom:20px; }
.point-list ul { margin-top: 35px; }
.point-list ul li h4 { font-weight: bold; }
.point-list ul li { margin-left: 35px; font-size: 16px; margin-bottom: 7px; }
.point-list ul li:first-child { list-style: none; margin-left: 0px; }
/*  PICTURE VIDEO CSS  */
#add_gallery_grid   {margin:0 0 0 0px;padding:0;}
#add_gallery_grid td{padding: 15px 15px 0 15px;margin:0 0 2px 0px;width:100%;background: #fff;}
#add_gallery_grid td:nth-child(even){background: #f7f7f7;}
#add_gallery_grid td img{width: 200px; margin: 0px 15px 15px 0px; float: left;box-shadow: 0px 1px 5px #888888;-webkit-box-shadow: 0px 1px 5px #888888;height: 140px; border: solid 2px #999;}

.gallery-pic-vid{margin:0 0 0 0px;padding:0;}
.gallery-pic-vid li{padding: 15px 15px 0 15px;margin:0 0 2px 0px;width:100%;background: #fff;}
.gallery-pic-vid li:nth-child(even){background: #f7f7f7;}
.gallery-pic-vid  li img{width: 25%; margin: 0px 15px 15px 0px; float: left;box-shadow: 0px 1px 5px #888888;-webkit-box-shadow: 0px 1px 5px #888888;height: 140px; border: solid 2px #999;}
.desc{padding-right:12px;color:#616060;}
.takenby{padding-right:27px;color:#616060;}
.pic-name{color:#616060;}

.addnew-submittal-btn{float:right;}
.title-submittallog{float: left;margin:20px 0 0 0;}
.clearfix:before,
.clearfix:after {
  content: "";
  display: table;
}

.clearfix:after {
  clear: both;
}

.clearfix {
  zoom: 1; /* ie 6/7 */
}
.capitalize{text-transform: uppercase;}
.font-15{font-size: 15px;}
.font-19{font-size: 19px;}

.list-notices li{width: 100%;clear: both;}
.inline-block{display: inline-block;vertical-align: middle;}
.list-notices li .big-field{min-width: 163px;}
.list-notices li .small-field{min-width: 133px;}
.list-notices .lebel-md{padding-left: 15px;}
.topspace-bigfield{margin-top: 15px;}
.list-notices .day{width:10%;}
.list-notices .year{width:7%;}
.form-date{width:85%;}
.form-by{width:90%;}
.print-name{margin-left: 18px;}
.print-name-title{margin-left: 23.5%;}
.proofdec-field{width: 50%;}
.deliver-field-a{width: 40%}
.deliver-field-b{width: 68%}
.deliver-field-c{width: 24%;}
.deliver-field-d{width: 9%;}
.deliver-field-e{width: 18%;}
ul.lower-alpha {list-style-type: none;padding:0 ;margin:0;}
.list-a-checkbox{width: 13%;margin-left: 5%;}
.square-box-pdf{width: 100%;border: solid 1px #000;height: 275px;display:block;}
.title-contry{display: inline; font-size: 25px;font-weight: bold;}
.country-name{width: 75%;}
.pdf-inputfield{border-bottom: solid 1px #000;border-top: none;border-left: 0;border-right: 0;height: 23px;padding-left: 0;padding-right: 0;}
.pdf-field-w-values .fielda{width: 398px;height: 23px;}
.pdf-field-w-values .fieldb{width: 52px;height: 23px;}
.pdf-field-w-values .fieldc{width: 338px;height: 23px;}
.pdf-field-w-values .fieldd{width: 218px;height: 23px;}
.pdf-field-w-values .field1p8{width: 158px;}
.sticky-header .logo img{max-width: 150px;}

.progress-parent { border:1px solid #e0e0e0; padding: 15px; }
.table-projects-progress { list-style-type: none;width:100%; padding: 0px; }
.table-projects-progress li{float:left;width: 100%;clear: both;margin:0 0 1rem 0;}
.table-projects-progress li .project-col{float: left;width: 25%;}
/*.table-projects-progress li .project-col a{color:#000;}*/
.table-projects-progress li .progress-col{float: right;width: 65%;}
.table-projects-progress li .proj-amt{color: #000;}
.table-projects-progress li .proj-amt a{display:block; width:100%; color:#000;}
.table-projects-progress li .proj-amt a:hover{background:none;}

.status-parent { padding: 0px; margin:20px 0; }
.status-parent li { color: #333; list-style:none; font-size: 15px; display: inline-block; margin: 0 10px;}
.status-parent li span { width: 10px; height: 10px; border-radius: 50%; display: inline-block; margin-right: 10px; }

.progject-carousel .news-c .media-body { border-right: 0; }
.submital-blocks .panel { background: #ededed; }

.dataTables_length { width: 50%; float: left; margin:0 0 20px }
.post-info { max-height: 335px; overflow-y: scroll; }
.team-member.pro-members .call-info { margin:40px 0; }
.project-notification .notification-menu { max-height: 487px; overflow-y: scroll; }
.modal-footer { text-align: center !important; }
.confrm-pop .modal-content { padding: 20px; }
.form-control[readonly] { background-color: #fff !important;; }
/*.project-sidebar { max-height: 809px; overflow-x: hidden; overflow-y: scroll; }*/

.pro-dash-table { max-height: 270px; overflow-x: hidden;; overflow-y: scroll; }
.green { background: #53d192; color: #fff; }

.btn[disabled] { background: #66b78e !important; opacity: 1 !important; cursor: no-drop !important; pointer-events: auto !important; }
.btn[disabled]:hover { cursor: no-drop !important; }


.loading-submit{display:block;margin:0;}
.loading-submit span {
  font-size: 50px;
  -webkit-animation-name: blink;
          animation-name: blink;
  -webkit-animation-duration: 1.4s;
          animation-duration: 1.4s;
  -webkit-animation-iteration-count: infinite;
          animation-iteration-count: infinite;
  -webkit-animation-fill-mode: both;
          animation-fill-mode: both;
}

.loading-submit span:nth-child(2) {
  -webkit-animation-delay: .2s;
          animation-delay: .2s;
}

.loading-submit span:nth-child(3) {
  -webkit-animation-delay: .4s;
          animation-delay: .4s;
}

@-webkit-keyframes blink {
  0% {
    opacity: .2;
  }
  20% {
    opacity: 1;
  }
  100% {
    opacity: .2;
  }
}

@keyframes blink {
  0% {
    opacity: .2;
  }
  20% {
    opacity: 1;
  }
  100% {
    opacity: .2;
  }
}
.side-navigation > li.menu-list-sub > a span{display: inline-block;width: 80%;vertical-align: middle;}
.side-navigation > li > ul li.menu-list-sub.nav-active > a:after {
    content: "\f107";
    display: inline-block;
    font-family: "FontAwesome";
    padding-right: 20px;
    position: absolute;
    right: 0;
}
.side-navigation .child-list > li.menu-list-sub > a:after {
    content: "\f105";
    display: inline-block;
    font-family: "FontAwesome";
    padding-right: 20px;
    position: absolute;
    right: 0;
}
.icon-filter{ background:url('../img/filter.png') no-repeat center center; }

.btn { vertical-align: top; }
.sidebar-collapsed ul.child-list li.menu-list-sub > ul.child-list{left:290px; position: absolute; top: auto; min-width: 350px; margin-top: -40px;display: none;}
.sidebar-collapsed ul.child-list li.menu-list-sub:hover ul.child-list{display: block;}
.sidebar-collapsed ul.child-list li.menu-list-sub > ul.child-list li a{position: relative;top: 0;display: inline-block;}
.sidebar-collapsed ul.child-list li.menu-list-sub > ul.child-list li a span{position: relative;padding: 0;left: inherit;top: inherit;min-width: inherit;}
.sidebar-collapsed .side-navigation li.menu-list-sub  li a span{min-width: inherit;}
.sidebar-collapsed ul.child-list li.menu-list-sub > ul.child-list li{display: inline-block;}
.sidebar-collapsed ul.child-list li.menu-list-sub{position: static;min-width: 290px;}
.sidebar-collapsed .side-navigation li.menu-list-sub span{z-index: 0;}

.sidebar-collapsed ul.child-list{padding-bottom: 10px;}

.sidebar-collapsed .side-navigation li.nav-hover a span{min-width: 289px;}

.sidebar-collapsed .side-navigation li.nav-hover .child-list li a span{min-width: 238px;}

@media (max-width: 320px) {
  .addnew-submittal-btn{float:none;display: block;margin:0 auto;text-align: center;}
  .page-head .state-information{float: none;margin-left: auto; margin-right: auto;display: block;}
  .title-submittallog{display: block;float: none;margin:0 auto; }
  .list-notices .topspace{margin-top:0;}
  #all_user_project{width: 300px;}
  .table-projects-progress li .project-col{float: none;width: 100%;}
  .table-projects-progress li .progress-col{float: none;width: 100%;}
  .dataTables_filter{float: none;width: 100%;}
}
@media (max-width: 768px){
    .list-notices .lebel-md{padding-left: 0;}
    .list-notices .day{width:15%;}
    .list-notices .year{width:15%;}
    .table-projects-progress li .project-col{float: none;width: 100%;}
    .table-projects-progress li .progress-col{float: none;width: 100%;}
}
@media (min-width: 768px) and (max-width: 992px) {
    .topspace{margin-top:15px;}
}


.loading_data_file      { text-align: center; position: fixed; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; color: #fff; display: block; padding-top: 0; } 




.block {
  text-align: center;
  margin: 0px;
  height: 100%;
  width: 85%;
}
 
.block:before {
  content: '\200B';
/*   content: '';
  margin-left: -0.25em; */
  display: inline-block;
  height: 100%; 
  vertical-align: middle;
 }
 
.centered {
  display: inline-block;
  vertical-align: middle;
  width: 300px;
  padding: 0;
 }
.loading_data_file .loading-text{position: absolute; top: 154px;left: -15%;right: 0; bottom: 0; margin: auto;height: 20px; width: 200px;}
.checkbox-custom.check-success{display: inline-block;margin-top: 0;margin-bottom: 0;}
.picture-video-add .desc-text{display: block;max-width: 667px;white-space: normal;word-wrap: break-word;}
.picture_video_single img{width: 100%;}
.project_name   { padding-bottom: 5px; display: inline-block !important; font-size: 18px !important; font-weight: 500 !important; border-bottom: 1px solid #333; margin-bottom: 5px !important; }
.error-wrapper .icon-500{
   background: url("{{URL::asset('/img/404.png')}}") no-repeat;
   width: 331px;
   height: 219px;
   display: inline-block;
}

.body-500 .error-wrapper h2 {
   margin: -5px 0 30px -50px;
   width: 300px;
}   
        
  .error-wrapper a.back-btn {
    color: #fff;
}
style.css:2898
.error-wrapper p, .error-wrapper a {
    font-size: 18px;
}
style.css:110
a {
    /* color: #91918E; */
}
bootstrap.min.css:5
a {
    color: #337ab7;
    text-decoration: none;
}
bootstrap.min.css:5
a {
    background-color: transparent;
}
bootstrap.min.css:5
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
user agent stylesheet
a:-webkit-any-link {
    color: -webkit-link;
    cursor: pointer;
    text-decoration: underline;
}
Inherited from section.error-wrapper
style.css:2857
.error-wrapper {
    text-align: center;
    margin-top: 10%;
}
Inherited from body.sticky-header
style.css:91
body {
    font-family: 'Source Sans Pro', sans-serif;
    color: #323232;
    line-height: 20px;
    overflow-x: hidden;
    font-size: 14px;
    font-weight: 400;
    -rendering: optimizeLegibility;
    -webkit-font-smoothing: antialiased;
    -moz-font-smoothing: antialiased;
    position: relative;
}
bootstrap.min.css:5
body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #fff;
}

Inherited from html
bootstrap.min.css:5
html {
    font-size: 10px;
    -webkit-tap-highlight-color: rgba(0,0,0,0);
}      
    </style>
    
</head>
<body class="sticky-header">

    <section>
    

        <body class="body-500" style="background-color:#323232;">

<div class="container">

    <section class="error-wrapper">
        <i class="icon-404"></i>
        <div class="text-center">
            <h2 class="purple-bg">Access Denied</h2>
        </div>
        <p>You don't have permission to view this page, please contact your system administrator to request access</p>
        <a href="{{ url('/') }}" class="back-btn" style="text-decoration:  none;">Back to Home</a>
    </section>

</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</body>
</html>
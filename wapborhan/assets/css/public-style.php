<?php
include '../../include/config.php';
header("Content-Type: text/css; charset=utf-8");
?>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;1,700&display=swap');
body {
    background: #F8F9FA;
    padding-top: 70px;
    font-family: "Open Sans", serif;
}
.widget-desk:last-child {
    border: none;
}
.widget-desz{
    position:relative;
}
.widget-desk {
    border-bottom: 1px solid #888;
    margin-bottom: 15px;
    position:relative;
}

h2.post-title:before {
    position: absolute;
    content: ">>";
    left: 0;
}
/*.col-sm-3{
    background-color: red;
}*/
#footer{
    padding: 10px;
    background-color: #211f22;
    text-align: center;
    color: #ffffff;
    font-weight: bold;
    border-bottom: 5px solid #26C24A;
}
.index-post {
    <!-- margin: 0 0 15px; -->
    box-sizing: border-box;
    background-color: #fff;
    <!-- padding: 15px; -->
    <!-- border: 1px solid #ebebeb; -->
    box-shadow: 0 0 5px 0 rgba(0,0,0,0.03);
}
.blog-postd {
    position: relative;
    padding: 50px 20px 20px 20px;
}
.blog-post {
    display: block;
    overflow: hidden;
    word-wrap: break-word;
}
.index-post .post-image-wrap {
    <!-- float: left; -->
    width: 240px;
    height: 150px;
    <!-- margin: 0 20px 0 0; -->
}
.post-image-wrap {
    position: relative;
    display: block;
}
.post-thumb {
    display: block;
    position: relative;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
    transition: opacity .17s ease;
    border: 0;
    transition: opacity .35s ease,transform .35s ease;
}
.post-thumb:hover{
    transform: scale(1.05);
}
.popular-post-thumb{
    transition: opacity .35s ease,transform .35s ease;
}
.popular-post-thumb:hover{
    transform: scale(1.05);
}
.index-post .post-info {
    overflow: hidden;
}
.index-post .post-title {
    font-size: 20px;
    font-weight: bold;
    line-height: 1.4em;
    text-decoration: none;
    margin: 0 30px 10px;
}
.post-meta {
    display: block;
    overflow: hidden;
    color: #aaaaaa;
    font-size: 13px;
    font-weight: 400;
    line-height: 18px;
    padding: 0 1px;
}
.post-meta .post-author, .post-meta .post-date {
    float: left;
    margin: 0 10px 0 0;
}
.post-snippet {
    position: relative;
    display: block;
    overflow: hidden;
    font-size: 12px;
    line-height: 1.6em;
    font-weight: 400;
    margin: 10px 0 0;
}
.post-title a{
    text-decoration: none;
}
.post-title a:hover{
    color: #2FA3DB;
    text-decoration: none;
}
.widget{
    position: relative;
    overflow: hidden;
    background-color: #fff;
    box-sizing: border-box;
    padding: 0;
    margin: 0 0 30px;
    box-shadow: 0 0 5px 0 rgba(0,0,0,0.03);
}
.widget .widget-title {
    position: relative;
    float: left;
    width: 100%;
    height: 32px;
    margin: 0;
}
.widget .widget-title > h3 {
    display: block;
    height: 32px;
    font-size: 15px;
    color: #fff;
    font-weight: 700;
    line-height: 32px;
    padding: 0 20px;
    margin: 0;
}
.widget-content {
    float: left;
    width: 100%;
    box-sizing: border-box;
    padding: 20px;
    margin: 0;
    border: 1px solid #ebebeb;
    border-top: 0;
}
.post-header {
    float: left;
    width: 100%;
}
h1.post-title {
    font-size: 30px;
    color: #333333;
    line-height: 1.5em;
    font-weight: 800;
    position: relative;
    display: block;
    margin: 0 0 13px;
}
.post-meta .post-author, .post-meta .post-date {
    float: left;
    margin: 0 10px 0 0;
}
.post-body {
    float: left;
    width: 100%;
    overflow: hidden;
    font-size: 14px;
    line-height: 1.6em;
    padding: 25px 0 0;
}
.post-snippet a{
  pointer-events: none;
  cursor: default;
  color: #000000;
}
.post-info p a{
  pointer-events: none;
  cursor: default;
  color: #000000;
}
.post-info p{
  pointer-events: none;
  cursor: default;
  color: #000000;
  font-size: 12px;
  font-weight: normal;
  text-decoration: none!important;
}
.post-over{
    position: relative;
    display: block;
    overflow: hidden;
    font-size: 12px;
    line-height: 1.6em;
    text-decoration: none!important;
    font-weight: 100!important;
    margin: 10px 0 0;
}
.post.over p strong{
    font-weight: 100!important;
}
.post.over p u{
    text-decoration: none!important;
}
#category-list a{
    color: #00000!important;
}

ul .cat-list{
    padding: 3px 0;
    border-bottom: 1px solid #f0f0f0;
}
ul .cat-list a{
    font-size: 15px;
}
ul .cat-list:last-child{
    padding: 3px 0;
    border-bottom: 0;
}
.page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #000000;
    border-color: #000000;
}
.search-match-text{
    font-size: 13px;
}
.list-group li a:before{
    padding: 4px 0;
    content: ' \276F';
    float: left;
    color: #5d3a4d;
    font-weight: 900;
    font-family: 'Font Awesome 5 Free';
    font-size: 8px;
    margin: 2px 3px 0 0;
    transition: color .17s;
}
footer {
    color: #ffffff;
}
.fieldinfo{
    font-weight: bold;
}
input[type=submit]{
    font-weight: bold;
}
.post-comment, .contact-us{
    border-top: 1px dashed #CCCCCC;
    border-bottom: 1px dashed #CCCCCC;
    padding: 10px 0px;
    margin-top: 5px;
}
.widget-content .list-comment{
    border-bottom: 1px dashed #CCCCCC;
    padding: 5px 0px;
}

.comment-meta{
    width: 100px;
    height: 100px;
    text-align: center;
    margin: auto;
}
.comment-meta img{
    width: 70px;
    height: 70px;
    text-align: center;
    margin: auto;
}
footer a{
    color: #ffffff;
}
footer a:hover{
    text-decoration: none;
}
footer .date{
    font-size: 11px;
    color: #ABABAB;
}
footer .col-8{
    text-align: left;
    font-size: 13px;
}
.refresh-button{
    padding: .1rem .5rem!important;
}
/* Buttons */
.social-btns {
    text-align: center;
    padding: 0;
    margin-bottom: 0;
    margin-top: 10px;
}

.social-btns li {
    margin: 5px;
    display: inline-block;
    vertical-align: top;
}


/* Flip Button */
.social-btn-flip {
    display: inline-block;
    -webkit-perspective: 700;
    perspective: 700;
}

.social-btn-flip:hover .social-btn-cube {
    -webkit-transform: rotateY(-90deg);
    transform: rotateY(-90deg);
}

.social-btn-cube {
    width: 40px;
    height: 40px;
    position: relative;
    -webkit-transform-style: preserve-3d;
    transform-style: preserve-3d;
    -webkit-transition: transform 0.4s ease;
    transition: transform 0.4s ease;
    -webkit-transform-origin: 20px 20px -20px;
    transform-origin: 20px 20px -20px;
}

.social-btn-face {
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    color: #fff;
    line-height: 40px;
    text-align: center;
    -webkit-transform-origin: 0;
    transform-origin: 0;
}

.social-btn-face.default {
    -webkit-transform: rotateY(0deg);
    transform: rotateY(0deg);
}

.social-btn-face.active {
    box-shadow: inset 40px 40px 0 rgba(0, 0, 0, 0.1);
    left: 40px;
    -webkit-transform: rotateY(90deg);
    transform: rotateY(90deg);
}

.social-btn-face.twitter {
    background: #4cc4f2;
}

.social-btn-face.facebook {
    background: #3b5998;
}

.social-btn-face.google {
    background: #dd4b39;
}

.social-btn-face.linkedin {
    background: #0077B5;
}

.social-btn-face.instagram {
    background: #9b6954;
}

.social-btn-face.whatsapp {
    background: #3FBB50;
}

.sectionbtn {
    border-bottom: 5px solid #fff;
    position: relative;
}
.readmore{
    cursor: pointer;
    font-weight: bold;
    padding: 6px 10px;
    transition: color 0.15s ease-in-out,
    background-color 0.15s ease-in-out,
    border-color 0.15s ease-in-out,
    box-shadow 0.15s ease-in-out;
}
.readmore a{
    font-weight: bold!important;
}
.readmore:hover{
    background: #fff;
    color: #000000;
}
.col-md-4 .row .col-3{
  max-width: 33%;
}
@media (min-width: 768px) {

    .sectionbtn {
        padding-left: 40px;
        padding-right: 40px;
    }
    .list-comment .row .col-3{
    max-width: 15%;
}
}
@media (min-width: 1100px){
.navbar{
    padding: .7rem 10rem;
}}
@media (max-width: 680px){
.index-post .post-image-wrap,.post-image-link {
    width: 100%;
    height: 180px;
    margin: 0 0 10px;
}}
@media (max-width: 680px){
.index-post .post-info {
    float: left;
    width: 100%;
}
.post-time{
    display: none;
}
}
/* css for theme change */
.post-title a, ul .cat-list a{
    color: #000000;
}
.page-item.active .page-link, .badge-dark, .widget .widget-title > h3 {
    background-color: <?php $site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
    echo $theme = $siteinfo['theme'];
}?>;
}
.page-item.active .page-link {
    border-color: <?php $site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
    echo $theme = $siteinfo['theme'];
}?>;
}/*
.bg-dark {
    background-color: #343a40!important;
}*/
hr {
    margin-top: 0rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgb(220 20 43 / 10%);
    background: #62676b;
}
.btn-outline-secondary:hover {
    color: #fff;
    background-color: <?php $site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
    echo $theme = $siteinfo['theme'];
}?>;
    border-color: <?php $site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
    echo $theme = $siteinfo['theme'];
}?>;
}

.readmore{
    background: <?php $site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
    echo $theme = $siteinfo['theme'];
}?>;
}

.post-title a:hover {
    color: <?php $site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
    echo $theme = $siteinfo['theme'];
}?>;
    text-decoration: none;
}
footer a:hover{
    color: <?php $site_info_result = mysqli_query($conn, "SELECT * FROM site_settings");
while ($siteinfo = mysqli_fetch_assoc($site_info_result)) {
    echo $theme = $siteinfo['theme'];
}?>;
}
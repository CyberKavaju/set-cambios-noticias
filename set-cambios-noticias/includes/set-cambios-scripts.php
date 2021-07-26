<?php

function setcam_add_scripts()
{
  //css
  wp_enqueue_style( 'setcam-main-style', plugins_url() . '/set-cambios-noticias/css/style.css');
  //js
  wp_enqueue_script('setcam-main-script', plugins_url() . '/set-cambios-noticias/js/script.js');
}

add_action( 'wp_enqueue_scripts', 'setcam_add_scripts');

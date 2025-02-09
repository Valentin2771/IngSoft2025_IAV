<?php

function sanitize($string){
    return trim(stripslashes(htmlentities($string)));
}
<?php
    //formatter for slugs ti show like Firstname Lastname
    function convertSlugToName($slug) {
   
    $parts = explode('-', $slug);
    $formattedString = implode(' ', $parts);
    $formattedString = ucwords($formattedString);
    return $formattedString;
}
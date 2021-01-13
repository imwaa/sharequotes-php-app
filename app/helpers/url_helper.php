<?php
//SIMPLE PAGE REDIRECT

function redirect($page)
{
    header('location: ' . URLROOT . '/' . $page);
}

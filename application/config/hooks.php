<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/*

| -------------------------------------------------------------------------

| Hooks

| -------------------------------------------------------------------------

| This file lets you define "hooks" to extend CI without hacking the core

| files.  Please see the user guide for info:

|

|	https://codeigniter.com/user_guide/general/hooks.html

|

*/

/*$hook['post_controller_constructor'] = array(
    "class"    => "Vitels",// any name of class that you want
    "function" => "only_one_login_check",// a method of class
    "filename" => "Vitels.php",// where the class declared
    "filepath" => "hooks"// this is location inside application folder
);
*/

$hook['post_controller_constructor'] = array(
    "class"    => "Vitels",// any name of class that you want
    "function" => "varify_cookies",// a method of class
    "filename" => "Vitels.php",// where the class declared
    "filepath" => "hooks"// this is location inside application folder
);

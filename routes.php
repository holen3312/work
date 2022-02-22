<?php
return [
    '#^exit$#'=>[\Controllers\MainController::class, 'logout'],
    '#^registration$#'=> [\Controllers\RegistrationController::class, 'signUp'],
    '#^upload$#'=>[\Controllers\UploadController::class, 'upload'],
    '#^login$#'=>[\Controllers\MainController::class, 'login'],
    '#^show$#' =>[\Controllers\UploadController::class, 'showFile'],
    '#^edit/(\d+)$#'=>[\Controllers\UploadController::class, 'edit'],
    '#^delete/(\d+)$#'=>[\Controllers\UploadController::class, 'delete' ],
    '#^(.)+$#' => [\Controllers\MainController::class, 'main'],

];
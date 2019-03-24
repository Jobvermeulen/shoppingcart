<?php
//This php file contains all routes that are working for this website

//Index routes
router::set('index', function() {
    router::$found = 1;
    baseController::createView('index');
});

router::set('index.php', function() {
    router::$found = 1;
    baseController::createView('index');
});

router::set('ajax', function() {
    router::$found = 1;
    baseController::createView('ajax');
});

router::set('signUpView', function() {
    router::$found = 1;
    baseController::createView('signUp');
});

router::set('cards', function(){
    router::$found = 1;
    baseController::createView('cards');
});

router::set('logout', function(){
    router::$found=1;
    logoutController::doLogout();
});

router::set('chooseMenu', function(){
    router::$found=1;
    baseController::createView('chooseMenu');
});

router::set('admin', function(){
    router::$found=1;
    baseController::createView('admin');
});

router::set('csvdownload', function(){
    router::$found = 1;
    baseController::createView('csvdownload');
});

router::set('ns_api', function(){
    router::$found=1;
    baseController::createView('ns_api');
});

router::set('wwvergeten', function(){
    router::$found=1;
    baseController::createView('wwvergeten');
});

router::set('newWW', function(){
    router::$found=1;
    baseController::createView('createnewWW');
});

router::set('webhook', function(){
    router::$found=1;
    //payController::verifyPayWebhook();
    $payController = new payController();
    $payController->verifyPayWebhook();
});
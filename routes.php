<?php

use CMW\Controller\faq\FaqController;

require_once('Lang/'.getenv("LOCALE").'.php');

/** @var $router router Main router */

//Public pages
$router->scope('/faq', function ($router){
    $router->get('/', "faq#frontFaqPublic");
});



$router->scope('/cmw-admin/faq', function($router) {
    $router->get('/list', "faq#faqList");

    $router->get('/edit/:id', function($id) {
        (new FaqController)->faqEdit($id);
    })->with('id', '[0-9]+');

    $router->post('/edit/:id', function($id) {
        (new FaqController)->faqEditPost($id);
    })->with('id', '[0-9]+');

    $router->get('/add', "faq#faqAdd");
    $router->post('/add', "faq#faqAddPost");

    $router->post('/delete', "faq#faqDelete");

});

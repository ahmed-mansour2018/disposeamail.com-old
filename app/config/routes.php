<?php
/**
* Default routes
*/
$router->route('page_faq', '/faq')
    ->defaults(array('module' => 'Page', 'action' => 'view', 'page' => 'faq', 'format' => 'html'));

$router->route('module_action', '/<:module>/<:action>(.<:format>)') // :format optional
    ->defaults(array('format' => 'html'));

$router->route('inbox', '/inbox/<:user>(.<:format>)') // :format optional
    ->defaults(array('module' => 'Mail', 'action' => 'index', 'format' => 'html'));

$router->route('default', '/')
    ->defaults(array('module' => 'Page', 'action' => 'view', 'page' => 'home', 'format' => 'html'));

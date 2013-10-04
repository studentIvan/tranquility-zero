<?php
/**
 * Routes configuration
 *
 * string rule => string|array routes
 * if route first symbol is ! - this is controller (!class:method)
 */
return array(
    '/' => array('!common:session', '!site:main', 'homepage'),
    '/login' => array('!common:session', '!site:login'),
    '/logout' => array('!common:session', '!site:logout'),
    '/test' => '!common:test',
);
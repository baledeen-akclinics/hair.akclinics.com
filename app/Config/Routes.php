<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$pageTypes = 'hair-transplant|hair-transplant-cost|hair-treatments|laser-hair-removal';
$locations = 'delhi|bangalore|ludhiana';
/*
 * Primary landing URLs:
 *   /{page-type}/{location}/
 * Also keep legacy SEO paths:
 *   /landing/{page-type}/{location}/
 */
$routes->post('landing/submit-lead', 'Landing::submitLead');
$routes->post('submit-lead', 'Landing::submitLead');

$routes->get("({$pageTypes})/({$locations})", 'Landing::show/$1/$2');
$routes->get("({$pageTypes})/({$locations})/", 'Landing::show/$1/$2');

$routes->get("landing/({$pageTypes})/({$locations})", 'Landing::show/$1/$2');
$routes->get("landing/({$pageTypes})/({$locations})/", 'Landing::show/$1/$2');

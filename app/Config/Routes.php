<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$pageTypes = 'hair-transplant|hair-transplant-cost|hair-transplant-candidacy|hair-transplant-city-cost|hair-transplant-outstation|hair-treatments|laser-hair-removal';
$locations = 'delhi|bangalore|ludhiana';
/*
 * Primary landing URLs:
 *   /{page-type}/{location}/
 * Also keep legacy SEO paths:
 *   /landing/{page-type}/{location}/
 * Nested under hair-transplant:
 *   /landing/hair-transplant/{location}/candidacy
 *   /landing/hair-transplant/{location}/cost
 *   /landing/hair-transplant/{location}/outstation
 */
$routes->post('landing/submit-lead', 'Landing::submitLead');
$routes->post('submit-lead', 'Landing::submitLead');

$routes->get('thank-you', 'Landing::thankYou');
$routes->get('thank-you/', 'Landing::thankYou');
$routes->get('landing/thank-you', 'Landing::thankYou');
$routes->get('landing/thank-you/', 'Landing::thankYou');

$routes->get("landing/hair-transplant/({$locations})/candidacy", 'Landing::show/hair-transplant-candidacy/$1');
$routes->get("landing/hair-transplant/({$locations})/candidacy/", 'Landing::show/hair-transplant-candidacy/$1');
$routes->get("hair-transplant/({$locations})/candidacy", 'Landing::show/hair-transplant-candidacy/$1');
$routes->get("hair-transplant/({$locations})/candidacy/", 'Landing::show/hair-transplant-candidacy/$1');

$routes->get("landing/hair-transplant/({$locations})/cost", 'Landing::show/hair-transplant-city-cost/$1');
$routes->get("landing/hair-transplant/({$locations})/cost/", 'Landing::show/hair-transplant-city-cost/$1');
$routes->get("hair-transplant/({$locations})/cost", 'Landing::show/hair-transplant-city-cost/$1');
$routes->get("hair-transplant/({$locations})/cost/", 'Landing::show/hair-transplant-city-cost/$1');

$routes->get("landing/hair-transplant/({$locations})/outstation", 'Landing::show/hair-transplant-outstation/$1');
$routes->get("landing/hair-transplant/({$locations})/outstation/", 'Landing::show/hair-transplant-outstation/$1');
$routes->get("hair-transplant/({$locations})/outstation", 'Landing::show/hair-transplant-outstation/$1');
$routes->get("hair-transplant/({$locations})/outstation/", 'Landing::show/hair-transplant-outstation/$1');

$routes->get("({$pageTypes})/({$locations})", 'Landing::show/$1/$2');
$routes->get("({$pageTypes})/({$locations})/", 'Landing::show/$1/$2');

$routes->get("landing/({$pageTypes})/({$locations})", 'Landing::show/$1/$2');
$routes->get("landing/({$pageTypes})/({$locations})/", 'Landing::show/$1/$2');

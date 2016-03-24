<?php

require 'vendor/autoload.php';

use Goutte\Client;

$client = new Client();
$crawler = $client->request('GET', 'http://www.iaa.gov.il/en-US/airports/bengurion/Pages/default.aspx');
//print_r($crawler);
$html = $crawler->html();
echo $html;
// Get the latest post in this category and display the titles
//$crawler->filter('table')->each(function ($node) {
//    print $node->text()."\n";
//});
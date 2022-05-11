<?php
// Get Pantheon site metadata
// $req = pantheon_curl('https://api.live.getpantheon.com/sites/self/attributes', null, 8443);
// $meta = json_decode($req['body'], true);
// $title = $meta['label'];
// API URL
$url = 'https://us-central1-kwall-customer-portal.cloudfunctions.net/kwallCloud-pantheonSiteDeployed';
$ch = curl_init($url);
$data = array(
    'siteId' => $_ENV['PANTHEON_SITE'],
    'slug' => $_ENV['PANTHEON_SITE_NAME']
);
$payload = json_encode(array("data" => $data));
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

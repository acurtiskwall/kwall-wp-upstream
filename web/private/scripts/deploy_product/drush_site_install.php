<?php

$env = $_ENV['PANTHEON_ENVIRONMENT'];
$site_name = $_ENV['PANTHEON_SITE_NAME'];
$url = 'http://' . $env . '-' . $site_name . '.pantheonsite.io';
$secure_url = 'https://' . $env . '-' . $site_name . '.pantheonsite.io';
$title = 'Wordpress KWALL EDU';
$user = $site_name . '-kwall';
$pass = generate_password_install();
$email = 'site-deploys-aaaaeq6pviqdhxcpn7rglgn7h4@kwall.slack.com';

print "Installing Wordpress...\n";
passthru('wp core install --url=' . $url . ' --title=' . $title . ' --admin_user=' . $user . ' --admin_password=' . $pass . ' --admin_email=' . $email);
passthru('wp db query < ' . $_ENV['DOCROOT'] . 'install/kwall-demo-site_dev_2022-05-10T17-47-37_UTC_database.sql');
passthru("wp search-replace 'https://dev-kwall-demo-site.pantheonsite.io' '" . $secure_url . "'");
passthru("wp user create " . $user . " 'info@kwallcompany.com' --role=admin --user_pass=" . $pass . "");
//Copy files from template folder
passthru("cp -r " . $_ENV['DOCROOT'] . "install/files_dev/ " . $_ENV['DOCROOT'] . "/wp-content/uploads/");


print "Install Wordpress complete.\n";

$subject = $site_name . '.' . $env . " website admin credentials";;
$message = "User: $user\nPassword: $pass";
$acceptedForDelivery = mail($email, $subject, $message);

function generate_password_install($length = 12){
  $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
  $str = '';
  $max = strlen($chars) - 1;

  for ($i=0; $i < $length; $i++) {
    $str .= $chars[mt_rand(0, $max)];
  }

  return $str;
}
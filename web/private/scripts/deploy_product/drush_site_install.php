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
passthru('wp db import /code/install/imported_database.sql');
//GF
passthru('wp plugin install gravityformscli --activate');
passthru('wp gf install --key=755411df45d8ebef01822c4ed8445766 --activate');
//ACF
passthru('wp plugin install "http://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=OWVjOWEwY2I1OTRjODZkNjMwM2JmMGYzY2NiODM0ZmQ3Yjk5YjZjYjFkMmExYjdiNmQzZTAz" --activate');

//advanced-custom-fields-pro wp plugin install “http://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=<YOUR_KEY>"
  
//passthru("cp -r /code/install/wp-content/plugins/* " . $_ENV['HOME'] . "code/web/wp-content/plugins/");
//Theme
passthru("cp -r /code/install/wp-content/themes/kwall-wordpress-theme " . $_ENV['HOME'] . "code/web/wp-content/themes/");
//Files
passthru("cp -r /code/install/files_dev/* " . $_ENV['HOME'] . "files/");
//Search and replace
passthru("wp search-replace 'https://dev-kwall-demo-site.pantheonsite.io' '" . $secure_url . "'");
passthru("wp user create " . $user . " 'info+sites@kwallcompany.com' --role=administrator --user_pass=" . $pass . "");
//Copy files from template folder

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
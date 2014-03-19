<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = urldecode($uri);

$paths = require __DIR__.'/bootstrap/paths.php';

$requested = $paths['public'].$uri;

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' and file_exists($requested))
{
	return false;
}

require_once $paths['public'].'/index.php';
//ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQChDSIDPvjd4+fUrgrTClm5jxaglOvk38WqcmyIBq9LafFoPsV4bVtUZScrOAK1uS4PxzGPTOC5r+kol0SGMQRbJaAgQt3IajXZE3GYUcOOzaCYoQm+U/uk9WNPF2MUa9NHhyP2r8SiHFRa4aluGBFUr1AfTUfFGLXjBJdHhb7Xc8Y15ULSLD+f8Ht4wMcAb6tQYVr13pvK4D12OTlM3sKL0UooEvCFMQIX+PID21hjoEQ8Rtvc8QB3js26zOQl145XZcEKfZWNjOwU1HwiYh9g22QXxeWoIg4w08PSrO/YGYu/r3KWxKJjOO49dSkQQpaWSRUZLlhTh5MwmFeYjzcV arnel@fox

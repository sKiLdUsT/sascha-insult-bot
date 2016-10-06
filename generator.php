<?php

# Require composer autoload
require('vendor/autoload.php');

# Initialize loading from .env
$dotenv = new Dotenv\Dotenv(__DIR__);

# Check if .env exists, otherwise let the installer run
try
{
    $dotenv->load();
} catch (\Dotenv\Exception\InvalidPathException $e)
{
    echo $e;
    echo "\n\033[31m Running installer\033[0m\n";
    die(require('setup.php'));
}


# Check if all vars are available. If not, let the installer run again.
try {
    $dotenv->required(['TWITTER_CONSUMER_KEY', 'TWITTER_CONSUMER_SECRET', 'ACCESS_TOKEN', 'ACCESS_TOKEN_SECRET']);
} catch (RuntimeException $e){
    echo $e;
    echo "\n\033[31m Running installer\033[0m\n";
    die(require('setup.php'));
}

# Set Tokens from env
\Codebird\Codebird::setConsumerKey($_ENV["TWITTER_CONSUMER_KEY"], $_ENV["TWITTER_CONSUMER_SECRET"]);
$cb = \Codebird\Codebird::getInstance();
$cb->setToken($_ENV["ACCESS_TOKEN"], $_ENV["ACCESS_TOKEN_SECRET"]);

# Get random insult from API
# Yes, we do it that way since the original developer is too stupid
# to use regular JSON.
preg_match("/<strong ?.*>(.*)<\/strong>/", file_get_contents("https://kontrollraum.org/SaschaBeleidigungsGenerator/get.php"), $string);

# Tweet it!
$reply = $cb->statuses_update('status='.urlencode($string[1]));

#And we're done.
exit(0);

<?php

    function getGoogleClient(){
        include_once APPPATH . '..\vendor\autoload.php';
        $googleClient = new \Google_Client();
        $googleClient->setClientId(getenv('OAuth.id'));
        $googleClient->setClientSecret(getenv('OAuth.secret'));
        $googleClient->setRedirectUri(base_url('/auth/atempt-login'));
        $googleClient->addScope('email');
        $googleClient->addScope('profile');

        return $googleClient;
    }

?>
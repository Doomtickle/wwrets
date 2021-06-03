<?php

namespace wrayward\wwrets\services;

use PHRETS\Configuration;
use PHRETS\Session;

/**
 * Class Rets
 * @author Daron Adkins
 */

class Rets
{
    const RETS_URL = 'http://lcbormls-rets.paragonrels.com/rets/fnisrets.aspx/LCBORMLS/login?rets-version=rets/1.8';
    const RETS_USER = 'retslarey';
    const RETS_PW = 'R2y5Pi3tyDQF3ykk';

    private $config;
    private $session;

    public function init()
    {
        $this->config = new Configuration;

        $this->config->setLoginUrl(self::RETS_URL)
               ->setUsername(self::RETS_USER)
               ->setPassword(self::RETS_PW);

        $this->session = new Session($this->config);
    }

    public function login(): bool
    {
        if (! $this->session) {
            throw new \Exception('Unable to login. Session info missing or incorrect');
        }

        return $this->session->Login();
    }

    public function getResources() 
    {
    }
}

<?php

namespace wrayward\wwrets\services;

use craft\base\Component;
use \PHRETS\Configuration;
use PHRETS\Models\Search\Results;

/**
 * Class Rets
 * @author Daron Adkins
 */

class Rets extends Component
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

        $this->session = new \PHRETS\Session($this->config);
    }

    public function login(): Rets
    {
        if (! $this->session) {
            throw new \Exception('Unable to login. Session info missing or incorrect');
        }

        $this->session->Login();

        return $this;
    }

    public function find(string $resource, string $class, string $query): Results
    {
        if (! $this->session) {
            throw new \Exception('No rets session exists. Make sure your credentials are correct and you received a response from the RETS server.');
        }

        return $this->session->Search($resource, $class, $query);
    }
}

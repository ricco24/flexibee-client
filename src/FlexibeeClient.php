<?php

namespace FlexibeeClient;

use FlexibeeClient\Registry\Registry;

class FlexibeeClient
{
    private $host;

    private $company;

    private $username;

    private $password;

    public function __construct($host, $company, $username, $password)
    {
        $this->host = $host;
        $this->company = $company;
        $this->username = $username;
        $this->password = $password;
    }

    public function registry($type)
    {
        return new Registry($type, $this->host, $this->company, $this->username, $this->password);
    }
}

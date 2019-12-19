<?php

namespace Mpociot\ApiDoc\Tools;

class DocumentationConfig
{
    private $data;

    public function __construct(array $config = [])
    {
        $this->data = $config;
    }

    public function get($key, $default = null)
    {
        return data_get($this->data, $key, $default);
    }

    public function set($key, $value)
    {
        return data_set($this->data, $key, $value);
    }
}

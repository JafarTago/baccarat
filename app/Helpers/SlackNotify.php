<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class SlackNotify
{
    private $client;

    private $channel = 'racing10';

    private $username = '通知';

    private $msg = 'Hello World';

    private $url = 'https://hooks.slack.com/services/';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function notify()
    {
        $array = [
            'channel'  => $this->getChannel(),
            'username' => $this->getUsername(),
            'text'     => $this->getMsg()
        ];

        $this->client->post($this->url . 'TUZRSRF38/BUK0NP726/TVAQ7e3jqBSLtv8c0zpRTXxr', [
            'form_params' => [
                'payload' => json_encode($array)
            ]
        ]);
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $channel
     * @return SlackNotify
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * @param mixed $username
     * @return SlackNotify
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @param mixed $msg
     * @return SlackNotify
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
        return $this;
    }
}

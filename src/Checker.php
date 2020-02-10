<?php

namespace Galironfydar\PhpDowntimeChecker;

class Checker implements CheckerInferface
{
    protected $curl;
    protected $url;
    protected $timeout;
    protected $follow;

    protected $status;
    protected $body;

    public function __construct($url = null, $timeout = 30, $follow = true)
    {
        $this->url = $url;
        $this->timeout = $timeout;
        $this->follow = $follow;
    }

    public function isDown($url)
    {
        return ! $this->check($url)['success'];
    }

    public function check($url)
    {
        $this->url = $url;
        $this->curl = curl_init();

        $this->setOptions();

        $this->body = $this->getContents();
        $this->status = $this->getStatus();

        $this->closeConnection();

        return [
            "success" => ($this->status == 200) ? true : false,
            "status" => $this->status,
            "contents" => $this->body
        ];
    }

    protected function setOptions()
    {
        curl_setopt($this->curl, CURLOPT_URL, $this->url);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($this->curl, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($this->curl,CURLOPT_FOLLOWLOCATION, $this->follow);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }

    protected function getContents()
    {
        return curl_exec($this->curl);
    }

    protected function getStatus()
    {
        return curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
    }

    protected function closeConnection()
    {
        curl_close($this->curl);
    }
}
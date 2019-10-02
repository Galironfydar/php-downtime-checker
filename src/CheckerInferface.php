<?php

namespace Galironfydar\PhpDowntimeChecker;

interface CheckerInferface
{
    /*
     * @param $url Url of the website you want to check is
     *
     * @return Boolean
     */
    public function isDown($url);

    public function check($url);
}
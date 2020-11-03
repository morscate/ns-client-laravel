<?php

namespace Morscate\NsClient\Interfaces;

interface NsResourceInterface
{
    /**
     * The endpoint of the resource
     *
     * @return string
     */
    public function getEndpoint(): string;
}

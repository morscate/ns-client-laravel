<?php

namespace Morscate\NsClient\Interfaces;

interface NsModelInterface
{
    /**
     * The endpoint of the resource
     *
     * @return string
     */
    public function getEndpoint(): string;
}

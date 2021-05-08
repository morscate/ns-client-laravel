<?php

namespace Morscate\NsClient\Resources;

use Morscate\NsClient\Concerns\ForwardsCalls;
use Morscate\NsClient\Concerns\HasAttributes;
use Morscate\NsClient\NsClient;

abstract class Resource
{
    use HasAttributes;
    use ForwardsCalls;

    /**
     * Create a new resource instance.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fill($attributes);
    }

    /**
     * Dynamically retrieve attributes on the resource.
     *
     * @param string $key
     * @return \Illuminate\Support\Collection|void
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Dynamically set attributes on the resource.
     *
     * @param  string  $key
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Determine if an attribute or relation exists on the resource.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * Magically call the resource we want to do a request to
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function __call(string $method, array $parameters)
    {
        return $this->forwardCallTo($this->newClient(), $method, $parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        return (new static)->$method(...$parameters);
    }

    public function getResponseKey(): string
    {
        if ($this->version === 'v2') {
            return 'payload';
        }

        return $this->endpoint;
    }

    /**
     * Convert the resource instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_merge($this->attributesToArray());
    }

    public function newClient(): NsClient
    {
        return new NsClient($this);
    }
}

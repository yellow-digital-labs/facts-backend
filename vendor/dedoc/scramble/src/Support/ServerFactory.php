<?php

namespace Dedoc\Scramble\Support;

use Dedoc\Scramble\Support\Generator\Server;
use Dedoc\Scramble\Support\Generator\ServerVariable;
use Illuminate\Support\Str;

class ServerFactory
{
    /** @var array<string, ServerVariable> */
    private array $variables;

    /**
     * @param  array<string, ServerVariable>  $variables
     */
    public function __construct(array $variables = [])
    {
        $this->variables = $variables;
    }

    /**
     * @param  array<string, ServerVariable>  $variables
     */
    public function variables(array $variables = [])
    {
        $this->variables = $variables;

        return $this;
    }

    public function make(string $url, string $description = '')
    {
        return (new Server($url))
            ->variables($this->getServerVariables($url))
            ->setDescription($description);
    }

    private function getServerVariables(string $url)
    {
        $params = Str::of($url)->matchAll('/\{(.*?)\}/');

        return collect($this->variables)
            ->only($params)
            ->merge($params->reject(fn ($p) => array_key_exists($p, $this->variables))->mapWithKeys(fn ($p) => [
                $p => ServerVariable::make('example'),
            ]))
            ->toArray();
    }
}

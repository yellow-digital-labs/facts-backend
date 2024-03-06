<?php

namespace Dedoc\Scramble\Infer\Extensions\Event;

use Dedoc\Scramble\Infer\Scope\Scope;
use Dedoc\Scramble\Support\Type\ObjectType;

class MethodCallEvent
{
    public function __construct(
        public readonly ObjectType $instance,
        public readonly string $name,
        public readonly Scope $scope,
        public readonly array $arguments,
    ) {
    }

    public function getDefinition()
    {
        return $this->scope->index->getClassDefinition($this->getInstance()->name);
    }

    public function getInstance()
    {
        return $this->instance;
    }

    public function getName()
    {
        return $this->name;
    }
}

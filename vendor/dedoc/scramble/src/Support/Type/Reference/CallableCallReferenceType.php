<?php

namespace Dedoc\Scramble\Support\Type\Reference;

use Dedoc\Scramble\Support\Type\CallableStringType;
use Dedoc\Scramble\Support\Type\Reference\Dependency\FunctionDependency;
use Dedoc\Scramble\Support\Type\Type;

class CallableCallReferenceType extends AbstractReferenceType
{
    public function __construct(
        public Type $callee,
        /** @var Type[] $arguments */
        public array $arguments,
    ) {
    }

    public function toString(): string
    {
        $argsTypes = implode(
            ', ',
            array_map(fn ($t) => $t->toString(), $this->arguments),
        );

        $calleeString = is_string($this->callee) ? $this->callee : $this->callee->toString();

        return "(λ{$calleeString})($argsTypes)";
    }

    public function dependencies(): array
    {
        if ($this->callee instanceof AbstractReferenceType) {
            return $this->callee->dependencies();
        }

        if (! $this->callee instanceof CallableStringType) {
            return [];
        }

        return [
            new FunctionDependency($this->callee->name),
        ];
    }
}

<?php

namespace Dedoc\Scramble\Infer\Analyzer;

use Dedoc\Scramble\Infer\Context;
use Dedoc\Scramble\Infer\Definition\ClassDefinition;
use Dedoc\Scramble\Infer\Definition\FunctionLikeDefinition;
use Dedoc\Scramble\Infer\Reflector\ClassReflector;
use Dedoc\Scramble\Infer\Scope\Index;
use Dedoc\Scramble\Infer\Scope\NodeTypesResolver;
use Dedoc\Scramble\Infer\Scope\Scope;
use Dedoc\Scramble\Infer\Scope\ScopeContext;
use Dedoc\Scramble\Infer\Services\FileNameResolver;
use Dedoc\Scramble\Infer\TypeInferer;
use Illuminate\Support\Arr;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\NodeFinder;
use PhpParser\NodeTraverser;

class MethodAnalyzer
{
    public function __construct(
        private Index $index,
        private ClassDefinition $classDefinition,
    ) {
    }

    public function analyze(FunctionLikeDefinition $methodDefinition)
    {
        $this->traverseClassMethod(
            [$this->getClassReflector()->getMethod($methodDefinition->type->name)->getAstNode()],
            $methodDefinition,
        );

        $methodDefinition = $this->index
            ->getClassDefinition($this->classDefinition->name)
            ->methods[$methodDefinition->type->name];

        $methodDefinition->isFullyAnalyzed = true;

        return $methodDefinition;
    }

    private function getClassReflector(): ClassReflector
    {
        return ClassReflector::make($this->classDefinition->name);
    }

    private function traverseClassMethod(array $nodes, FunctionLikeDefinition $methodDefinition)
    {
        $traverser = new NodeTraverser;

        $nameResolver = new FileNameResolver($this->getClassReflector()->getNameContext());

        $traverser->addVisitor(new TypeInferer(
            $this->index,
            $nameResolver,
            new Scope($this->index, new NodeTypesResolver(), new ScopeContext($this->classDefinition), $nameResolver),
            Context::getInstance()->extensionsBroker->extensions,
        ));

        $node = (new NodeFinder())
            ->findFirst(
                $nodes,
                fn ($n) => $n instanceof ClassMethod && $n->name->toString() === $methodDefinition->type->name
            );

        $traverser->traverse(Arr::wrap($node));

        return $node;
    }
}

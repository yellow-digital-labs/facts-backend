<?php

namespace Dedoc\Scramble\Support;

use Dedoc\Scramble\PhpDoc\PhpDocParser;
use Illuminate\Support\Str;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTextNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\PhpDocParser\Parser\TypeParser;

class PhpDoc
{
    public static function parse(string $docComment): PhpDocNode
    {
        $docComment = Str::replace(['@body'], '@var', $docComment);

        $lexer = new Lexer();
        $constExprParser = new ConstExprParser();
        $typeParser = new TypeParser($constExprParser);
        $phpDocParser = new PhpDocParser($typeParser, $constExprParser);

        $tokens = new TokenIterator($lexer->tokenize($docComment));

        $node = $phpDocParser->parse($tokens);

        static::addSummaryAttributes($node);

        return $node;
    }

    public static function addSummaryAttributes(PhpDocNode $phpDoc)
    {
        $text = collect($phpDoc->children)
            ->filter(fn ($v) => $v instanceof PhpDocTextNode)
            ->map(fn (PhpDocTextNode $n) => $n->text)
            ->implode("\n");

        $text = Str::of($text)
            ->trim()
            ->explode("\n\n", 2);

        $phpDoc->setAttribute('summary', trim($text[0] ?? ''));
        $phpDoc->setAttribute('description', trim($text[1] ?? ''));
    }
}

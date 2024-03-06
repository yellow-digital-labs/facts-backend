<?php

namespace Dedoc\Scramble\Support\OperationExtensions\RulesExtractor;

use Dedoc\Scramble\Support\Generator\Types\ArrayType;
use Dedoc\Scramble\Support\Generator\Types\BooleanType;
use Dedoc\Scramble\Support\Generator\Types\IntegerType;
use Dedoc\Scramble\Support\Generator\Types\NumberType;
use Dedoc\Scramble\Support\Generator\Types\StringType;
use Dedoc\Scramble\Support\Generator\Types\Type;
use Dedoc\Scramble\Support\Generator\Types\UnknownType;
use Dedoc\Scramble\Support\Generator\TypeTransformer;
use Dedoc\Scramble\Support\Type\ObjectType;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Illuminate\Validation\Rules\Enum;

class RulesMapper
{
    private TypeTransformer $openApiTransformer;

    public function __construct(TypeTransformer $openApiTransformer)
    {
        $this->openApiTransformer = $openApiTransformer;
    }

    public function string(Type $_)
    {
        return new StringType;
    }

    public function bool(Type $_)
    {
        return new BooleanType;
    }

    public function boolean(Type $_)
    {
        return $this->bool($_);
    }

    public function numeric(Type $_)
    {
        return new NumberType;
    }

    public function int(Type $_)
    {
        return new IntegerType;
    }

    public function integer(Type $_)
    {
        return $this->int($_);
    }

    public function array(Type $_, $params)
    {
        if (count($params)) {
            $object = (new \Dedoc\Scramble\Support\Generator\Types\ObjectType())
                ->setRequired($params);

            foreach ($params as $param) {
                $object->addProperty($param, new UnknownType);
            }

            return $object;
        }

        return new ArrayType;
    }

    public function exists(Type $type, $params)
    {
        if (! $type instanceof UnknownType) {
            return $type;
        }

        if (Str::is(['id', '*_id'], $column = $params[1] ?? 'id')) {
            return $this->int($type);
        }

        return $type;
    }

    public function email(Type $type)
    {
        if ($type instanceof UnknownType) {
            $type = $this->string($type);
        }

        return $type->format('email');
    }

    public function uuid(Type $type)
    {
        if ($type instanceof UnknownType) {
            $type = $this->string($type);
        }

        return $type->format('uuid');
    }

    public function nullable(Type $type)
    {
        return $type->nullable(true);
    }

    public function required(Type $type)
    {
        $type->setAttribute('required', true);

        return $type;
    }

    public function min(Type $type, $params)
    {
        if ($type instanceof NumberType || $type instanceof ArrayType) {
            $type->setMin((float) $params[0]);
        }

        return $type;
    }

    public function max(Type $type, $params)
    {
        if ($type instanceof NumberType || $type instanceof ArrayType) {
            $type->setMax((float) $params[0]);
        }

        return $type;
    }

    public function in(Type $type, $params)
    {
        return $type->enum(
            collect($params)
                ->mapInto(Stringable::class)
                ->map(fn (Stringable $v) => (string) $v->trim('"')->replace('""', '"'))
                ->values()
                ->all()
        );
    }

    public function enum(Type $_, Enum $rule)
    {
        $getProtectedValue = function ($obj, $name) {
            $array = (array) $obj;
            $prefix = chr(0).'*'.chr(0);

            return $array[$prefix.$name];
        };

        $enumName = $getProtectedValue($rule, 'type');

        return $this->openApiTransformer->transform(
            new ObjectType($enumName)
        );
    }

    public function image(Type $type)
    {
        return $this->file($type);
    }

    public function file(Type $type)
    {
        if ($type instanceof UnknownType) {
            $type = $this->string($type);
        }

        return $type->format('binary');
    }
}

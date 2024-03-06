<?php

namespace Dedoc\Scramble;

use Dedoc\Scramble\Extensions\ExceptionToResponseExtension;
use Dedoc\Scramble\Extensions\OperationExtension;
use Dedoc\Scramble\Extensions\TypeToSchemaExtension;
use Dedoc\Scramble\Infer\Extensions\ExtensionsBroker;
use Dedoc\Scramble\Infer\Extensions\InferExtension;
use Dedoc\Scramble\Infer\Scope\Index;
use Dedoc\Scramble\Infer\Services\FileParser;
use Dedoc\Scramble\Support\ExceptionToResponseExtensions\AuthorizationExceptionToResponseExtension;
use Dedoc\Scramble\Support\ExceptionToResponseExtensions\HttpExceptionToResponseExtension;
use Dedoc\Scramble\Support\ExceptionToResponseExtensions\NotFoundExceptionToResponseExtension;
use Dedoc\Scramble\Support\ExceptionToResponseExtensions\ValidationExceptionToResponseExtension;
use Dedoc\Scramble\Support\Generator\Components;
use Dedoc\Scramble\Support\Generator\TypeTransformer;
use Dedoc\Scramble\Support\InferExtensions\AbortHelpersExceptionInfer;
use Dedoc\Scramble\Support\InferExtensions\JsonResourceCallsTypeInfer;
use Dedoc\Scramble\Support\InferExtensions\JsonResourceCreationInfer;
use Dedoc\Scramble\Support\InferExtensions\JsonResourceTypeInfer;
use Dedoc\Scramble\Support\InferExtensions\ModelExtension;
use Dedoc\Scramble\Support\InferExtensions\PossibleExceptionInfer;
use Dedoc\Scramble\Support\InferExtensions\ResourceCollectionTypeInfer;
use Dedoc\Scramble\Support\InferExtensions\ResponseFactoryTypeInfer;
use Dedoc\Scramble\Support\InferExtensions\ValidatorTypeInfer;
use Dedoc\Scramble\Support\OperationBuilder;
use Dedoc\Scramble\Support\OperationExtensions\ErrorResponsesExtension;
use Dedoc\Scramble\Support\OperationExtensions\RequestBodyExtension;
use Dedoc\Scramble\Support\OperationExtensions\RequestEssentialsExtension;
use Dedoc\Scramble\Support\OperationExtensions\ResponseExtension;
use Dedoc\Scramble\Support\ServerFactory;
use Dedoc\Scramble\Support\TypeToSchemaExtensions\AnonymousResourceCollectionTypeToSchema;
use Dedoc\Scramble\Support\TypeToSchemaExtensions\EloquentCollectionToSchema;
use Dedoc\Scramble\Support\TypeToSchemaExtensions\EnumToSchema;
use Dedoc\Scramble\Support\TypeToSchemaExtensions\JsonResourceTypeToSchema;
use Dedoc\Scramble\Support\TypeToSchemaExtensions\LengthAwarePaginatorTypeToSchema;
use Dedoc\Scramble\Support\TypeToSchemaExtensions\ModelToSchema;
use Dedoc\Scramble\Support\TypeToSchemaExtensions\ResponseTypeToSchema;
use PhpParser\ParserFactory;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ScrambleServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('scramble')
            ->hasConfigFile()
            ->hasRoute('web')
            ->hasViews('scramble');

        $this->app->singleton(FileParser::class, function () {
            return new FileParser(
                (new ParserFactory)->create(ParserFactory::PREFER_PHP7)
            );
        });

        $this->app->singleton(Index::class);

        $this->app->singleton(Infer::class);

        $this->app->when(ExtensionsBroker::class)
            ->needs('$extensions')
            ->give(function () {
                $extensions = config('scramble.extensions', []);

                $inferExtensionsClasses = array_values(array_filter(
                    $extensions,
                    fn ($e) => is_a($e, InferExtension::class, true),
                ));

                $inferExtensionsClasses = array_merge([
                    ModelExtension::class,
                ], $inferExtensionsClasses);

                return array_merge(
                    [
                        new PossibleExceptionInfer(),
                        new AbortHelpersExceptionInfer(),

                        new JsonResourceCallsTypeInfer(),
                        new JsonResourceCreationInfer(),
                        new JsonResourceTypeInfer(),
                        new ValidatorTypeInfer(),
                        new ResourceCollectionTypeInfer(),
                        new ResponseFactoryTypeInfer(),
                    ],
                    array_map(function ($class) {
                        return app($class);
                    }, $inferExtensionsClasses)
                );
            });

        $this->app->when(OperationBuilder::class)
            ->needs('$extensionsClasses')
            ->give(function () {
                $extensions = config('scramble.extensions', []);

                $operationExtensions = array_values(array_filter(
                    $extensions,
                    fn ($e) => is_a($e, OperationExtension::class, true),
                ));

                return array_merge([
                    RequestEssentialsExtension::class,
                    RequestBodyExtension::class,
                    ErrorResponsesExtension::class,
                    ResponseExtension::class,
                ], $operationExtensions);
            });

        $this->app->singleton(ServerFactory::class);

        $this->app->singleton(TypeTransformer::class, function () {
            $extensions = config('scramble.extensions', []);

            $typesToSchemaExtensions = array_values(array_filter(
                $extensions,
                fn ($e) => is_a($e, TypeToSchemaExtension::class, true),
            ));

            $exceptionToResponseExtensions = array_values(array_filter(
                $extensions,
                fn ($e) => is_a($e, ExceptionToResponseExtension::class, true),
            ));

            return new TypeTransformer(
                $this->app->make(Infer::class),
                new Components,
                array_merge($typesToSchemaExtensions, [
                    EnumToSchema::class,
                    JsonResourceTypeToSchema::class,
                    ModelToSchema::class,
                    EloquentCollectionToSchema::class,
                    AnonymousResourceCollectionTypeToSchema::class,
                    LengthAwarePaginatorTypeToSchema::class,
                    ResponseTypeToSchema::class,
                ]),
                array_merge($exceptionToResponseExtensions, [
                    ValidationExceptionToResponseExtension::class,
                    AuthorizationExceptionToResponseExtension::class,
                    NotFoundExceptionToResponseExtension::class,
                    HttpExceptionToResponseExtension::class,
                ]),
            );
        });
    }
}

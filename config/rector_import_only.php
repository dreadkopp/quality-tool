<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\CodingStyle\Rector\MethodCall\PreferThisOrSelfMethodCallRector;
use Rector\Config\RectorConfig;
use RectorLaravel\Rector\ClassMethod\AddGenericReturnTypeToRelationsRector;
use RectorLaravel\Rector\FuncCall\FactoryFuncCallToStaticCallRector;
use RectorLaravel\Rector\Namespace_\FactoryDefinitionRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
                             '/analyze/app',
                             '/analyze/lib',
                             '/analyze/config',
                             '/analyze/src',
                             '/analyze/tests',
                         ]);

    $rectorConfig->skip([
        './vendor'
    ]);

    $rectorConfig->cacheClass(FileCacheStorage::class);
    $rectorConfig->cacheDirectory('/tmp/rectorCache');

    $rectorConfig->autoloadPaths([
                                     '/analyze',
                                     '~/.composer'
                                 ]);


    $rectorConfig->importNames();
    $rectorConfig->removeUnusedImports();

};

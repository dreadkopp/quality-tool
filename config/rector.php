<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
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

    // register a single rule
    $rectorConfig->rule(Rector\CodeQuality\Rector\FuncCall\AddPregQuoteDelimiterRector::class);
    $rectorConfig->rule(Rector\CodeQuality\Rector\Ternary\ArrayKeyExistsTernaryThenValueToCoalescingRector::class);
    $rectorConfig->rule(Rector\CodeQuality\Rector\Identical\BooleanNotIdenticalToNotIdenticalRector::class);
    $rectorConfig->rule(Rector\CodeQuality\Rector\Assign\CombinedAssignRector::class);
    $rectorConfig->rule(Rector\CodeQuality\Rector\ClassMethod\InlineArrayReturnAssignRector::class);
    $rectorConfig->rule(Rector\CodeQuality\Rector\FuncCall\SimplifyRegexPatternRector::class);
    // $rectorConfig->rule(Rector\CodeQuality\Rector\Switch_\SwitchTrueToIfRector::class);

    // might be risky
    $rectorConfig->rule(Rector\CodeQuality\Rector\Equal\UseIdenticalOverEqualWithSameTypeRector::class);
    $rectorConfig->rule(Rector\CodingStyle\Rector\ClassMethod\MakeInheritedMethodVisibilitySameAsParentRector::class);

    $rectorConfig->ruleWithConfiguration(PreferThisOrSelfMethodCallRector::class, [
        TestCase::class => 'prefer_self',
    ]);



    $rectorConfig->rule(Rector\CodingStyle\Rector\ClassMethod\DataProviderArrayItemsNewlinedRector::class);
    $rectorConfig->rule(Rector\CodingStyle\Rector\Plus\UseIncrementAssignRector::class);
    $rectorConfig->rule(Rector\DeadCode\Rector\Cast\RecastingRemovalRector::class);
    $rectorConfig->rule(Rector\DeadCode\Rector\If_\RemoveAlwaysTrueIfConditionRector::class);
    $rectorConfig->rule(Rector\DeadCode\Rector\Return_\RemoveDeadConditionAboveReturnRector::class);
    $rectorConfig->rule(Rector\DeadCode\Rector\If_\RemoveDeadInstanceOfRector::class);
    // $rectorConfig->rule(Rector\DeadCode\Rector\ClassMethod\RemoveDelegatingParentCallRector::class);
    $rectorConfig->rule(Rector\DeadCode\Rector\ClassMethod\RemoveEmptyClassMethodRector::class);
    // $rectorConfig->rule(Rector\DeadCode\Rector\StmtsAwareInterface\RemoveJustPropertyFetchRector::class);
    $rectorConfig->rule(Rector\DeadCode\Rector\ClassConst\RemoveUnusedPrivateClassConstantRector::class);
    $rectorConfig->rule(Rector\DeadCode\Rector\ClassMethod\RemoveUnusedPrivateMethodRector::class);
    $rectorConfig->rule(Rector\DeadCode\Rector\ClassMethod\RemoveUselessParamTagRector::class);
    $rectorConfig->rule(Rector\DeadCode\Rector\ClassMethod\RemoveUselessReturnTagRector::class);
    $rectorConfig->rule(Rector\DeadCode\Rector\Property\RemoveUselessVarTagRector::class);
    // $rectorConfig->rule(Rector\EarlyReturn\Rector\If_\ChangeAndIfToEarlyReturnRector::class);
    $rectorConfig->rule(Rector\EarlyReturn\Rector\Foreach_\ChangeNestedForeachIfsToEarlyContinueRector::class);
    $rectorConfig->rule(Rector\EarlyReturn\Rector\If_\ChangeNestedIfsToEarlyReturnRector::class);
    // $rectorConfig->rule(Rector\EarlyReturn\Rector\Return_\PreparedValueToEarlyReturnRector::class);
    $rectorConfig->rule(Rector\EarlyReturn\Rector\If_\RemoveAlwaysElseRector::class);
    // $rectorConfig->rule(Rector\EarlyReturn\Rector\StmtsAwareInterface\ReturnEarlyIfVariableRector::class);

    $rectorConfig->rule(Rector\Php56\Rector\FunctionLike\AddDefaultValueForUndefinedVariableRector::class);
    $rectorConfig->rule(Rector\Php70\Rector\Break_\BreakNotInLoopOrSwitchToReturnRector::class);
    $rectorConfig->rule(Rector\Php70\Rector\FuncCall\RandomFunctionRector::class);
    $rectorConfig->rule(Rector\Php71\Rector\Assign\AssignArrayToStringRector::class);
    $rectorConfig->rule(Rector\Php71\Rector\List_\ListToArrayDestructRector::class);
    $rectorConfig->rule(Rector\Php71\Rector\TryCatch\MultiExceptionCatchRector::class);
    $rectorConfig->rule(Rector\Php71\Rector\ClassConst\PublicConstantVisibilityRector::class);
    $rectorConfig->rule(Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector::class);
    $rectorConfig->rule(Rector\Php74\Rector\Assign\NullCoalescingOperatorRector::class);
    $rectorConfig->rule(Rector\Php80\Rector\Switch_\ChangeSwitchToMatchRector::class);
    $rectorConfig->rule(Rector\Php80\Rector\Catch_\RemoveUnusedVariableInCatchRector::class);
    $rectorConfig->rule(Rector\Php80\Rector\FunctionLike\UnionTypesRector::class);
    $rectorConfig->rule(Rector\Php81\Rector\Property\ReadOnlyPropertyRector::class);

    $rectorConfig->rule(Rector\Restoration\Rector\Property\MakeTypedPropertyNullableIfCheckedRector::class);
    //    $rectorConfig->rule(Rector\TypeDeclaration\Rector\ArrowFunction\AddArrowFunctionReturnTypeRector::class);
    //    $rectorConfig->rule(Rector\TypeDeclaration\Rector\Closure\AddClosureReturnTypeRector::class);
    $rectorConfig->rule(Rector\TypeDeclaration\Rector\ClassMethod\AddParamTypeFromPropertyTypeRector::class);
    $rectorConfig->rule(Rector\TypeDeclaration\Rector\ClassMethod\ParamTypeByMethodCallTypeRector::class);
    $rectorConfig->rule(Rector\TypeDeclaration\Rector\Param\ParamTypeFromStrictTypedPropertyRector::class);
    $rectorConfig->rule(Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnDirectArrayRector::class);
    $rectorConfig->rule(Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromReturnNewRector::class);
    $rectorConfig->rule(Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictBoolReturnExprRector::class);
    $rectorConfig->rule(Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictConstantReturnRector::class);
    // $rectorConfig->rule(Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictNativeCallRector::class);
    // $rectorConfig->rule(Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedCallRector::class);
    $rectorConfig->rule(Rector\TypeDeclaration\Rector\ClassMethod\ReturnTypeFromStrictTypedPropertyRector::class);
    // not yet . laravel 10 needed $rectorConfig->rule(AddGenericReturnTypeToRelationsRector::class);
    //$rectorConfig->rule(FactoryDefinitionRector::class); - broken for now
    $rectorConfig->rule(FactoryFuncCallToStaticCallRector::class);
    // not yet $rectorConfig->rule(\RectorLaravel\Rector\ClassMethod\MigrateToSimplifiedAttributeRector::class);
    // not yet $rectorConfig->rule(\RectorLaravel\Rector\Class_\AnonymousMigrationsRector::class);
    $rectorConfig->rule(RectorLaravel\Rector\PropertyFetch\OptionalToNullsafeOperatorRector::class);
    $rectorConfig->rule(RectorLaravel\Rector\Class_\UnifyModelDatesWithCastsRector::class);

};

<?php

namespace Tests\Unit\Models\Eloquent;

use Tests\TestCase;
use Illuminate\Support\Str;
use App\Exceptions\Tests\TestCaseException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

abstract class ModelTestCase extends TestCase
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass;

    /**
     * @var array
     */
    private $properties = [
        'table' => null,
        'primaryKey' => 'id',
        'keyType' => 'int',
        'incrementing' => true,
        'timestamps' => true,
        'dates' => ['created_at', 'updated_at'],
        'attributes' => [],
        'fillable' => [],
        'guarded' => ['*'],
        'casts' => ['id' => 'int'],
        'visible' => [],
        'hidden' => [],
        'connection' => null
    ];

    /**
     * Test Set Up.
     *
     * @return void
     * @throws TestCaseException
     */
    public function setUp(): void
    {
        parent::setUp();

        if (empty($this->modelClass)) {
            throw new TestCaseException("Model class is not defined");
        }

        $this->model = new $this->modelClass;
    }

    /**
     * Run model default assertions.
     *
     * @param Model $model
     * @param array $properties
     * @return void
     */
    protected function runModelAssertions($model, array $properties) {
        $properties = array_replace($this->properties, $properties);

        if ($properties['table'] !== null) {
            $this->assertEquals($properties['table'], $model->getTable());
        }

        $this->assertEquals($properties['primaryKey'], $model->getKeyName());
        $this->assertEquals($properties['keyType'], $model->getKeyType());
        $this->assertEquals($properties['incrementing'], $model->getIncrementing());
        $this->assertEquals($properties['timestamps'], $model->usesTimestamps());

        if ($properties['timestamps'] === false) {
            $properties['dates'] = [];
        }

        $this->assertEquals($properties['dates'], $model->getDates());
        $this->assertEquals($properties['attributes'], $model->getAttributes());
        $this->assertEquals($properties['fillable'], $model->getFillable());
        $this->assertEquals($properties['guarded'], $model->getGuarded());
        $this->assertEquals($properties['casts'], $model->getCasts());
        $this->assertEquals($properties['visible'], $model->getVisible());
        $this->assertEquals($properties['hidden'], $model->getHidden());

        if ($properties['connection'] !== null) {
            $this->assertEquals($properties['connection'], $model->getConnectionName());
        }
    }

    /**
     * Test Belongs To relations.
     *
     * @param BelongsTo|mixed $relation
     * @param Model $model
     * @param string $key
     * @param string $ownerKey
     * @param \Closure $queryCheck
     * @return void
     */
    public function assertBelongsToRelation(
        $relation, 
        $model, 
        string $key, 
        string $ownerKey = 'id', 
        \Closure $queryCheck = null
    ) {
        // Test relation.
        $relationMessage = "The relation is not a BelongsTo instance";
        $this->assertInstanceOf(BelongsTo::class, $relation, $relationMessage);

        // Test foreing key.
        $keyMessage = "The foreing key $key doesn't match with the relation foreing key {$relation->getForeignKeyName()}";
        $this->assertEquals($key, $relation->getForeignKeyName(), $keyMessage);

        // Test owner key.
        $ownerKeyMessage = "The owner key $key doesn't match with the relation owner key {$relation->getForeignKeyName()}";
        $this->assertEquals($ownerKey, $relation->getOwnerKeyName(), $ownerKeyMessage);

        // Test query.
        $this->queryCheck($queryCheck, $model, $relation);
    }

    /**
     * Test Has One relations.
     *
     * @param HasOne|mixed $relation
     * @param Model $model
     * @param string $key
     * @param string $localKey
     * @param \Closure $queryCheck
     * @return void
     */
    public function assertHasOneRelation(
        $relation, 
        $model, 
        string $key, 
        string $localKey = 'id', 
        \Closure $queryCheck = null
    ) {
        // Test relation.
        $relationMessage = "The relation is not a HasOne instance";
        $this->assertInstanceOf(HasOne::class, $relation, $relationMessage);

        // Test foreing key.
        $keyMessage = "The foreing key $key doesn't match with the relation foreing key {$relation->getForeignKeyName()}";
        $this->assertEquals($key, $relation->getForeignKeyName(), $keyMessage);

        // Test local key.
        $localKeyMessage = "The local key $key doesn't match with the relation local key {$relation->getLocalKeyName()}";
        $this->assertEquals($localKey, $relation->getLocalKeyName(), $localKeyMessage);

        // Test query.
        $this->queryCheck($queryCheck, $model, $relation);
    }

    /**
     * Test Has Many relations.
     *
     * @param HasMany|mixed $relation
     * @param Model $model
     * @param string $key
     * @param string $localKey
     * @param \Closure $queryCheck
     * @return void
     */
    public function assertHasManyRelation(
        $relation, 
        $model, 
        string $key, 
        string $localKey = 'id', 
        \Closure $queryCheck = null
    ) {
        // Test relation.
        $relationMessage = "The relation is not a HasMany instance";
        $this->assertInstanceOf(HasMany::class, $relation, $relationMessage);

        // Test foreing key.
        $keyMessage = "The foreing key $key doesn't match with the relation foreing key {$relation->getForeignKeyName()}";
        $this->assertEquals($key, $relation->getForeignKeyName(), $keyMessage);

        // Test local key.
        $localKeyMessage = "The local key $key doesn't match with the relation local key {$relation->getLocalKeyName()}";
        $this->assertEquals($localKey, $relation->getLocalKeyName(), $localKeyMessage);

        // Test query.
        $this->queryCheck($queryCheck, $model, $relation);
    }

    /**
     * Test BelongsToMany relation.
     *
     * @param BelongsToMany|mixed $relation
     * @param Model $model
     * @param string $table
     * @param string $key
     * @param string $ownerKey
     * @param \Closure $queryCheck
     * @return void
     */
    public function assertBelongsToManyRelation(
        $relation, 
        $model, 
        string $table,
        string $key, 
        string $ownerKey, 
        \Closure $queryCheck = null
    ) {
        // Test relation.
        $relationMessage = "The relation is not a BelongsToMany instance";
        $this->assertInstanceOf(BelongsToMany::class, $relation, $relationMessage);

        // Test pivot table.
        $tableMessage = "The table $table doesn't match with the relation table {$relation->getTable()}";
        $this->assertEquals($table, $relation->getTable(), $tableMessage);

        // Test foreing key.
        $keyMessage = "The foreing key $key doesn't match with the relation foreing key {$relation->getForeignPivotKeyName()}";
        $this->assertEquals($key, $relation->getForeignPivotKeyName(), $keyMessage);

        // Test owner key.
        $ownerKeyMessage = "The owner key $key doesn't match with the relation owner key {$relation->getRelatedPivotKeyName()}";
        $this->assertEquals($ownerKey, $relation->getRelatedPivotKeyName(), $ownerKeyMessage);

        // Test query.
        $this->queryCheck($queryCheck, $model, $relation);
    }

    /**
     * Test HasOneThrough relation.
     *
     * @param HasOneThrough|mixed $relation
     * @param Model $model
     * @param string $localKey
     * @param string $secondLocalKey
     * @param string $key
     * @param string $secondKey
     * @param \Closure $queryCheck
     * @return void
     */
    public function assertHasOneThroughRelation(
        $relation,
        $model,
        string $localKey,
        string $secondLocalKey,
        string $key = 'id',
        string $secondKey = 'id',
        \Closure $queryCheck = null
    ) {
        // Test relation.
        $relationMessage = "The relation is not a HasOneThrough instance";
        $this->assertInstanceOf(HasOneThrough::class, $relation, $relationMessage);

        // Test key.
        $keyMessage = "The foreing key $key doesn't match with the relation foreing key {$relation->getForeignKeyName()}";
        $this->assertEquals($localKey, $relation->getLocalKeyName(), $keyMessage);

        // Test second key.
        $secondKeyMessage = "The second foreing key $key doesn't match with the relation second foreing key {$relation->getForeignKeyName()}";
        $this->assertEquals($secondLocalKey, $relation->getSecondLocalKeyName(), $secondKeyMessage);

        // Test local key.
        $localKeyMessage = "The local key $key doesn't match with the relation local key {$relation->getLocalKeyName()}";
        $this->assertEquals($key, $relation->getFirstKeyName(), $localKeyMessage);

        // Test second local key.
        $secondLocalKeyMessage = "The second local key $key doesn't match with the relation second local key {$relation->getLocalKeyName()}";
        $this->assertEquals($secondKey, $relation->getForeignKeyName(), $secondLocalKeyMessage);

        // Test query.
        $this->queryCheck($queryCheck, $model, $relation);
    }

    /**
     * Assert query has not been modified or modified properly.
     *
     * @param \Closure $queryCheck
     * @param Model $model
     * @param mixed $relation
     * @return void
     */
    private function queryCheck(\Closure $queryCheck = null, $model, $relation)
    {
        if (!is_null($queryCheck)) {
            $queryCheck->bindTo($this);
            $queryCheck($relation->getQuery(), $model, $relation);
        }
    }

    /**
     * Test mutators.
     *
     * @param Model $model
     * @param string $field
     * @param mixed $value
     * @param mixed $expected
     * @return void
     */
    public function assertModelMutator(Model $model, string $field, $value = null, $expected = null, bool $forceTest = false)
    {
        // Test if the mutator exists
        $modelClass = get_class($model);
        $methodName = "set". Str::ucfirst(Str::camel($field)) ."Attribute";
        $mutatorError = "The class {$modelClass} doesn't had the mutator {$methodName}";
        $this->assertHasMethod($modelClass, $methodName, $mutatorError);

        // Test if the mutator works
        if (($value !== null || $expected !== null) || $forceTest) {
            $model->$methodName($value);

            $mutatingError = "The mutator {$methodName} doesn't change the value {$value} into {$expected}";
            $this->assertEquals($expected, $model->$field, $mutatingError);
        }
    }

    /**
     * Test scopes.
     *
     * @param Model $model
     * @param string $scope
     * @return void
     */
    public function assertModelScope(Model $model, string $scope)
    {
        $modelClass = get_class($model);
        $scope = 'scope' . Str::ucfirst($scope);

        $scopeError = "The model {$modelClass} doesn't have the scope {$scope}";
        $this->assertHasMethod(get_class($model), $scope, $scopeError);
    }

    /**
     * Test factory.
     *
     * @param Model $model
     * @return void
     */
    public function assertModelFactory(Model $model)
    {
        $modelClass = get_class($model);
        $errorMessage = "The model {$modelClass} doesn't have a factory";
        $this->assertHasMethod($modelClass, 'factory', $errorMessage);
        
        $errorMessage = "The model {$modelClass} can't be maked";
        $this->assertInstanceOf($modelClass, $model->factory()->make(), $errorMessage);
    }
}
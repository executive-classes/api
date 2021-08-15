<?php

namespace Tests\Unit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

abstract class ModelTestCase extends TestCase
{
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
        'fillable' => [],
        'guarded' => ['*'],
        'casts' => ['id' => 'int'],
        'visible' => [],
        'hidden' => [],
        'connection' => null
    ];

    /**
     * Run model default assertions.
     *
     * @param Model|mixed $model
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
    protected function assertBelongsToRelation(
        $relation, 
        $model, 
        string $key, 
        string $ownerKey = 'id', 
        \Closure $queryCheck = null
    ) {
        // Test relation.
        $this->assertInstanceOf(BelongsTo::class, $relation);

        // Test foreing key.
        $this->assertEquals($key, $relation->getForeignKeyName());

        // Test owner key.
        $this->assertEquals($ownerKey, $relation->getOwnerKeyName());

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
    protected function assertHasManyRelation(
        $relation, 
        $model, 
        string $key, 
        string $localKey = 'id', 
        \Closure $queryCheck = null
    ) {
        // Test relation.
        $this->assertInstanceOf(HasMany::class, $relation);

        // Test foreing key.
        $this->assertEquals($key, $relation->getForeignKeyName());

        // Test local key.
        $this->assertEquals($localKey, $relation->getLocalKeyName());

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
    protected function assertBelongsToManyRelation(
        $relation, 
        $model, 
        string $table,
        string $key, 
        string $ownerKey, 
        \Closure $queryCheck = null
    ) {
        // Test relation.
        $this->assertInstanceOf(BelongsToMany::class, $relation);

        // Test pivot table.
        $this->assertEquals($table, $relation->getTable());

        // Test foreing key.
        $this->assertEquals($key, $relation->getForeignPivotKeyName());

        // Test owner key.
        $this->assertEquals($ownerKey, $relation->getRelatedPivotKeyName());

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

}
<?php

namespace Database\Factories;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Factories\Factory as DefaultFactory;

abstract class Factory extends DefaultFactory
{
    /**
     * @var string
     */
    protected $operation = 'make';

    /**
     * Create a new factory instance.
     *
     * @param  string|null  $operation
     * @param  int|null  $count
     * @param  \Illuminate\Support\Collection|null  $states
     * @param  \Illuminate\Support\Collection|null  $has
     * @param  \Illuminate\Support\Collection|null  $for
     * @param  \Illuminate\Support\Collection|null  $afterMaking
     * @param  \Illuminate\Support\Collection|null  $afterCreating
     * @param  string|null  $connection
     * @return void
     */
    public function __construct(
        $operation = null,
        $count = null,
        ?Collection $states = null,
        ?Collection $has = null,
        ?Collection $for = null,
        ?Collection $afterMaking = null,
        ?Collection $afterCreating = null,
        $connection = null
    ) {
        $this->operation = $operation ?? 'make';
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);
    }

    /**
     * Persist the relations.
     *
     * @param  bool  $persist
     * @return static
     */
    public function persist(bool $persist = true)
    {
        $operation = $persist ? 'create' : 'make';
        return $this->newInstance(['operation' => $operation]);
    }

    /**
     * Create a new instance of the factory builder with the given mutated properties.
     *
     * @param  array  $arguments
     * @return static
     */
    protected function newInstance(array $arguments = [])
    {
        return new static(...array_values(array_merge([
            'operation' => $this->operation,
            'count' => $this->count,
            'states' => $this->states,
            'has' => $this->has,
            'for' => $this->for,
            'afterMaking' => $this->afterMaking,
            'afterCreating' => $this->afterCreating,
            'connection' => $this->connection,
        ], $arguments)));
    }

    /**
     * Returns a created or maked relation.
     *
     * @param string $relation
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    protected function relation(string $relation)
    {
        $factory = $relation::factory();

        if ($this->operation == 'create') {
            $factory = $factory->persist();
        }
        
        return $factory->{$this->operation}();
    }
}
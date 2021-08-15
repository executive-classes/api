<?php

namespace Tests\Unit\System;

use App\Enums\System\AuditLogTypeEnum;
use App\Services\System\AuditLogService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Providers\System\AuditLogProvider;
use Tests\Providers\System\RequestProvider;
use Tests\TestCase;
use Tests\UseUsers;

class AuditLogTest extends TestCase
{
    use RefreshDatabase, WithFaker, UseUsers, AuditLogProvider, RequestProvider;

    /**
     * Indicates that the database should seed.
     *
     * @var bool
     */
    protected $seed = true;
    
    /**
     * Test Set Up.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test if a model insert can audit.
     * 
     * @dataProvider getModelsForInsert
     *
     * @param callable $provider
     * @return void
     */
    public function test_insert_model_can_audit(callable $provider)
    {
        [$request, $model] = $provider();

        $modelInstance = $model::factory()->create();
        $log = AuditLogService::insert($request, $modelInstance);

        $this->assertDatabaseHas('system_auditlog', ['id' => $log->id]);
        $this->assertEquals(AuditLogTypeEnum::INSERT, $log->type);
        $this->assertEquals($modelInstance->getTable(), $log->table);
        $this->assertEquals([], json_decode($log->before, true));
        $this->assertEquals($modelInstance->getAttributes(), json_decode($log->after, true));
    }

    /**
     * Test if a model update can audit.
     * 
     * @dataProvider getModelsForUpdate
     *
     * @param callable $provider
     * @return void
     */
    public function test_update_model_can_audit(callable $provider)
    {
        [$request, $model, $data] = $provider();

        foreach ($data as $key => $value) {
            if (in_array($key, $model->getGuarded())) {
                continue;
            }

            $model->$key = $value;
        }
        $model->save();

        $log = AuditLogService::update($request, $model);

        $this->assertDatabaseHas('system_auditlog', ['id' => $log->id]);
        $this->assertEquals(AuditLogTypeEnum::UPDATE, $log->type);
        $this->assertEquals($model->getTable(), $log->table);
        $this->assertEquals(array_intersect_key($model->getRawOriginal(), $model->getChanges()), json_decode($log->before, true));
        $this->assertEquals($model->getChanges(), json_decode($log->after, true));
    }

    /**
     * Test if a model delete can audit.
     * 
     * @dataProvider getModelsForDelete
     *
     * @param callable $provider
     * @return void
     */
    public function test_delete_model_can_audit(callable $provider)
    {
        [$request, $model] = $provider();
        
        $model->delete();
        $log = AuditLogService::delete($request, $model);

        $this->assertDatabaseHas('system_auditlog', ['id' => $log->id]);
        $this->assertEquals(AuditLogTypeEnum::DELETE, $log->type);
        $this->assertEquals($model->getTable(), $log->table);
        $this->assertEquals($model->getAttributes(), json_decode($log->before, true));
        $this->assertEquals([], json_decode($log->after, true));
    }

    /**
     * Test if a changed model can audit with the provided relation data.
     *
     * @dataProvider getModel
     *
     * @param callable $provider
     * @return void
     */
    public function test_audit_can_log_relations_info(callable $provider)
    {
        [$request, $model] = $provider();
        
        $modelInstance = $model::factory()->create();
        $primaryKey = $modelInstance->getKeyName();
        $relations = ['model_id' => $modelInstance->$primaryKey];
        
        $log = AuditLogService::insert($request, $modelInstance, $relations);

        $this->assertDatabaseHas('system_auditlog', ['id' => $log->id]);
        $this->assertContains($relations['model_id'], json_decode($log->relations, true));
    }

    /**
     * Test if a changed model can audit with the request data.
     * 
     * @dataProvider getModel
     *
     * @param callable $provider
     * @return void
     */
    public function test_audit_can_log_request_info(callable $provider)
    {
        [$request, $model] = $provider();

        $modelInstance = $model::factory()->create();
        $log = AuditLogService::insert($request, $modelInstance);

        $this->assertDatabaseHas('system_auditlog', ['id' => $log->id]);
        $this->assertEquals($log->agent, $request->userAgent());
        $this->assertEquals($log->url, $request->fullUrl());
        $this->assertEquals($log->method, $request->method());
        $this->assertEquals($log->route, $request->route()->getName());
        $this->assertIsBool($log->ajax);
    }

    /**
     * Test if a changed model can audit with the Auth data.
     *
     * @dataProvider getModelWithAutentication
     * 
     * @param callable $provider
     * @return void
     */
    public function test_audit_can_log_user_info(callable $provider)
    {
        [$request, $model] = $provider();
        $user = $request->user();

        $modelInstance = $model::factory()->create();
        $log = AuditLogService::insert($request, $modelInstance);

        $this->assertDatabaseHas('system_auditlog', ['id' => $log->id]);
        $this->assertEquals($user ? $user->id : null, $log->user_id);
        $this->assertEquals($user ? $user->crossId() : null, $log->cross_user_id);
    }

    
}

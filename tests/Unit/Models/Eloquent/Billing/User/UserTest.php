<?php

namespace Tests\Unit\Models\Eloquent\Billing;

use App\Models\Eloquent\Billing\User\User;
use Tests\Unit\Models\Eloquent\ModelTestCase;
use App\Enums\System\SystemLanguageEnum;
use Tests\Unit\Traits\Models\HasTaxAsserts;
use Tests\Unit\Traits\Models\HasPhoneAsserts;
use Tests\Unit\Traits\Models\HasTokenAsserts;
use Tests\Unit\Traits\Models\HasFilterAsserts;
use Tests\Unit\Traits\Models\HasFactoryAsserts;
use Tests\Unit\Traits\Models\HasLanguageAsserts;
use Tests\Unit\Traits\Models\HasPrivilegesAsserts;
use Tests\Unit\Traits\Models\HasAuthenticationAsserts;
use Tests\Unit\Traits\Models\HasCrossAuthAuthenticationAsserts;

class UserTest extends ModelTestCase
{
    use HasFactoryAsserts; 
    use HasFilterAsserts; 
    use HasTokenAsserts;
    use HasAuthenticationAsserts;
    use HasCrossAuthAuthenticationAsserts;
    use HasLanguageAsserts;
    use HasPrivilegesAsserts;
    use HasTaxAsserts; 
    use HasPhoneAsserts;

    /**
     * @var User
     */
    protected $model;

    /**
     * @var string
     */
    protected $modelClass = User::class;

    public function test_model()
    {
        $this->runModelAssertions($this->model, [
            'table' => 'user',
            'attributes' => [
                'active' => true,
                'system_language_id' => SystemLanguageEnum::PT_BR
            ],
            'fillable' => [
                'name',
                'email',
                'password',
                'password_reminder',
                'tax_type_id',
                'tax_code',
                'tax_type_alt_id',
                'tax_code_alt',
                'phone',
                'phone_alt',
                'system_language_id'
            ],
            'casts' => [
                'id' => 'int',
                'active' => 'boolean'
            ],
            'hidden' => [
                'password'
            ]
        ]);
    }

    public function test_tax_type_relation()
    {
        $relation = $this->model->taxType();

        $this->assertBelongsToRelation($relation, $this->model, 'tax_type_id');
    }

    public function test_tax_type_alt_relation()
    {
        $relation = $this->model->taxTypeAlt();

        $this->assertBelongsToRelation($relation, $this->model, 'tax_type_alt_id');
    }

    public function test_language_relation()
    {
        $relation = $this->model->language();

        $this->assertBelongsToRelation($relation, $this->model, 'system_language_id');
    }

    public function test_privileges_relation()
    {
        $relation = $this->model->privileges();

        $this->assertBelongsToManyRelation($relation, $this->model, 'privilege_x_user', 'user_id', 'user_privilege_id');
    }

    public function test_customers_relation()
    {
        $relation = $this->model->customers();

        $this->assertBelongsToManyRelation($relation, $this->model, 'customer_x_user', 'user_id', 'customer_id');
    }
    
    public function test_employee_relation()
    {
        $relation = $this->model->employee();

        $this->assertHasOneRelation($relation, $this->model, 'user_id');
    }

    public function test_teacher_relation()
    {
        $relation = $this->model->teacher();

        $this->assertHasOneRelation($relation, $this->model, 'user_id');
    }

    public function test_student_relation()
    {
        $relation = $this->model->student();

        $this->assertHasOneRelation($relation, $this->model, 'user_id');
    }

    public function test_password_mutator()
    {
        $this->assertModelMutator($this->model, 'password');
    }

    public function test_active_scope()
    {
        $this->assertModelScope($this->model, 'active');
    }

    public function test_inactive_scope()
    {
        $this->assertModelScope($this->model, 'inactive');
    }

    public function test_role_scope()
    {
        $this->assertModelScope($this->model, 'role');
    }

    public function test_admin_scope()
    {
        $this->assertModelScope($this->model, 'admin');
    }

    public function test_dev_scope()
    {
        $this->assertModelScope($this->model, 'dev');
    }
}
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMangeRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mange_roles', function (Blueprint $table) {
            $table->bigIncrements('mange_role_id');
            $table->integer('admin_type')->index();
            $table->tinyInteger('admintype_view')->default(0);
            $table->tinyInteger('admintype_create')->default(0);
            $table->tinyInteger('admintype_update')->default(0);
            $table->tinyInteger('admintype_delete')->default(0);
            $table->tinyInteger('admins_user_view')->default(0);
            $table->tinyInteger('admins_user_create')->default(0);
            $table->tinyInteger('admins_user_update')->default(0);
            $table->tinyInteger('admins_user_delete')->default(0);
            $table->tinyInteger('company_view')->default(0);
            $table->tinyInteger('company_create')->default(0);
            $table->tinyInteger('company_update')->default(0);
            $table->tinyInteger('company_delete')->default(0);
            $table->tinyInteger('company_branch_view')->default(0);
            $table->tinyInteger('company_branch_create')->default(0);
            $table->tinyInteger('company_branch_update')->default(0);
            $table->tinyInteger('company_branch_delete')->default(0);
            $table->tinyInteger('company_branch_question_view')->default(0);
            $table->tinyInteger('company_branch_question_assign')->default(0);
            $table->tinyInteger('company_branch_question_delete')->default(0);
            $table->tinyInteger('company_user_view')->default(0);
            $table->tinyInteger('company_user_create')->default(0);
            $table->tinyInteger('company_user_update')->default(0);
            $table->tinyInteger('company_user_delete')->default(0);
            $table->tinyInteger('question_view')->default(0);
            $table->tinyInteger('question_create')->default(0);
            $table->tinyInteger('question_update')->default(0);
            $table->tinyInteger('question_delete')->default(0);
            $table->tinyInteger('question_options_view')->default(0);
            $table->tinyInteger('question_options_create')->default(0);
            $table->tinyInteger('question_options_update')->default(0);
            $table->tinyInteger('question_options_delete')->default(0);
            $table->tinyInteger('customer_review_view')->default(0);
            $table->tinyInteger('customer_review_mail')->default(0);
            $table->tinyInteger('customer_review_delete')->default(0);

            $table->timestamps();
        });
        $data = [
                 [
                    'admin_type'                        => 1,
                    'admintype_view'                    => 1,
                    'admintype_create'                  => 1,
                    'admintype_update'                  => 1,
                    'admintype_delete'                  => 1,
                    'admins_user_view'                  => 1,
                    'admins_user_create'                => 1,
                    'admins_user_update'                => 1,
                    'admins_user_delete'                => 1,
                    'company_view'                      => 1,  
                    'company_create'                    => 1,      
                    'company_update'                    => 1,
                    'company_delete'                    => 1,
                    'company_branch_view'               => 1,
                    'company_branch_create'             => 1,
                    'company_branch_update'             => 1,
                    'company_branch_delete'             => 1,
                    'company_branch_question_view'      => 1,
                    'company_branch_question_assign'    => 1,
                    'company_branch_question_delete'    => 1,
                    'company_user_view'                 => 1,
                    'company_user_create'               => 1,
                    'company_user_update'               => 1,
                    'company_user_delete'               => 1,
                    'question_view'                     => 1,
                    'question_create'                   => 1,
                    'question_update'                   => 1,
                    'question_delete'                   => 1,
                    'question_options_view'             => 1,
                    'question_options_create'           => 1,
                    'question_options_update'           => 1,
                    'question_options_delete'           => 1,
                    'customer_review_view'              => 1,
                    'customer_review_mail'              => 1,
                    'customer_review_delete'            => 1,
                    'created_at'                        => new DateTime(),
                    'updated_at'                        => new DateTime(),
                ],
                [
                    'admin_type'                         => 2,
                    'admintype_view'                     => 0,
                    'admintype_create'                   => 0,
                    'admintype_update'                   => 0,
                    'admintype_delete'                   => 0,
                    'admins_user_view'                   => 0,
                    'admins_user_create'                 => 0,
                    'admins_user_update'                 => 0,
                    'admins_user_delete'                 => 0,
                    'company_view'                       => 0,  
                    'company_create'                     => 0,      
                    'company_update'                     => 0,
                    'company_delete'                     => 0,
                    'company_branch_view'                => 1,
                    'company_branch_create'              => 1,
                    'company_branch_update'              => 1,
                    'company_branch_delete'              => 1,
                    'company_branch_question_view'       => 1,
                    'company_branch_question_assign'     => 1,
                    'company_branch_question_delete'     => 1,
                    'company_user_view'                  => 1,
                    'company_user_create'                => 1,
                    'company_user_update'                => 1,
                    'company_user_delete'                => 1,
                    'question_view'                      => 1,
                    'question_create'                    => 1,
                    'question_update'                    => 1,
                    'question_delete'                    => 1,
                    'question_options_view'              => 1,
                    'question_options_create'            => 1,
                    'question_options_update'            => 1,
                    'question_options_delete'            => 1,
                    'customer_review_view'               => 1,
                    'customer_review_mail'               => 1,
                    'customer_review_delete'             => 1,
                    'created_at'                         => new DateTime(),
                    'updated_at'                         => new DateTime(),
                ]
        ];
        DB::table('mange_roles')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mange_roles');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_types', function (Blueprint $table) {
            $table->bigIncrements('admin_type_id');
            $table->string('admin_type_name');
            $table->integer('admin_type_is_active');
            $table->integer('admin_type_enable_to_company');
            $table->timestamps();
        });
        $data = [
                 [
                'admin_type_name'                   => 'Super Admin',
                'admin_type_is_active'              => 1,
                'admin_type_enable_to_company'      => 0,
                'created_at'                        => new DateTime(),
                'updated_at'                        => new DateTime(),
            ],
            [
                'admin_type_name'                   => 'Company User',
                'admin_type_is_active'              => 1,
                'admin_type_enable_to_company'      => 0,
                'created_at'                        => new DateTime(),
                'updated_at'                        => new DateTime(),
            ],
        ];
        DB::table('admin_types')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_types');
    }
}

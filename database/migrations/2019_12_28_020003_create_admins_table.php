<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('admin_id');
            $table->string('admin_name');
            $table->string('admin_username')->unique();
            $table->string('admin_email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('admin_password');
            $table->integer('admin_status');
            $table->integer('admin_type')->index();
            $table->rememberToken();
            $table->timestamps();
        });
         DB::table('admins')->insert([
           'admin_name'     => 'Super Admin',
           'admin_username' => 'super_admin',
           'admin_password' => Hash::make('123456789'),
           'admin_status'   => 1,
           'admin_type'     => 1,
           'created_at'     => new DateTime(),
           'updated_at'     => new DateTime(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('setting_id');
            $table->string('setting_key',50)->unique();
            $table->string('setting_value')->nullable();
            $table->timestamps();
        });
        $data =[
            [
               'setting_key'    => 'MAIL_DRIVER',
               'setting_value'    => null,
               'created_at'     => new DateTime(),
            ],
            [
               'setting_key'   => 'MAIL_HOST',
               'setting_value'    => null,
               'created_at'     => new DateTime(),
            ],
            [
               'setting_key'   => 'MAIL_PORT',
               'setting_value'    => null,
               'created_at'     => new DateTime(),
            ],
            [
               'setting_key'   => 'MAIL_USERNAME',
               'setting_value'    => null,
               'created_at'     => new DateTime(),
            ],
            [
               'setting_key'   => 'MAIL_PASSWORD',
               'setting_value'    => null,
               'created_at'     => new DateTime(),
            ],
            [
               'setting_key'   => 'MAIL_ENCRYPTION',
               'setting_value'    => null,
               'created_at'     => new DateTime(),
            ],
        ];
        DB::table('settings')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}

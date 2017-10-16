<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('records' , function (Blueprint $table){
            $table->comment = '记录列表';

            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('line')->nullable();
            $table->string('line_id')->nullable();
            $table->string('type')->nullable();
            $table->string('ttl')->nullable();
            $table->string('value')->nullable();
            $table->string('weight')->nullable();
            $table->string('mx')->nullable();
            $table->string('enabled')->nullable();
            $table->string('status')->nullable();
            $table->string('monitor_status')->nullable();
            $table->string('remark')->nullable();
            $table->string('use_aqb')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('records');
    }
}

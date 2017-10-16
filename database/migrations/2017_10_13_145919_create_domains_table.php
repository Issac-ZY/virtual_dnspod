<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->comment = '域名列表';

            $table->increments('id');
    
            $table->string('status')->nullable(); 
            $table->string('grade')->nullable();
            $table->string('group_id')->nullable();
            $table->string('searchengine_push')->nullable();
            $table->string('is_mark')->nullable();
            $table->string('ttl')->nullable();
            $table->string('cname_speedup')->nullable();
            $table->string('remark')->nullable();
            $table->string('punycode')->nullable();
            $table->string('ext_status')->nullable();
            $table->string('src_flag')->nullable();
            $table->string('name')->nullable();            
            $table->string('grade_title')->nullable();
            $table->string('is_vip')->nullable();
            $table->string('owner')->nullable();
            $table->string('records')->nullable();
            $table->string('auth_to_anquanbao')->nullable();
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
        Schema::dropIfExists('domains');
    }
}

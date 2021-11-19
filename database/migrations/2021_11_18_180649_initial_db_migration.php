<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialDbMigration extends Migration
{
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            
            $table->uuid("uuid")->unique();
            
            
            $table->string("url")->nullable();
            $table->string("name")->nullable();
            
            $table->string("epg1")->nullable();
            $table->string("epg2")->nullable();
            $table->string("epg3")->nullable();
            
            $table->string("stream_url")->nullable();

            $table->string("image")->nullable();

            $table->string("extra_text1")->nullable();
            $table->string("extra_text2")->nullable();
            $table->string("extra_text3")->nullable();
            $table->string("extra_text4")->nullable();
            $table->string("extra_text5")->nullable();

            $table->boolean("ffmpeg")->default(0);
            $table->boolean("active")->default(1);

            $table->integer("pos")->nullable();


        });

        Schema::create('channels_packages', function (Blueprint $table) {
            $table->bigInteger("channel_id")->unsigned();
            $table->bigInteger("package_id")->unsigned();
            $table->unique(['channel_id', 'package_id'], 'channel_package_uniq_idx');
            $table->index(['package_id','channel_id'], 'package_channel_idx');
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string("name");
        });


        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid("uuid")->unique();
            $table->string("short_url", 12)->unique();
            $table->string("name");
            $table->string("comment")->nullable();
            $table->string("mac")->nullable();
            $table->uuid("token")->nullable()->unique();
            $table->bigInteger("package_id")->unsigned();
            $table->boolean("active");
            $table->timestamp("seen")->nullable();
            $table->ipAddress("ip_addr")->nullable();
            
            $table->integer("type_id")->nullable();
            
            $table->string("extra_text1")->nullable();
            $table->string("extra_text2")->nullable();
            $table->string("extra_text3")->nullable();
            $table->string("extra_text4")->nullable();
            $table->string("extra_text5")->nullable();
        });
        
        Schema::create('settings', function (Blueprint $table) {
            $table->string("key")->primary();
            $table->string("value")->nullable();
        });
        

    }
    
    public function down()
    {
        Schema::dropIfExists('channels');
        Schema::dropIfExists('users');
        Schema::dropIfExists('channels_packages');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('clients');
        Schema::dropIfExists('settings');
    }
}

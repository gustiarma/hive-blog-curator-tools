<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HiveCommunities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hive_communities', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->integer('id');
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('about')->nullable();
            $table->string('lang')->nullable();
            $table->boolean('type_id')->nullable();
            $table->boolean('is_nsfw')->nullable();
            $table->integer('subscribers')->nullable();
            $table->integer('sum_pending')->nullable();
            $table->integer('num_pending')->nullable();
            $table->integer('num_authors')->nullable();
            $table->timestamp('community_created_at');
            $table->string('avatar_url')->nullable();
            $table->text('admins')->nullable();

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
        Schema::dropIfExists('hive_communities');
    }
}

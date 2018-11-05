<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('topics')) {
            Schema::create('topics', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->unique();
                $table->string('slug');
                $table->string('images')->nullable();
                $table->tinyInteger('set_time')->default(0)->comment('0 - No Timer, 1 - Timer');
                $table->string('select_time')->nullable();
                $table->tinyInteger('status')->default(0)->comment('0 - Deactivate, 1 - Active');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('topics');
    }
}

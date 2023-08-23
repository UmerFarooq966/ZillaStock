<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('userid');
            $table->string('name');
            $table->integer('catid');
            $table->text('detail');

            $table->tinyInteger('state')->default(0);
            // 0 -> not verified 1 -> verified 3 -> rejected
            $table->tinyInteger('team_id')->default(null);

            $table->string('image');

            $table->unsignedInteger('reported')->default(null);
            $table->unsignedInteger('report_count')->default(0);
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
        Schema::dropIfExists('images');
    }
};

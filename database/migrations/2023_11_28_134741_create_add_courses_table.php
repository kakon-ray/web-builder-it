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
        Schema::create('add_courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_title')->nullable();
            $table->string('instructor')->nullable();
            $table->string('duration')->nullable();
            $table->string('lectures')->nullable();
            $table->string('language')->nullable();
            $table->string('projects')->nullable();
            $table->boolean('status')->default(false);
            $table->decimal('course_fee', 13, 0)->nullable();
            $table->decimal('new_course_fee', 13, 0)->nullable();
            $table->string('course_img')->nullable();
            $table->string('desc',2000)->nullable();
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
        Schema::dropIfExists('add_courses');
    }
};

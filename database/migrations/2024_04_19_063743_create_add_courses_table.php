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
            $table->unsignedBigInteger('coursecategory_id')->nullable();
            $table->string('batch')->nullable();
            $table->string('course_title')->nullable();
            $table->integer('instructor')->nullable();
            $table->string('duration')->nullable();
            $table->string('lectures')->nullable();
            $table->string('language')->nullable();
            $table->string('projects')->nullable();
            $table->integer('review_count')->nullable();
            $table->integer('enrole_count')->nullable();
            $table->boolean('status')->default(false);
            $table->decimal('course_fee', 13, 0)->nullable();
            $table->decimal('new_course_fee', 13, 0)->nullable();
            $table->decimal('spacial_discount', 13, 0)->default(0);
            $table->string('course_img')->nullable();
            $table->text('desc',2000)->nullable();
            $table->timestamps();
            $table->foreign('coursecategory_id')->references('id')->on('coursecategories')->onDelete('cascade');

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

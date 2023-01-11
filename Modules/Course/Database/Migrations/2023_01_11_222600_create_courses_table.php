<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->enum("type",['online','offline'])->nullable();
            $table->enum("for",['managers','employees'])->nullable();
            $table->string('title')->nullable();
            $table->longText('description')->nullable();
            $table->longText('features')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_desc')->nullable();
            //offline
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('courses');
    }
};

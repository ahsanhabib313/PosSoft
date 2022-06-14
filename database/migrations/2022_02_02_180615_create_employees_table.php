<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('designation_id'); 
            $table->string('photo')->default(null);
            $table->bigInteger('phone');
            $table->bigInteger('nid');
            $table->text('address');
            $table->bigInteger('salary');
            $table->string('gender'); 
            $table->date('joining_date');
            $table->date('leaving_date')->default(null);
            $table->string('is_leave'); //  is_leave = 0 means the employee is working still 
            $table->timestamps();

            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}

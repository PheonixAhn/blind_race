<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_type_keyword', function (Blueprint $table) {
            $table->char('keyword', 1);
	    $table->string('name', 32);
	    $table->primary('keyword');
        });

        DB::table('quiz_type_keyword')->insert([
	    ['keyword' => 'o', 'name' => 'objective'],
	    ['keyword' => 's', 'name' => 'subjective'],
	    ['keyword' => 't', 'name' => 'set word'],
	    ['keyword' => 'w', 'name' => 'word']
        ]);

        Schema::create('quiz_set_state_keyword', function (Blueprint $table) {
            $table->char('keyword', 1);
	    $table->string('name', 32);
	    $table->primary('keyword');
        });

        DB::table('quiz_set_state_keyword')->insert([
	    ['keyword' => 'b', 'name' => 'base quiz'],
	    ['keyword' => 'n', 'name' => 'no set exam'],
	    ['keyword' => 'y', 'name' => 'yes set exam']
        ]);

        Schema::create('quiz_bank', function (Blueprint $table) {
            $table->increments('quiz_num');
	    $table->unsignedInteger('book_num')->nullable();
	    $table->foreign('book_num')->references('book_num')->on('books');
	    $table->unsignedSmallInteger('book_page')->nullable();
	    $table->json('quiz_question');
            $table->char('quiz_type', 1);
	    $table->foreign('quiz_type')->references('keyword')->on('quiz_type_keyword');
	    $table->unsignedInteger('quiz_count_set_exam')->default(0);
	    $table->unsignedInteger('quiz_count_mistaken')->default(0);
            $table->char('quiz_level', 1);
	    $table->unsignedInteger('user_t_num')->nullable();
            $table->char('quiz_set_state', 1);
	    $table->foreign('quiz_set_state')->references('keyword')->on('quiz_set_state_keyword');
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
    }
}

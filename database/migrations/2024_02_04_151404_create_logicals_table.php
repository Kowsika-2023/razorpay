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
        Schema::create('logicals', function (Blueprint $table) {
            $table->id();
            $table->boolean('type')->default(1)->comment('1->rs,2->palindrome,3->num_digits,4->occurence_of_char,5->non-matching_char,6->anagram,7->vowel_consonant,8->matching_integer,9->ra,10->me,11->ao,12->fibo,13->mtddlee,14->nr,15->ms');
            $table->string('title')->nullable();
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
        Schema::dropIfExists('logicals');
    }
};

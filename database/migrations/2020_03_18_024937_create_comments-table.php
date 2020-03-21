<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->unsignedBigInteger( 'profile_id')->nullable();
            $table->unsignedBigInteger( 'tweet_id' )->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign( 'profile_id' )
                ->references( 'id' )
                ->on( 'profiles' )
                ->onDelete( 'cascade' );

            $table->foreign( 'tweet_id' )
                ->references( 'id' )
                ->on( 'tweets' )
                ->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}

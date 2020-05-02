<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();
            $table->string( 'photo' )->nullable();
            $table->longText( 'message' );
            $table->unsignedBigInteger( 'profile_id' )->nullable();
            $table->timestamp('posted_at');
            $table->integer('likes_count')->default(0);
            $table->boolean('is_gif')->default ( false );
            $table->softDeletes();

           // $table->foreign( 'profile_id' )
             //   ->references( 'id' )
               // ->on( 'profiles' )
               // ->onDelete( 'cascade' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}

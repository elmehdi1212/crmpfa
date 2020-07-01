<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCommentsTable extends Migration
{
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedInteger('reclamation_id')->nullable();

            $table->foreign('reclamation_id', 'reclamation_fk_583774')->references('id')->on('reclamations');

            $table->unsignedInteger('user_id')->nullable();

            $table->foreign('user_id', 'user_fk_583777')->references('id')->on('users');
        });
    }
}

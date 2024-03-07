<?php

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class);
            $table->foreignIdFor(Classroom::class);
            $table->integer('note1')->unsigned()->nullable();
            $table->integer('note2')->unsigned()->nullable();
            $table->integer('note3')->unsigned()->nullable();
            $table->integer('note4')->unsigned()->nullable();
            $table->integer('average')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    public function up()
    {
        // Check if the 'staff' table exists before creating it
        if (!Schema::hasTable('staff')) {
            Schema::create('staff', function (Blueprint $table) {
                $table->id(); // Primary key
                $table->string('name');
                $table->string('father_name');
                $table->string('email')->unique();
                $table->date('dob');
                $table->string('aadhar_number', 12)->unique();
                $table->string('phone_number', 10)->unique();
                $table->enum('gender', ['male', 'female', 'others']);
                $table->string('image')->nullable();
                $table->timestamps(); // created_at, updated_at
            });
        }

        // Creating the experience table to store experience-related details
        if (!Schema::hasTable('experiences')) {
            Schema::create('experiences', function (Blueprint $table) {
                $table->id();
                $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade');
                $table->foreignId('cadre_id')->constrained('cadres')->onDelete('cascade');
                $table->foreignId('office_id')->constrained('offices')->onDelete('cascade');
                $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
                $table->date('joining_date');
                $table->date('relieving_date')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('staff');
    }
}

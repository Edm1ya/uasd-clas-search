<?php

use App\Models\Schedule;
use App\Models\SubjectModality;
use App\Models\SubjectType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('RNC');
            $table->string('key');
            $table->string('name');
            $table->string('section');
            $table->foreignIdFor(SubjectModality::class)->constrained();
            $table->string('campus');
            $table->foreignIdFor(SubjectType::class)->nullable()->constrained();
            $table->foreignIdFor(Schedule::class)->nullable()->constrained();
            $table->string('classroom')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};

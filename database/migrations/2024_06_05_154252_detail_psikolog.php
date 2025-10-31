<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_psikolog', function (Blueprint $table) {
            $table->unsignedBigInteger('id_psikolog')->primary();
            $table->foreign('id_psikolog')->references('model_id')->on('model_has_roles')
                ->where('model_type', 'App\Models\User')
                ->whereIn('role_id', function ($query) {
                    $query->select('id')->from('roles')->where('name', 'psikolog');
                })->onDelete('cascade')->onUpdate('cascade');
            $table->text('bio')->nullable();
            $table->integer('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_psikolog');
    }
};
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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('url');
            $table->string('thumbnail')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Register permission
        try {
            if (Schema::hasTable('permissions') && Schema::hasTable('roles')) {
                $permission = \Spatie\Permission\Models\Permission::firstOrCreate(['name' => 'manage videos']);
                $adminRole = \Spatie\Permission\Models\Role::where('name', 'Admin')->first();
                if ($adminRole) {
                    $adminRole->givePermissionTo($permission);
                }
            }
        } catch (\Exception $e) {
            // Ignore if Spatie classes or tables aren't loaded/ready
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');

        try {
            if (Schema::hasTable('permissions')) {
                \Spatie\Permission\Models\Permission::where('name', 'manage videos')->delete();
            }
        } catch (\Exception $e) {
            // Ignore
        }
    }
};

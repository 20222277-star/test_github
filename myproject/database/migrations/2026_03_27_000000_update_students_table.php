<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Cập nhật bảng students: thay đổi từ (name, email, age) → (name, major)
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Xóa các cột cũ
            $table->dropColumn(['email', 'age']);
            
            // Thêm cột mới cho ngành học
            $table->string('major')->after('name')->default('Chưa xác định');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Hoàn lại trạng thái cũ (nếu rollback)
            $table->dropColumn(['major']);
            $table->string('email')->nullable();
            $table->integer('age')->nullable();
        });
    }
};

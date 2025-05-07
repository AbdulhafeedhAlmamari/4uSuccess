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
        Schema::create('finance_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financing_company_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->text('description');
            $table->decimal('amount', 10, 2);
            $table->integer('iban');
            $table->integer('installment_period');
            $table->decimal('total_paid', 10, 2)->default(0);
            $table->string('finance_type');
            // أوافق على جميع البيانات المدخلة صحيحة وأتحمل مسؤوليتها.
            $table->boolean('is_agreed')->default(false);
            // أوافق على الشروط والأحكام الخاصة بطلب التمويل.
            $table->string('terms_and_conditions')->default('0');
            // حالة الطلب (قيد المراجعة، مكتمل، مرفوض، مقبول)
            $table->string('status')->default('under_review');
            // رد الشركة على الطلب
            $table->longText('reply')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_requests');
    }
};

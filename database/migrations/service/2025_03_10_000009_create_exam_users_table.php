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
        Schema::create('exam_users', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_exam_users', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('exam_users');
        Schema::dropIfExists('_history_exam_users');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
        }

        $table->unsignedBigInteger('exam_id')->comment('ID Exam');
        $table->json('exams_data')->comment('Data Ujian');
        $table->decimal('score', 5, 2)->nullable();
        $table->decimal('minimal_score', 5, 2)->nullable();
        $table->text('summary_message')->comment('Pesan Kesimpulan');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};

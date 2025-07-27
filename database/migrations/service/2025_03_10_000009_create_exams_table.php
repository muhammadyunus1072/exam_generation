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
        Schema::create('exams', function (Blueprint $table) {
            $this->scheme($table, false);
        });

        Schema::create('_history_exams', function (Blueprint $table) {
            $this->scheme($table, true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('exams');
        Schema::dropIfExists('_history_exams');
    }

    private function scheme(Blueprint $table, $is_history = false)
    {
        $table->id();

        if ($is_history) {
            $table->bigInteger('obj_id')->unsigned();
        } else {
        }

        $table->string('level')->comment('Jenjang Pendidikan');
        $table->string('grade')->comment('Kelas');
        $table->string('subject')->comment('Mata Pelajaran');
        $table->unsignedInteger('question_amount')->comment('Jumlah Soal');
        $table->unsignedInteger('minimal_score')->nullable()->comment('Nilai Minimal Lulus');
        $table->json('exams_data')->comment('Data Ujian');

        $table->bigInteger("created_by")->unsigned()->nullable();
        $table->bigInteger("updated_by")->unsigned()->nullable();
        $table->bigInteger("deleted_by")->unsigned()->nullable()->default(null);
        $table->softDeletes();
        $table->timestamps();
    }
};

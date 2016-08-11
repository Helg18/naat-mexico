<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('question_answers')->insert([
            'question_id'   =>  1,
            'answer'        =>  '1 a 4',
            'score'         =>  0
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  1,
            'answer'        =>  '5 a 6',
            'score'         =>  8
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  1,
            'answer'        =>  '7 o más',
            'score'         =>  14
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  2,
            'answer'        =>  'Tierra o cemento',
            'score'         =>  0
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  2,
            'answer'        =>  'Otro tipo de material',
            'score'         =>  11
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  3,
            'answer'        =>  '0',
            'score'         =>  0
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  3,
            'answer'        =>  '1',
            'score'         =>  13
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  3,
            'answer'        =>  '2 o 3',
            'score'         =>  31
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  3,
            'answer'        =>  '4 o más',
            'score'         =>  48
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  4,
            'answer'        =>  'No tengo',
            'score'         =>  0
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  4,
            'answer'        =>  'Si tengo',
            'score'         =>  10
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  5,
            'answer'        =>  'No tengo',
            'score'         =>  0
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  5,
            'answer'        =>  'Si tengo',
            'score'         =>  20
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  6,
            'answer'        =>  '0 a 5',
            'score'         =>  0
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  6,
            'answer'        =>  '6 a 10',
            'score'         =>  15
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  6,
            'answer'        =>  '11 a 15',
            'score'         =>  27
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  6,
            'answer'        =>  '16 a 20',
            'score'         =>  32
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  6,
            'answer'        =>  '21 o más',
            'score'         =>  46
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  7,
            'answer'        =>  '0',
            'score'         =>  0
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  7,
            'answer'        =>  '1',
            'score'         =>  32
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  7,
            'answer'        =>  '2',
            'score'         =>  41
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  7,
            'answer'        =>  '3 o más',
            'score'         =>  58
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  8,
            'answer'        =>  'Menos de primaria completa',
            'score'         =>  0
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  8,
            'answer'        =>  'Primaria o Secundaria',
            'score'         =>  22
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  8,
            'answer'        =>  'Preparatoria o carrera técnica',
            'score'         =>  38
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  8,
            'answer'        =>  'Licenciatura',
            'score'         =>  52
        ]);

        DB::table('question_answers')->insert([
            'question_id'   =>  8,
            'answer'        =>  'Posgrado',
            'score'         =>  72
        ]);
    }
}

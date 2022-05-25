<?php

namespace Database\Seeders;

use App\Models\Inspection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InspectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inspections')->insert([
            'lift_id' => '2',
            'inspection_date' => '2022-05-24',
            'inspection_protocol' => '04CL223/12-2022',
            'inspection_label' => '2233',
            'inspection_result' => 'Kārtējā',
            'inspection_type' => 'Kārtējā',
            'inspection_participant_1_name' => 'Jūris Meistars',
            'inspection_participant_2_name' => 'Olegs Ivanovs',
            'inspection_participant_1_profession' => 'Elektroinženieris',
            'inspection_participant_2_profession' => 'Mehāniķis',
            'incpection_notes' => '1.4 Mašīntelpas durvīm nav brīdinājuma uzraksta "Lifta mašīntelpa - bīstami".
3.1 Mašīntelpā ir aprīkojums, kas nav saistīts ar liftu.
3.1 Nevar atvērt mašīntelpu no iekšpuses bez atslēgas ja tā ir aizverta no ārpuses ar atslēgu.
3.4 Lifta kabīnes vadības aparāts ir nolietots.
3.6 Eļļas noplūde no lifta mašīnas reduktora.
3.6 Nav vādskriemeļa aizsarga pret trošu noslīdēšanas un svešķermeņu iekļūšanas starp trosēm un rievām.
3.7 Lifta kabīnē nedarbojas zvans (skaņas signalizācijas sistēma).
4.1 Lifta kabīnes apdare ir nolietota.
5.1 Šahtas bedrē nav trepju.
5.3 Palielināta lifta kabīnes brīvkustība vadotnēs (vādkurpju ieliktņi ir nolietoti).
7.1 Visos stāvos sprauga starp šahtas durvīm un aiļu apmalēm ir lielāka par 10 mm.'
        ]);
    }
}

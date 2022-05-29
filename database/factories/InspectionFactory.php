<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inspection>
 */
class InspectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'lift_id' => $this->faker->unique()->numberBetween(1, 100),
            'inspection_date' => $this->faker->date('Y-m-d'),
            'inspection_protocol' => $this->faker->unique()->numerify('4CL####/12-2022'),
            'inspection_label' => $this->faker->unique()->numerify('####'),
            'inspection_result' => 'Lietošana atļauta',
            'inspection_type' => $this->faker->randomElement([
                'Pirmreizējā',
                'Kārtējā',
                'Ārpuskārtas',
                'Atkārtotā'
            ]),

            'inspection_participant_1_name' => $this->faker->name('male'),
            'inspection_participant_2_name' => $this->faker->name('male'),
            'inspection_participant_1_profession' => 'Elektroinženieris',
            'inspection_participant_2_profession' => 'Mehāniķis',
            'incpection_notes' => $this->faker->randomElement(
                [
                    '1.4 Mašīntelpas durvīm nav brīdinājuma uzraksta "Lifta mašīntelpa - bīstami".
3.1 Mašīntelpā ir aprīkojums, kas nav saistīts ar liftu.
3.1 Nevar atvērt mašīntelpu no iekšpuses bez atslēgas ja tā ir aizverta no ārpuses ar atslēgu.
3.4 Lifta kabīnes vadības aparāts ir nolietots.
3.6 Eļļas noplūde no lifta mašīnas reduktora.
3.6 Nav vādskriemeļa aizsarga pret trošu noslīdēšanas un svešķermeņu iekļūšanas starp trosēm.
3.7 Lifta kabīnē nedarbojas zvans (skaņas signalizācijas sistēma).
4.1 Lifta kabīnes apdare ir nolietota.
4.1 Lifta kabīnē ir nolietots vadības aparāts.
'
                    ,

                    '1.4 Mašīntelpas durvīm nav brīdinājuma uzraksta "Lifta mašīntelpa - bīstami".
3.1 Mašīntelpā ir aprīkojums, kas nav saistīts ar liftu.
3.6 Eļļas noplūde no lifta mašīnas reduktora.
3.6 Nav vādskriemeļa aizsarga pret trošu noslīdēšanas un svešķermeņu iekļūšanas starp trosēm.
3.7 Lifta kabīnē nedarbojas zvans (skaņas signalizācijas sistēma).
4.1 Lifta kabīnes apdare ir nolietota.
4.1 Lifta kabīnē ir nolietots vadības aparāts.
5.1 Šahtas bedrē nav trepju.
5.3 Palielināta lifta kabīnes brīvkustība vadotnēs (vādkurpju ieliktņi ir nolietoti).
7.1 Visos stāvos sprauga starp šahtas durvīm un aiļu apmalēm ir lielāka par 10 mm.'
                    ,

                    '1.4 Mašīntelpas durvīm nav brīdinājuma uzraksta "Lifta mašīntelpa - bīstami".
3.1 Mašīntelpā ir aprīkojums, kas nav saistīts ar liftu.
3.1 Nevar atvērt mašīntelpu no iekšpuses bez atslēgas ja tā ir aizverta no ārpuses ar atslēgu.
3.4 Lifta kabīnes vadības aparāts ir nolietots.
3.6 Eļļas noplūde no lifta mašīnas reduktora.
5.1 Šahtas bedrē nav trepju.
5.3 Palielināta lifta kabīnes brīvkustība vadotnēs (vādkurpju ieliktņi ir nolietoti).
7.1 Visos stāvos sprauga starp šahtas durvīm un aiļu apmalēm ir lielāka par 10 mm.'
                    ,

                    '3.1 Nevar atvērt mašīntelpu no iekšpuses bez atslēgas ja tā ir aizverta no ārpuses ar atslēgu.
3.4 Lifta kabīnes vadības aparāts ir nolietots.
3.6 Nav vādskriemeļa aizsarga pret trošu noslīdēšanas un svešķermeņu iekļūšanas starp trosēm.
3.7 Lifta kabīnē nedarbojas zvans (skaņas signalizācijas sistēma).
4.1 Lifta kabīnes apdare ir nolietota.
4.1 Lifta kabīnē ir nolietots vadības aparāts.
5.1 Šahtas bedrē nav trepju.
5.3 Palielināta lifta kabīnes brīvkustība vadotnēs (vādkurpju ieliktņi ir nolietoti).
7.1 Visos stāvos sprauga starp šahtas durvīm un aiļu apmalēm ir lielāka par 10 mm.'
                    ,

                    '1.4 Mašīntelpas durvīm nav brīdinājuma uzraksta "Lifta mašīntelpa - bīstami".
3.1 Mašīntelpā ir aprīkojums, kas nav saistīts ar liftu.
3.1 Nevar atvērt mašīntelpu no iekšpuses bez atslēgas ja tā ir aizverta no ārpuses ar atslēgu.
3.4 Lifta kabīnes vadības aparāts ir nolietots.
3.6 Eļļas noplūde no lifta mašīnas reduktora.
3.6 Nav vādskriemeļa aizsarga pret trošu noslīdēšanas un svešķermeņu iekļūšanas starp trosēm.
3.7 Lifta kabīnē nedarbojas zvans (skaņas signalizācijas sistēma).
4.1 Lifta kabīnes apdare ir nolietota.
4.1 Lifta kabīnē ir nolietots vadības aparāts.
5.1 Šahtas bedrē nav trepju.
5.3 Palielināta lifta kabīnes brīvkustība vadotnēs (vādkurpju ieliktņi ir nolietoti).
7.1 Visos stāvos sprauga starp šahtas durvīm un aiļu apmalēm ir lielāka par 10 mm.'
                ],


            ),
        ];
    }
}

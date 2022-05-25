<?php

namespace App\Http\Controllers;

//define("_SYSTEM_TTFONTS", public_path('fonts') );


use App\Models\Inspection;
use Illuminate\Http\Request;
use tFPDF;


class ProtokolController extends Controller
{


    private $parbaude = [
        'parbaude_nr' => '04.45/777-21/02',
        'parbaude_veids' => 'kārtējā',
        'parbaude_datums' => '02.11.2021',
        'parbaude_zimes_nr' => '2337',
        'parbaude_lifts_reg_nr' => '4CL012058',
        'parbaude_valditajs' => '1',
        'parbaude_mehanikis_vards_uzvards' => 'Olegs Jevstratovs',
        'parbaude_mehanika_kompanija' => 'SIA "KONE Lifti Latvija"',
        'parbaude_neatbilstibas' => '
1.4 Mašīntelpas durvīm nav bridinājuma uzraksta "Lifta mašīntelpa - bīstami".
3.1 Mašīntelpā luka ir bojāta
1.3 Nevar atslēgt mašīntelpu no iekšpuses bez atslēgas ja tā ir aizverta no ārpuses ar atslēgu.
3.2 Stiepšanas ierīce ir nolietota.
3.9 STOP slēdzis šahtas bedrē neatbilst standartiem.
4.3 Kabīnes grīdas un stāva laukuma grīdas līmeņu starpība ir lelākā par 50mm (15mm)  x stāvos.
5.2 Palielināta lifta pretsvara brīvkustība vadotnēs (vādkurpju ieliktņi ir nolietoti).',
    ];


    function index()
    {
        $inspection = Inspection::first();
        $lift = $inspection->lift;
        $liftManager = $lift->liftManager;

        require('Protokol/variables.php');
        require('Protokol/functions.php');
        require('Protokol/data.php');
        require('Protokol/data/lifti.php');
        require('Protokol/data/valditaji.php');

//        dd($inspection);

        $parbaude = $this->parbaude;
        $checkboxes = [];
        $empty_checkboxes = [];

        $is_blank = false;
        $lifts = [
            'lifts_reg_nr' => $lift->reg_number,
            'lifts_rupn_nr' => $lift->factory_number,
            'lifts_uzstaditajs' => $lift->manufacture_name, // TODO add  installer
            'lifts_uzstadisanas_gads' => (string)$lift->manufacture_year,
            'lifts_parbaudes_adrese' => $lift->street.' '.$lift->house.'-'.$lift->entrance.', '.$lift->city.', '.$lift->postal_code,
            'lifts_tips' => $lift->lift_type,
            'lifts_celtspeja' => (string)$lift->load_capacity,
            'lifts_stavu_skaits' => (string)$lift->floors_total,
        ];
        $valditajs = [
            'valditajs_nosaukums' => $liftManager->name,
            'valditajs_adrese' => $liftManager->address,
            'valditajs_reg_nr' => $liftManager->reg_number,
            'valditajs_liguma_nr' => '6-15/1159', //TODO add fields to migration
            'valditajs_liguma_datums' => '21.04.2020', //TODO add fields to migration
        ];
        global $pdf;
        $pdf = new tFPDF('P', 'mm', 'A4');

        $pdf->SetAutoPageBreak(false, 10);
        $pdf->AddFont('OpenSansR', '', 'OpenSans-Regular.ttf', true);
        $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
        $pdf->AddFont('TimesNewRomanRegular', '', 'TimesNewRomanRegular.ttf', true);
        $pdf->AddFont('TimesNewRomanBold', '', 'TimesNewRomanBold.ttf', true);
        $pdf->AddFont('TimesNewRomanBoldItalic', '', 'TimesNewRomanBoldItalic.ttf', true);
        $pdf->AddFont('ArialRegular', '', 'ArialRegular.ttf', true);
        $pdf->AddFont('ArialBold', '', 'ArialBold.ttf', true);
        $pdf->AddFont('ArialBoldItalic', '', 'ArialBoldItalic.ttf', true);
        $pdf->AddPage();
        $pdf->setLineWidth($default_line_width);
        $pdf->setLineWidth($default_line_width);
//        $prp = numbered_string_to_array($parbaude['parbaude_neatbilstibas']);
        $prp = numbered_string_to_array($inspection->incpection_notes); //TODO rename in->c<-pection to ins


        $pdf->AddFont('DejaVuSansCondensed', '', 'DejaVuSansCondensed.ttf', true);
        $pdf->SetFont('DejaVuSansCondensed', '', 14);


        $pdf->Image(public_path('img/tuv.jpg'), $width - 35, 11, 50,);
        $pdf->SetFont('ArialBold', '', 10);
        left_padding();
        $pdf->setFillColor(128, 128, 255);
        $pdf->cell($width * 0.75, 5, 'LATVIJAS RŪPNIEKU TEHNISKĀS DROŠĪBAS EKSPERTU APVIENĪBA', 0, 1, 'C', false);

        //43
        $pdf->SetFont('Arial', '', 8);
        left_padding();
        $pdf->setFillColor(255, 128, 128);
        left_padding();
        $pdf->cell($width * 0.75, 3, 'TUV Rheinland grupa, SIA', '', 1, 'C', false);

        left_padding();
        $pdf->SetDrawColor(44, 123, 178);
        $pdf->setLineWidth(0.4);
        $pdf->cell($width * 0.05, 1, '', '', 0, 'C', false);
        $pdf->cell($width * 0.65, 1, '', 'B', 1, 'C', false);


        $pdf->SetFont('ArialRegular', '', 7);
        left_padding();
        $pdf->setFillColor(255, 128, 128);
        left_padding();
        $pdf->cell($width * 0.75, 6,
            'Katlakalna iela 9A, Rīga, LV-1073, Latvija, Tālr. 67568607, www.tuv.lv, e-pasts: tuv@tuv.lv', '', 1, 'C',
            false);


        $pdf->SetFont('ArialRegular', '', 9);
        $pdf->setFillColor(255, 128, 128);
        left_padding();
        $pdf->cell($width * 0.75, 3, 'DARBA AIZSARDZĪBAS UN IEKĀRTU NOVĒRTĒŠANAS INSPEKCIJA', '', 1, 'C', false);

        $pdf->SetDrawColor(0, 0, 0);
        left_padding();
        $pdf->cell(0, 1, '', 'B', 1, 'C', false);


        $pdf->setLineWidth($default_line_width);

////////////////////////////////////////////////////////////////////
// PROTOCOL HEADER
////////////////////////////////////////////////////////////////////

        $pdf->SetFont('ArialBoldItalic', '', 10);
        left_padding();
        $pdf->setFillColor(128, 128, 255);
        $pdf->cell(0, 11, "LIFTA TEHNISKĀS PĀRBAUDES PROTOKOLS Nr. ".$inspection->protocol_number, 0, 1, 'C', false);

        $pdf->Image('./img/latak_logo.jpg', $width - 5, 30, 22,);

        $pdf->SetFont($font_family_default_bold, '', $font_size_default);

////////////////////////////////////////////////////////////////////
// VALDITAJS
////////////////////////////////////////////////////////////////////
        left_padding();
        $pdf->setFillColor(128, 128, 255);
        $pdf->cell($section_valditajs_Left_col_width, $section_valditajs_height / 2, " Valdītājs:", "LRT", 0, 'L',
            $is_filled);
        $pdf->cell(20, $section_valditajs_height / 2, " Līguma Nr.", 0, 0, 'L', false);
        $pdf->cell(40, $section_valditajs_height / 2, $valditajs['valditajs_liguma_nr'], "B", 1, 'C', false);

        left_padding();
        $pdf->cell($section_valditajs_Left_col_width, $section_valditajs_height / 2, $valditajs['valditajs_nosaukums'],
            "LRB", 0, 'C', false);
        $pdf->cell(20, $section_valditajs_height / 2, "", 0, 0, 'L', false);
        $pdf->cell(40, $section_valditajs_height / 2, $valditajs['valditajs_liguma_datums'], 0, 1, 'C', false);


////////////////////////////////////////////////////////////////////
// ADRESE
////////////////////////////////////////////////////////////////////
        left_padding();

        $pdf->cell($section_valditajs_Left_col_width, $section_valditajs_height / 2, " Adrese:", "LRT", 0, 'L', false);
        $pdf->cell(0, $section_valditajs_height / 2, " Pārbaudes adrese:", "RT", 1, 'L', false);

        left_padding();

        $pdf->cell($section_valditajs_Left_col_width, $section_valditajs_height / 2, $valditajs['valditajs_adrese'],
            "LRB", 0, 'C', false);
        $pdf->cell(0, $section_valditajs_height / 2, $lifts['lifts_parbaudes_adrese'], "RB", 1, 'C', false);


////////////////////////////////////////////////////////////////////
// REG NR
////////////////////////////////////////////////////////////////////
        left_padding();

        $pdf->setLineWidth($section_reg_nr_line_width);
        $pdf->cell($section_reg_nr_label_width, $section_reg_nr_height, "Reģ, Nr.:", 0, 0, 'C', false);

        foreach (stringToArray($valditajs['valditajs_reg_nr']) as $key => $val) {
            $newStr = 0;
            if ($key === 10) {
                $newStr = 1;
            }
            $pdf->cell($section_reg_nr_digit_width, $section_reg_nr_height, $val, "LRB", $newStr, 'C', false);
        }
        $pdf->setLineWidth($default_line_width);
        $pdf->Ln(1);

////////////////////////////////////////////////////////////////////
// PARBAUDES VEIDS
////////////////////////////////////////////////////////////////////
        $pdf->setLineWidth($parbaudes_veids_line_width);
        left_padding();
        $pdf->SetFont($parbaudes_veids_label_font_family, '', $parbaudes_veids_label_font_size);
        $pdf->cell($parbaudes_veids_1col_width, $parbaudes_veids_cell_height, "Pārbaudes veids", 0, 0, 'L', false);
        $pdf->SetFont($parbaudes_veids_font_family, '', $parbaudes_veids_font_size);
        $pdf->cell($parbaudes_veids_2col_width, $parbaudes_veids_cell_height, "Pirmreizējā*", 0, 0, 'C', false);
        $pdf->SetFont($parbaudes_veids_mark_font_family, '', $parbaudes_veids_mark_font_size);
        $pdf->cell($parbaudes_veids_3col_width, $parbaudes_veids_cell_height,
            $parbaude['parbaude_veids'] === 'pirmreizējā' ? 'X' : '', 1, 0, 'C', false);
        $pdf->SetFont($parbaudes_veids_font_family, '', $parbaudes_veids_font_size);
        $pdf->cell($parbaudes_veids_4col_width, $parbaudes_veids_cell_height, "Kārtējā", 0, 0, 'C', false);
        $pdf->SetFont($parbaudes_veids_mark_font_family, '', $parbaudes_veids_mark_font_size);
        $pdf->cell($parbaudes_veids_5col_width, $parbaudes_veids_cell_height,
            $parbaude['parbaude_veids'] === 'kārtējā' ? 'X' : '', 1, 0, 'C', false);
        $pdf->SetFont($parbaudes_veids_font_family, '', $parbaudes_veids_font_size);
        $pdf->cell($parbaudes_veids_6col_width, $parbaudes_veids_cell_height, "Ārpuskārtas", 0, 0, 'C', false);
        $pdf->SetFont($parbaudes_veids_mark_font_family, '', $parbaudes_veids_mark_font_size);
        $pdf->cell($parbaudes_veids_7col_width, $parbaudes_veids_cell_height,
            $parbaude['parbaude_veids'] === 'ārpuskārtas' ? 'X' : '', 1, 0, 'C', false);
        $pdf->SetFont($parbaudes_veids_font_family, '', $parbaudes_veids_font_size);
        $pdf->cell($parbaudes_veids_8col_width, $parbaudes_veids_cell_height, "Atkārtotā", 0, 0, 'C', false);
        $pdf->SetFont($parbaudes_veids_mark_font_family, '', $parbaudes_veids_mark_font_size);
        $pdf->cell($parbaudes_veids_9col_width, $parbaudes_veids_cell_height,
            $parbaude['parbaude_veids'] === 'atkārtotā' ? 'X' : '', 1, 1, 'C', false);

        $pdf->SetFont($font_family_default, '', $font_size_s);
        $pdf->setLineWidth($default_line_width);
////////////////////////////////////////////////////////////////////
// TEHNISKAS PARBAUDES NORMATIVI
////////////////////////////////////////////////////////////////////
        $pdf->SetFont($tehniskas_parbaudes_normativi_label_font_family, '',
            $tehniskas_parbaudes_normativi_label_font_size);
        left_padding();
        $pdf->cell($tehniskas_parbaudes_normativi_label_cell_width, $tehniskas_parbaudes_normativi_cell_height,
            "Tehniskās pārbaudes normatīvi:", 0, 0, 'L', false);
        $pdf->SetFont($tehniskas_parbaudes_normativi_font_family, '', $tehniskas_parbaudes_normativi_font_size);
        $pdf->cell(0, $tehniskas_parbaudes_normativi_cell_height,
            "MK.Not.Nr.679 no 17.11.2020;  LRTDEA metodika 04.11/001", 0, 1, 'L', false);

        $pdf->SetFont($font_family_default, '', $font_size_s);
        $pdf->setLineWidth($default_line_width);
//$pdf->Ln( 10 );
////////////////////////////////////////////////////////////////////
// ZINAS PAR
////////////////////////////////////////////////////////////////////
        $pdf->setLineWidth($zinas_par_line_width);
        left_padding();
        $pdf->SetFont($zinas_par_label_font_family, '', $zinas_par_label_font_size);
        $pdf->cell($zinas_par_label_cell_width, $zinas_par_cell_height, "Ziņas par", 0, 0, 'L', false);
        $pdf->SetFont($zinas_par_font_family, '', $zinas_par_font_size);
        $pdf->cell($zinas_par_reg_nr_label_cell_width, $zinas_par_cell_height, "Reģ. Nr.", 0, 0, 'R', false);
        $pdf->SetFont($zinas_par_label_font_family, '', $zinas_par_label_font_size);
        $pdf->cell($zinas_par_reg_nr_cell_width, $zinas_par_cell_height, $lifts['lifts_reg_nr'], 0, 0, 'L', false);
        $pdf->SetFont($zinas_par_font_family, '', $zinas_par_font_size);
        $pdf->cell($zinas_par_uzstaditajs_label_cell_width, $zinas_par_cell_height, "Uzstādītājs:", "B", 0, 'C', false);
        $pdf->SetFont($zinas_par_label_font_family, '', $zinas_par_label_font_size);
        $pdf->cell($zinas_par_uzstaditajs_cell_width, $zinas_par_cell_height, $lifts['lifts_uzstaditajs'], "B", 1, 'C',
            false);

////////////////////////////////////////////////////////////////////
// LIFTU
////////////////////////////////////////////////////////////////////

        $pdf->setLineWidth($zinas_par_line_width);
        left_padding();
        $pdf->SetFont($zinas_par_label_font_family, '', $zinas_par_label_font_size);
        $pdf->cell($zinas_par_label_cell_width, $zinas_par_cell_height, "liftu:", 0, 0, 'L', false);
        $pdf->SetFont($zinas_par_font_family, '', $zinas_par_font_size);
        $pdf->cell($zinas_par_reg_nr_label_cell_width, $zinas_par_cell_height, "Rūpn. Nr.", "BT", 0, 'R', false);
        $pdf->SetFont($zinas_par_label_font_family, '', $zinas_par_label_font_size);
        $pdf->cell($zinas_par_reg_nr_cell_width, $zinas_par_cell_height, $lifts['lifts_rupn_nr'], "BT", 0, 'L', false);
        $pdf->SetFont($zinas_par_font_family, '', $zinas_par_font_size);
        $pdf->cell($liftu_uzstadisanas_gads_cell_width, $zinas_par_cell_height, "Uzstādīšanas gads ", "B", 0, 'R',
            false);

        $pdf->SetFont($zinas_par_label_font_family, '', $zinas_par_label_font_size);
        foreach (stringToArray($lifts['lifts_uzstadisanas_gads']) as $key => $val) {
            $newStr = 0;
            if ($key === 3) { // 4 digit year 0-3
                $newStr = 1;
            }
            $pdf->cell($liftu_gads_cell_width, $liftu_cell_height, $val, "LRB", $newStr, 'C', false);
        }

        $pdf->SetFont($font_family_default, '', $font_size_s);
        $pdf->setLineWidth($default_line_width);
        $pdf->Ln(1);

////////////////////////////////////////////////////////////////////
// LIFTA TIPS
////////////////////////////////////////////////////////////////////
        left_padding();
        $pdf->SetFont($lifta_tips_label_font_family, '', $lifta_tips_label_font_size);
        $pdf->cell($lifta_tips_label_cell_width, $lifta_tips_cell_height, "Lifta tips:", 0, 0, 'L', false);

        $pdf->SetFont($lifta_tips_font_family, '', $lifta_tips_font_size);
        $pdf->cell($lifta_tips_cell_width, $lifta_tips_cell_height, "elektriskais ", 0, 0, 'R', false);
        $pdf->SetFont($lifta_tips_label_font_family, '', $lifta_tips_label_font_size);
        $pdf->cell($lifta_tips_mark_cell_width, $lifta_tips_cell_height,
            $lifts['lifts_tips'] === 'elektriskais' ? 'X' : '', 1, 0, 'C', false);

        $pdf->SetFont($lifta_tips_font_family, '', $lifta_tips_font_size);
        $pdf->cell($lifta_tips_cell_width, $lifta_tips_cell_height, "hidrauliskais ", 0, 0, 'R', false);
        $pdf->SetFont($lifta_tips_label_font_family, '', $lifta_tips_label_font_size);
        $pdf->cell($lifta_tips_mark_cell_width, $lifta_tips_cell_height,
            $lifts['lifts_tips'] === 'hidrauliskais' ? 'X' : '', 1, 1, 'C', false);

        $pdf->SetFont($font_family_default, '', $font_size_s);
        $pdf->Ln(1);
////////////////////////////////////////////////////////////////////
// CELTSPEJA
////////////////////////////////////////////////////////////////////

        $pdf->SetFont($font_family_default, '', $font_size_default);
        left_padding();
        $pdf->cell(20, 4, "Celtspēja", "B", 0, 'L', false);
        $pdf->SetFont("ArialBold", '', $font_size_s);
        $pdf->cell(15, 4, $lifts['lifts_celtspeja'], "B", 0, 'L', false);
        $pdf->SetFont($font_family_default, '', $font_size_s);
        $pdf->cell(0, 4, "kg.", "B", 1, 'L', false);


        $pdf->SetFont($font_family_default, '', $font_size_s);

////////////////////////////////////////////////////////////////////
// PARBAUDES REZULTATI
////////////////////////////////////////////////////////////////////
        $pdf->Ln(1);
        left_padding();
        $pdf->SetFont("ArialBold", '', 10);
        $pdf->cell(0, 3, "Pārbaudes rezultāti", 0, 1, 'L', false);
        $pdf->Ln(0.5);


// parbaudes rezultati header start
        left_padding();
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "1. Visparīgi", 0, 0, 'L',
            false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "0", 0, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "1", 0, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "2", 0, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "3", 0, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "4. Kabīne", 0, 0, 'L',
            false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_label_font_size);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "0", 0, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "1", 0, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "2", 0, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "3", 0, 1, 'C', false);
// parbaudes rezultati header end
// parbaudes rezultati 1 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "1.1 Lifta atbilstības deklarācija*", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "O", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "4.1 Lifta kabīne", "TB",
            0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["4.1"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["4.1"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["4.1"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);
// parbaudes rezultati 1 row end

// parbaudes rezultati 2 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "1.2 Lifta atbilstības sertifikāts*", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "O", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "4.2 Celtspējas kontroles ierīce", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "O", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);
//// parbaudes rezultati 2 row end

// parbaudes rezultati 3 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "1.3 Lifta lietošanas dokumentācija", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["1.3"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["1.3"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default, '', 7);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "4.3 Lifta kabīnes līmeņošanas un apstāšanas precizitāte", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["4.3"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["4.3"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);
// parbaudes rezultati 3 row end

// parbaudes rezultati 4 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', 7);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "1.4 Brīdinājumi, apzimējumi un informācija par lifta lietošanu", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["1.4"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["1.4"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);

        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "5. Šahta", 0, 1, 'L',
            false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_label_font_size);
// parbaudes rezultati 4 row end

// parbaudes rezultati 5 row start
        left_padding();
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width + $parbaudes_rezultati_mark_column_width * 4,
            $parbaudes_rezultati_cell_height, "2. Troses, ķēdes, to stīprinājumi", 0, 0, 'L', false);
        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);

        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "5.1 Šahtas atbilstība",
            "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["5.1"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["5.1"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);

// parbaudes rezultati 5 row end

// parbaudes rezultati 6 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "2.1 Trošu, siksnu nostiepuma kontrole", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["2.1"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["2.1"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "5.2 Šahtas nožogojumi",
            "TB", 0, 'L', false);

        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["5.2"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["5.2"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);
// parbaudes rezultati 6 row end

// parbaudes rezultati 7 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "2.2 Lifta piekāre un tās elementi", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["2.2"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["2.2"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "5.3 Vadotnes un metālkonstrukcija", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["5.3"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["5.3"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);
// parbaudes rezultati 7 row end

// parbaudes rezultati $parbaudes_rezultati_text_font_size row start
        left_padding();
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width + $parbaudes_rezultati_mark_column_width * 4,
            $parbaudes_rezultati_cell_height, "3. Mašīntelpa un elektriskā iekārta", 0, 0, 'L', false);
        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);

        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "5.4 Lifta buferi", "TB",
            0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', 9);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["5.4"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["5.4"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);

// parbaudes rezultati $parbaudes_rezultati_text_font_size row end

// parbaudes rezultati 9 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "3.1 Mašīntelpa un trīšu telpas", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["3.1"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["3.1"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "5.5 Pretsvars un kabīnes jumts", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["5.5"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["5.5"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);
// parbaudes rezultati 9 row end

// parbaudes rezultati 10 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', 7);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "3.2 Ātruma ierobežotājs un ķērājierīce elektriskajiem liftiem", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["3.2"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["3.2"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);


        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);

        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "6. Hidrauliskās iekārtas",
            0, 1, 'L', false);
// parbaudes rezultati 10 row end

// parbaudes rezultati 11 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "3.3 Augšupejošas kabīnes ātruma ierobežošanas ierīce", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "O", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "6.1 Hidraulisko liftu drošības ierīces", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "O", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);
// parbaudes rezultati 11 row end

// parbaudes rezultati 12 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "3.4 Vadības ierīces",
            "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["3.4"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["3.4"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "6.2 Lifta hidrauliskās sistēmas cauruļvadi", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "O", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);
// parbaudes rezultati 12 row end

// parbaudes rezultati 13 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', 7);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "3.5 Gala slēdži", "TB", 0,
            'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["3.5"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["3.5"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);

        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "7. Šahtas durvis", 0, 1,
            'L', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_label_font_size);
// parbaudes rezultati 13 row end

// parbaudes rezultati 14 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "3.6 Lifta mašīna", "TB",
            0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["3.6"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["3.6"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "7.1 Šahtas un kabīnes durvis", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["7.1"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["7.1"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);
// parbaudes rezultati 14 row end

// parbaudes rezultati 15 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "3.7 Trauksmes ierīce ārkārtas gadījumos", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["3.7"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["3.7"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "7.2 Durvju slēgšanas un drošības ierīces", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["7.2"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["7.2"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);
// parbaudes rezultati 15 row end


// parbaudes rezultati 16 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "3.8 Darbināšana ārkārtas gadījumos", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["3.8"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["3.8"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height, "8. Apgaismojumi", "TB", 0,
            'L', false);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["8.0"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["8.0"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);
// parbaudes rezultati 16 row end


// parbaudes rezultati 17 row start
        left_padding();
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "3.9 Lifta apstadināšanas ierīces", "TB", 0, 'L', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["3.9"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["3.9"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);

        $pdf->cell($parbaudes_rezultati_column_spacer, $parbaudes_rezultati_cell_height, "", 0, 0, 'C', false);
        $pdf->SetFont($font_family_default_bold, '', $parbaudes_rezultati_label_font_size);
        $pdf->cell($parbaudes_rezultati_text_column_width, $parbaudes_rezultati_cell_height,
            "9. Elektriskās iekārtas un ietaises", "TB", 0, 'L', false);

        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            isset($prp["9.0"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height,
            !isset($prp["9.0"]) || $is_blank ? "" : "X", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 0, 'C', false);
        $pdf->cell($parbaudes_rezultati_mark_column_width, $parbaudes_rezultati_cell_height, "", 1, 1, 'C', false);
// parbaudes rezultati 17 row end
////////////////////////////////////////////////////////////
// VERTEJUMI - consists of 4 rows
//////////////////////////////////////////////////////////
        $pdf->Ln(2);

// first row
        left_padding();
        $pdf->cell($vertejumi_first_col_width, $vertejumi_row_height, " Vērtējumi:", "LTR", 0, 'L', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($vertejumi_second_col_width, $vertejumi_row_height, " 0 - neatbilstības nav konstatētas", "TR", 0,
            'L', false);
        $pdf->cell($vertejumi_third_col_width, $vertejumi_row_height,
            " 1- konstatētas maznozīmīgas neatbilstības, kas nerada būtiskus ", "TR", 1, 'L', false);
// first row
        left_padding();
        $pdf->cell($vertejumi_first_col_width, $vertejumi_row_height, "", "LBR", 0, 'L', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($vertejumi_second_col_width, $vertejumi_row_height, "", "BR", 0, 'L', false);
        $pdf->cell($vertejumi_third_col_width, $vertejumi_row_height,
            " draudus cilvēku dzīvībai, veselībai, īpašumam vai videi", "BR", 1, 'L', false);
// first row
        left_padding();
        $pdf->cell($vertejumi_first_col_width, $vertejumi_row_height, "", "LR", 0, 'L', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($vertejumi_second_col_width, $vertejumi_row_height,
            " 2 - konstatētas būtiskas neatbilstības, kas var radīt ", "R", 0, 'L', false);
        $pdf->cell($vertejumi_third_col_width, $vertejumi_row_height,
            " 3 - konstatētas bīstamas neatbilstības, kas rada tiešus draudus ", "R", 1, 'L', false);
// first row
        left_padding();
        $pdf->cell($vertejumi_first_col_width, $vertejumi_row_height, "", "LBR", 0, 'L', false);
        $pdf->SetFont($font_family_default, '', $parbaudes_rezultati_text_font_size);
        $pdf->cell($vertejumi_second_col_width, $vertejumi_row_height,
            " draudus cilvēku dzīvībai, veselībai, īpašumam vai videi", "BR", 0, 'L', false);
        $pdf->cell($vertejumi_third_col_width, $vertejumi_row_height,
            " cilvēku dzīvībai, veselībai, īpašumam vai videi", "BR", 1, 'L', false);

        $pdf->Ln(2);

////////////////////////////////////////////////////////////////////////////////
/// NOVERTEJUMS
////////////////////////////////////////////////////////////////////////////////

        left_padding();
        $pdf->SetFont($font_family_default_bold, '', 9);
        $pdf->cell(25, 4.1, "Novērtējums:", "", 0, 'L', false);
        $pdf->cell(5, 4.1, "X", 1, 0, 'C', false);
        $pdf->SetFont($font_family_default, '', 8);
        $pdf->cell(10, 4.1, "vai", "", 0, "C", false);
        $pdf->SetFillColor(200, 200, 200);
        $pdf->cell(5, 4.1, "", 1, 0, 'L', true);
        $pdf->cell(10, 4.1, "", "", 0, "C", false);
        $pdf->SetFont($font_family_default_bold, '', 9);
        $pdf->cell(5, 4.1, "O", 1, 0, 'C', false);
        $pdf->SetFont($font_family_default, '', 8);
        $pdf->cell(30, 4.1, "- nav nepieciešams", "", 1, "C", false);

////////////////////////////////////////////////////////////////////////////////
/// NEATBILSTIBU APRAKSTI
////////////////////////////////////////////////////////////////////////////////
        $pdf->Ln(1);
        left_padding();
        $pdf->SetFont($font_family_default_bold, '', 9);
        $pdf->cell(35, 4, "Neatbilstību apraksti", "", 0, 'L', false);
        $pdf->SetFont($font_family_default, '', 8);
        $pdf->cell(45, 4, "(papildus norādijumi, piezīmes):", "", 0, 'L', false);
        $pdf->SetLineWidth(0.1);
        $pdf->cell(0, 4, "", "B", 1, 'L', false);


        if (count($prp) >= 12) {
            $pdf->SetFont('TimesNewRomanRegular', '', 8);
            foreach ($prp as $res_index => $res_res) {
                left_padding();
                $pdf->multicell(0, 3, $res_index.' - '.$res_res, "B", "L", false);
            }
        } else {
            $pdf->SetFont('TimesNewRomanRegular', '', 9);
            foreach ($prp as $res_index => $res_res) {
                left_padding();
                $pdf->multicell(0, 4, $res_index.' - '.$res_res, "B", "L", false);
            }
            for ($i = 0; $i < 10 - count($prp); $i++) {
                left_padding();
                $pdf->multicell(0, 4, "", "B", "L", false);
            }
        }


////////////////////////////////////////////////////////////////////////////////
/// SLEDZIENS
////////////////////////////////////////////////////////////////////////////////


        $pdf->Ln(3);
        left_padding();
        $pdf->SetFont("ArialBold", '', 9);
        $pdf->cell(20, 4, "Slēdziens:", 0, 0, 'L', false);
        $pdf->SetFont("ArialRegular", '', 9);
        $pdf->cell(25, 4, "vajadzīgo atzīmēt", 0, 0, 'R', false);
        $pdf->SetFont("ArialBold", '', 9);
        $pdf->cell(25, 4, "X", 0, 1, 'L', false);
        $pdf->Ln(1);

////////////////////////////////////////////////////////////////////////////////
/// SLEDZIENS
////////////////////////////////////////////////////////////////////////////////

        $pdf->setLineWidth($derigs_ekspluatacijai_line_width);
        left_padding();

        $pdf->SetFont($derigs_ekspluatacijai_mark_font_family, '', $derigs_ekspluatacijai_mark_font_size);
        $pdf->cell(1, $derigs_ekspluatacijai_cell_height, "", 0, 0, 'C', false);
        $pdf->cell($derigs_ekspluatacijai_1col_width, $derigs_ekspluatacijai_cell_height,
            count($prp) || $is_blank ? '' : 'X', 1, 0, 'C', false);

        $pdf->SetFont($derigs_ekspluatacijai_font_family, '', $derigs_ekspluatacijai_font_size);
        $pdf->cell($derigs_ekspluatacijai_2col_width, $derigs_ekspluatacijai_cell_height, " Lietošana atļauta", 0, 0,
            'L', false);

        $pdf->SetFont($derigs_ekspluatacijai_mark_font_family, '', $derigs_ekspluatacijai_mark_font_size);
        $pdf->cell($derigs_ekspluatacijai_3col_width, $derigs_ekspluatacijai_cell_height,
            !count($prp) || $is_blank ? '' : 'X', 1, 0, 'C', false);

        $pdf->SetFont($derigs_ekspluatacijai_font_family, '', $derigs_ekspluatacijai_font_size);
        $pdf->cell($derigs_ekspluatacijai_4col_width, $derigs_ekspluatacijai_cell_height,
            " Lietošana pieļaujama 30 dienas", 0, 0, 'L', false);

        $pdf->SetFont($derigs_ekspluatacijai_mark_font_family, '', $derigs_ekspluatacijai_mark_font_size);
        $pdf->cell($derigs_ekspluatacijai_5col_width, $derigs_ekspluatacijai_cell_height, "", 1, 0, 'C', false);

        $pdf->SetFont($derigs_ekspluatacijai_font_family, '', $derigs_ekspluatacijai_font_size);
        $pdf->cell($derigs_ekspluatacijai_6col_width, $derigs_ekspluatacijai_cell_height, " Lietošana nav pieļaujama",
            0, 1, 'L', false);

        $pdf->setLineWidth($default_line_width);

////////////////////////////////////////////////////////////////////////////////
/// NAKOSA PARBAUDE
////////////////////////////////////////////////////////////////////////////////
        $pdf->Ln(3);
        left_padding();
        $pdf->SetFont($font_family_default_bold, '', $font_size_default);
        $pdf->cell($nakosa_parbaude_1col_width, 5, "Nākošā pārbaude ", 0, 0, 'L', false);
//date("j.n.Y",date_create_from_format("j.n.Y", $parbaude['parbaude_datums']))

//$pdf->cell( $nakosa_parbaude_2col_width, 5, $parbaude['parbaude_datums'], "B", 0, 'C', false );
        $pdf->cell($nakosa_parbaude_2col_width, 5,
            $parbaude['parbaude_datums'] ? date_format(date_add(date_create_from_format('j.n.Y',
                $parbaude['parbaude_datums']), date_interval_create_from_date_string('1 year')), 'd.m.Y') : '', "B", 0,
            'C', false);


        $pdf->cell($nakosa_parbaude_3col_width, 5, "", 0, 0, 'L', false);
        $pdf->cell($nakosa_parbaude_4col_width, 5, "Pieļaujamā celtspēja ", 0, 0, 'L', false);
        $pdf->cell($nakosa_parbaude_5col_width, 5, $lifts['lifts_celtspeja'], "B", 0, 'C', false);
        $pdf->cell($nakosa_parbaude_6col_width, 5, "kg.", 0, 1, 'L', false);

////////////////////////////////////////////////////////////////////////////////
/// IEKARTA MARKETA
////////////////////////////////////////////////////////////////////////////////


        $pdf->Ln(3);
        left_padding();
        $pdf->SetFont($font_family_default_bold, '', $font_size_default);
        $pdf->cell($iekarta_marketa_1col_width, 5, "Iekārta marķēta ar pārbaudes zīmi Nr. ", 0, 0, 'L', false);
        $pdf->cell($iekarta_marketa_2col_width, 5, $parbaude['parbaude_zimes_nr'], "B", 0, 'C', false);
        $pdf->cell($iekarta_marketa_3col_width, 5, "", 0, 0, 'L', false);
        $pdf->cell($iekarta_marketa_4col_width, 5, "Eksperts ", 0, 0, 'L', false);
        $pdf->cell($iekarta_marketa_5col_width, 5, "", "B", 0, 'C', false);
        $pdf->cell($iekarta_marketa_6col_width, 5, "Igors Koptevs", 0, 1, 'L', false);

        $pdf->SetFillColor(123, 123, 123);
        $pdf->SetFont($font_family_default, '', 7);
        $pdf->cell($width - $iekarta_marketa_6col_width + 5, 3, "(vārds, uzvārds, paraksts, zīmogs)", 0, 0, 'R', false);
        $pdf->cell($iekarta_marketa_6col_width, 3, "", 0, 1, 'R', false);

////////////////////////////////////////////////////////////////////////////////
/// PARBAUDE PIEDALIJAS
////////////////////////////////////////////////////////////////////////////////

        $pdf->Ln(1);
        left_padding();
        $pdf->SetFont($font_family_default_bold, '', $font_size_default);
        $pdf->cell(0, 4.5, "Pārbaudē piedalījās ", 0, 1, 'L', false);
        left_padding();
        $pdf->SetFont($font_family_default_bold, '', $font_size_s);
        $pdf->cell($parbaude_piedalijas_1col_width, 5,
            $parbaude['parbaude_mehanika_kompanija'] ? $parbaude['parbaude_mehanika_kompanija'].' mehāniķis' : '', "B",
            0, 'L', false);
//$pdf->cell( $parbaude_piedalijas_1col_width, 5, "", "B", 0, 'L', false );
        $pdf->SetFont($font_family_default_bold, '', $font_size_default);
//$pdf->cell( $parbaude_piedalijas_2col_width, 5, "", "B", 0, 'R', false );
        $pdf->cell($parbaude_piedalijas_2col_width, 5, $parbaude['parbaude_mehanikis_vards_uzvards'], "B", 0, 'R',
            false);
        $pdf->SetFont($font_family_default_bold, '', $font_size_default);
        $pdf->cell($parbaude_piedalijas_3col_width, 5, "", 0, 0, 'L', false);
        $pdf->cell($parbaude_piedalijas_4col_width, 5, "Pārbaudes datums", 0, 0, 'L', false);
        $pdf->cell($parbaude_piedalijas_5col_width, 5, $parbaude['parbaude_datums'], "B", 1, 'C', false);

        $pdf->SetFillColor(123, 123, 123);
        $pdf->SetFont($font_family_default, '', 7);

        $pdf->cell($parbaude_piedalijas_1col_width + 20, 3, "", 0, 0, 'R', false);
        $pdf->cell(0, 3, "(amats, vārds, uzvārds, paraksts)", 0, 1, 'L', false);

// FOOTER

        $pdf->Ln(13);
        $pdf->SetFont($font_family_default, '', $font_size_xs);


        left_padding();
        $pdf->cell(20, 3, "", 0, 0, 'L', false);
        $pdf->cell(0, 3, "Protokols parakstīts ar drošu elektronisko parakstu un satur laika zīmogu.", 0, 1, 'C',
            false);
        left_padding();
        $pdf->cell(20, 3, "04.27_015.doc", 0, 0, 'L', false);
        $pdf->cell(0, 3, "Protokols attiecas tikai uz augstākminēto iekārtu. Lūdzam glabāt līdzvertīgi iekārtas pasei.",
            0, 1, 'C', false);
        left_padding();
        $pdf->cell(20, 3, "09.03.2022", 0, 0, 'L', false);
        $pdf->cell(0, 3,
            "Tehniskās pārbaudes protokolu aizliegts pavairot nepilnā apjomā bez inspicēšanas institūcijas rakstiskas atļaujas..",
            0, 1, 'C', false);
        left_padding();

        $pdf->AddPage();


        $pdf->Ln(10);

        $pdf->SetFont('ArialBold', '', 10);
        left_padding();
        $pdf->setFillColor(128, 128, 255);
        $pdf->cell(0, 5, "Lifta elektromērījumi:", 0, 1, 'C', false);

        $pdf->SetFont('ArialRegular', '', 10);
        left_padding();
        $pdf->cell(0, 5, "Pielikums pārbaudes protokolam Nr.: ".$parbaude['parbaude_nr'], 0, 1, 'C', false);

// first table

        $pdf->Ln(5);
// first table first row
        left_padding();
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_first_table_row_1_width, $el_merijumi_first_table_row_height * 2, "Mēriekārta", 'TLR',
            0, 'C', false);
        $pdf->cell($el_merijumi_first_table_row_2_width, $el_merijumi_first_table_row_height, " Nosaukums:", 'TRB', 0,
            'L', false);
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_first_table_row_3_width, $el_merijumi_first_table_row_height, " ProInstall 200", 'TRB',
            1, 'L', false);

// first table second row
        left_padding();
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_first_table_row_1_width, $el_merijumi_first_table_row_height, "", 'LBR', 0, 'C', false);
        $pdf->cell($el_merijumi_first_table_row_2_width, $el_merijumi_first_table_row_height, " Ident. Nr.", 'RB', 0,
            'L', false);
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_first_table_row_3_width, $el_merijumi_first_table_row_height, " 309482", 'RB', 1, 'L',
            false);

// first table third row
        left_padding();
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_first_table_row_1_width + $el_merijumi_first_table_row_2_width,
            $el_merijumi_first_table_row_height, " Mērījumu metodika:", 'LBR', 0, 'L', false);
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_first_table_row_3_width, $el_merijumi_first_table_row_height, " LRTDEA Nr.08.43/016",
            'RB', 1, 'L', false);

// first table fourth row
        left_padding();
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_first_table_row_1_width + $el_merijumi_first_table_row_2_width,
            $el_merijumi_first_table_row_height, " Normatīvs", 'LBR', 0, 'L', false);
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_first_table_row_3_width, $el_merijumi_first_table_row_height, " LVS344 :2014", 'BR', 1,
            'L', false);

// first table fifth row
        left_padding();
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_first_table_row_1_width + $el_merijumi_first_table_row_2_width,
            $el_merijumi_first_table_row_height, " Vizuālā apskate", 'LBR', 0, 'L', false);
        $pdf->cell($el_merijumi_first_table_row_3_width, $el_merijumi_first_table_row_height, "", 'RB', 1, 'C', false);


// first table end


// second table

        $pdf->Ln(5);
// second table first row
        left_padding();
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, "Nr.", 'TLR', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height, " Mērījumu vieta",
            'TLR', 0, 'L', false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, " Izolācijas",
            'TLR', 0, 'L', false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, " Zemējuma",
            'TLR', 0, 'L', false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, " Pārejas",
            'TLR', 1, 'L', false);

// second table second row
        left_padding();
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, "", 'LR', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height,
            " (līnijas vai iekārtas nosaukums)", 'LR', 0, 'L', false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height,
            " pretestība, MΩ", 'LR', 0, 'L', false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, " pretestība, Ω",
            'LR', 0, 'L', false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, " pretestība, Ω",
            'LR', 1, 'L', false);

// second table third row
        left_padding();
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, "", 'LR', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height, "", 'LR', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, " (Pārbaudes ",
            'LR', 0, 'L', false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, "", 'LR', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, "", 'LR', 1, 'L',
            false);

// second table fourth row
        left_padding();
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, "", 'LR', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height, "", 'LR', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, " (spriegums ",
            'LR', 0, 'L', false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, "", 'LR', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, "", 'LR', 1, 'L',
            false);

// second table fifth row
        left_padding();
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, "", 'LR', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height, "", 'LR', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, " 500V) ", 'LRB',
            0, 'L', false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, "", 'LRB', 0,
            'L', false);
        $pdf->cell($el_merijumi_second_table_col_data_width * 2, $el_merijumi_second_table_row_height, "", 'LRB', 1,
            'L', false);

// second table sixth row
        left_padding();
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, "", 'LRB', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height, "", 'LRB', 0, 'L',
            false);

        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "≥ 1,0 ", 'LRB', 0,
            'C', false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "< 1,0 ", 'RB', 0,
            'C', false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "≤ 4,0 ", 'RB', 0,
            'C', false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "˃ 4,0 ", 'RB', 0,
            'C', false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "≤ 0,1 ", 'RB', 0,
            'C', false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "˃ 0,1 ", 'RB', 1,
            'C', false);


// second table sixth row
        left_padding();
        $pdf->SetFillColor($el_merijumi_red_fill_color, $el_merijumi_green_fill_color, $el_merijumi_blue_fill_color);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, " 1.", 'LRB', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height, " Barojošais kabelis",
            'LRB', 0, 'L', false);
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'LRB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'RB', 0, 'C',
            false);
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 0, 'C',
            true);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 1, 'C',
            true);


// second table seventh row
        left_padding();
        $pdf->SetFillColor($el_merijumi_red_fill_color, $el_merijumi_green_fill_color, $el_merijumi_blue_fill_color);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, " 2.", 'LRB', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height, " Lifta elektrodzinējs",
            'LRB', 0, 'L', false);
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'LRB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'RB', 0, 'C',
            false);
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 0, 'C',
            true);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 1, 'C',
            true);

// second table eighth row
        left_padding();
        $pdf->SetFillColor($el_merijumi_red_fill_color, $el_merijumi_green_fill_color, $el_merijumi_blue_fill_color);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, " 3.", 'LRB', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height,
            " Elektreomagnētiskās bremzes", 'LRB', 0, 'L', false);
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'LRB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'RB', 0, 'C',
            false);
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 0, 'C',
            true);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 1, 'C',
            true);

// second table nineth row
        left_padding();
        $pdf->SetFillColor($el_merijumi_red_fill_color, $el_merijumi_green_fill_color, $el_merijumi_blue_fill_color);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, " 4.", 'LRB', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height,
            " Pazeminošais transformators", 'LRB', 0, 'L', false);
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'LRB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'RB', 0, 'C',
            false);
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 0, 'C',
            true);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 1, 'C',
            true);

// second table tenth row
        left_padding();
        $pdf->SetFillColor($el_merijumi_red_fill_color, $el_merijumi_green_fill_color, $el_merijumi_blue_fill_color);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, " 5.", 'LRB', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height,
            " Kabīnes durvju elektrodzinējs", 'LRB', 0, 'L', false);
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'LRB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'RB', 0, 'C',
            false);
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 0, 'C',
            true);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 1, 'C',
            true);

// second table eleventh row
        left_padding();
        $pdf->SetFillColor($el_merijumi_red_fill_color, $el_merijumi_green_fill_color, $el_merijumi_blue_fill_color);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, " 6.", 'LRB', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height, " Galaslēdžu kabelis",
            'LRB', 0, 'L', false);
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'LRB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'RB', 0, 'C',
            false);
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 0, 'C',
            true);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 1, 'C',
            true);

// second table twelwth row
        left_padding();
        $pdf->SetFillColor($el_merijumi_red_fill_color, $el_merijumi_green_fill_color, $el_merijumi_blue_fill_color);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, " 7.", 'LRB', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height, " Apgaismojuma ķēde",
            'LRB', 0, 'L', false);
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'LRB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'RB', 0, 'C',
            false);
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 0, 'C',
            true);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 1, 'C',
            true);

// second table thirteenth row
        left_padding();
        $pdf->SetFillColor($el_merijumi_red_fill_color, $el_merijumi_green_fill_color, $el_merijumi_blue_fill_color);
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, " 8.", 'LRB', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height, " Metālkonstrukcijas",
            'LRB', 0, 'L', false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 0, 'C',
            true);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 0, 'C',
            true);
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "X", 'RB', 0, 'C',
            false);
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 1, 'C',
            false);


// second table fourteenth row
        left_padding();
        $pdf->cell($el_merijumi_automargin, $el_merijumi_first_table_row_height, "", 0, 0, 'C', false);
        $pdf->cell($el_merijumi_second_table_col_1_width, $el_merijumi_second_table_row_height, " 8.", 'LRB', 0, 'L',
            false);
        $pdf->cell($el_merijumi_second_table_col_2_width, $el_merijumi_second_table_row_height, " Metālkonstrukcijas",
            'LRB', 0, 'L', false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'TRBL', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 0, 'C',
            false);
        $pdf->cell($el_merijumi_second_table_col_data_width, $el_merijumi_second_table_row_height, "", 'RB', 1, 'C',
            false);

// second table end

// el merijumi sledziens
        $pdf->Ln(10);
// el merijumi sledziens first row
        left_padding();
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell(15, $el_merijumi_sledziens_row_height, "Slēdziens:", '', 1, 'L', false);
        $pdf->Ln($el_merijumi_sledziens_line_distance);

// el merijumi sledziens second row
        left_padding();
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell(25, $el_merijumi_sledziens_row_height, "Atbilstošo atzīmēt ", '', 0, 'L', false);
        getPositionForCheckbox($pdf);
        $pdf->cell(5, $el_merijumi_sledziens_row_height, "", '', 1, 'L', false);
        $pdf->Ln($el_merijumi_sledziens_line_distance);

// el merijumi sledziens third row
        left_padding();
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_sledziens_col_1_width, $el_merijumi_sledziens_row_height, "Izolācijas pretestība", '',
            0, 'L', false);
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_sledziens_col_2_width, $el_merijumi_sledziens_row_height, "atbilst", '', 0, 'L', false);
        $pdf->SetFont('ArialRegular', '', 10);
        getPositionForCheckbox($pdf);
        $pdf->cell($el_merijumi_sledziens_col_checkbox_width, $el_merijumi_sledziens_row_height, "", '', 0, 'L', false);
        $pdf->cell($el_merijumi_sledziens_col_4_width, $el_merijumi_sledziens_row_height, "neatbilst", '', 0, 'L',
            false);
        getPositionForEmptyCheckbox($pdf);
        $pdf->cell($el_merijumi_sledziens_col_checkbox_width, $el_merijumi_sledziens_row_height, "", '', 0, 'L', false);
        $pdf->cell($el_merijumi_sledziens_col_5_width, $el_merijumi_sledziens_row_height, "normai,", '', 1, 'L', false);
        $pdf->Ln($el_merijumi_sledziens_line_distance);

// el merijumi sledziens fourth row
        left_padding();
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_sledziens_col_1_width, $el_merijumi_sledziens_row_height, "Zemējuma pretestība", '', 0,
            'L', false);
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_sledziens_col_2_width, $el_merijumi_sledziens_row_height, "atbilst", '', 0, 'L', false);
        $pdf->SetFont('ArialRegular', '', 10);
        getPositionForCheckbox($pdf);
        $pdf->cell($el_merijumi_sledziens_col_checkbox_width, $el_merijumi_sledziens_row_height, "", '', 0, 'L', false);
        $pdf->cell($el_merijumi_sledziens_col_4_width, $el_merijumi_sledziens_row_height, "neatbilst", '', 0, 'L',
            false);
        getPositionForEmptyCheckbox($pdf);
        $pdf->cell($el_merijumi_sledziens_col_checkbox_width, $el_merijumi_sledziens_row_height, "", '', 0, 'L', false);
        $pdf->cell($el_merijumi_sledziens_col_5_width, $el_merijumi_sledziens_row_height, "normai,", '', 1, 'L', false);
        $pdf->Ln($el_merijumi_sledziens_line_distance);

// el merijumi sledziens fifth row
        left_padding();
        $pdf->SetFont('ArialRegular', '', 10);
        $pdf->cell($el_merijumi_sledziens_col_1_width, $el_merijumi_sledziens_row_height, "Pārejas pretestība", '', 0,
            'L', false);
        $pdf->SetFont('ArialBold', '', 10);
        $pdf->cell($el_merijumi_sledziens_col_2_width, $el_merijumi_sledziens_row_height, "atbilst", '', 0, 'L', false);
        $pdf->SetFont('ArialRegular', '', 10);
        getPositionForCheckbox($pdf);
        $pdf->cell($el_merijumi_sledziens_col_checkbox_width, $el_merijumi_sledziens_row_height, "", '', 0, 'L', false);
        $pdf->cell($el_merijumi_sledziens_col_4_width, $el_merijumi_sledziens_row_height, "neatbilst", '', 0, 'L',
            false);
        getPositionForEmptyCheckbox($pdf);
        $pdf->cell($el_merijumi_sledziens_col_checkbox_width, $el_merijumi_sledziens_row_height, "", '', 0, 'L', false);
        $pdf->cell($el_merijumi_sledziens_col_5_width, $el_merijumi_sledziens_row_height, "normai.", '', 1, 'L', false);
        $pdf->Ln($el_merijumi_sledziens_line_distance);

// el merijumi sledziens sixth row
        left_padding();
        $pdf->cell($width, $el_merijumi_sledziens_row_height, "Neatbilstību apraksti (papildus norādījumi):", '', 1,
            'L', false);
        $pdf->Ln(2);

// el merijumi sledziens lines 3 rows
        left_padding();
        left_padding();
        $pdf->cell($el_merijumi_sledziens_col_lines_width, $el_merijumi_sledziens_row_height, "", 'B', 1, 'L', false);
        left_padding();
        left_padding();
        $pdf->cell($el_merijumi_sledziens_col_lines_width, $el_merijumi_sledziens_row_height, "", 'B', 1, 'L', false);
        left_padding();
        left_padding();
        $pdf->cell($el_merijumi_sledziens_col_lines_width, $el_merijumi_sledziens_row_height, "", 'B', 1, 'L', false);


        $pdf->Ln(12);
        left_padding();
        left_padding();
        $pdf->SetFont($font_family_default_bold, '', $font_size_default);

        $pdf->cell(25, 5, "Eksperts ", 0, 0, 'L', false);
        $pdf->cell(45, 5, "Igors Koptevs", "B", 1, 'C', false);

        left_padding();
        left_padding();
        $pdf->SetFillColor(123, 123, 123);
        $pdf->SetFont($font_family_default, '', 7);
        $pdf->cell(25, 3, "", 0, 0, 'R', false);
        $pdf->cell(45, 3, "(vārds, uzvārds)", 0, 1, 'C', false);

        $pdf->Ln(3);
        $pdf->SetFont($font_family_default_bold, '', $font_size_default);
        left_padding();
        left_padding();
        $pdf->cell(35, 5, "Pārbaudes datums ", 0, 0, 'L', false);
        $pdf->cell(45, 5, $parbaude['parbaude_datums'], "B", 1, 'C', false);


// footer
        $pdf->Ln(50);
        left_padding();
        $pdf->cell(0, 7, "Protokols parakstīts ar drošu elektronisko parakstu un satur laika zīmogu.", 0, 0, 'L',
            false);


//getPositionForCheckbox($pdf); //place where checkbox is needed
        foreach ($checkboxes as $checkbox) {
            $pdf->Image('./img/checkbox.png',
                $checkbox['x'] + $el_merijumi_second_table_col_data_width / 2 - $checkbox_image_width / 2,
                $checkbox['y'], $checkbox_image_width, $checkbox_image_height,);
        }
        foreach ($empty_checkboxes as $empty_checkbox) {
            $pdf->Image('./img/checkbox.png',
                $empty_checkbox['x'] + $el_merijumi_second_table_col_data_width / 2 - $checkbox_image_width / 2,
                $empty_checkbox['y'], $checkbox_image_width, $checkbox_image_height,);
        }
// var_dump($checkboxes);


// var_dump($parbaude);
        $pdf->output('I', $parbaude['parbaude_datums'].'_'.$lifts['lifts_reg_nr'].'_'.str_replace(',', '_',
                $lifts['lifts_parbaudes_adrese']).'.pdf', true);

//
//        $pdf->Write(8, 'Done!');
//        $pdf->output();

    }
}

<?php
use League\Csv\Reader;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

require __DIR__ . '/vendor/autoload.php';
require './sqlCredentials.cfg.php';

if (!ini_get("auto_detect_line_endings")) {
    ini_set("auto_detect_line_endings", '1');
}

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $dbAppHost,
    'database'  => $dbAppName,
    'username'  => $dbAppLogin,
    'password'  => $dbAppPassword,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

$csvr = Reader::createFromPath('./lexique.csv', 'r');
$csvr->setDelimiter(';');
$csvr->setHeaderOffset(0);
$records = $csvr->getRecords();
$total = count($csvr);
$i = 1;
foreach ($records as $offset => $record) {
    Capsule::table('lexique')->insert(
        [
            'ortho' => $record['1_ortho'],
            'phon' => $record['2_phon'],
            'lemme' => $record['3_lemme'],
            'cgram' => $record['4_cgram'],
            'genre' => $record['5_genre'],
            'nombre' => $record['6_nombre'],
            'freqlemfilms' => floatval($record['7_freqlemfilms2']),
            'freqlemlivres' => floatval($record['8_freqlemlivres']),
            'freqfilms' => floatval($record['9_freqfilms2']),
            'freqlivres' => floatval($record['10_freqlivres']),
            'infover' => $record['11_infover'],
            'nbhomogr' => intval($record['12_nbhomogr']),
            'nbhomoph' => intval($record['13_nbhomoph']),
            'islem' => intval($record['14_islem']),
            'nblettres' => intval($record['15_nblettres']),
            'nbphons' => intval($record['16_nbphons']),
            'cvcv' => $record['17_cvcv'],
            'p_cvcv' => $record['18_p_cvcv'],
            'voisorth' => intval($record['19_voisorth']),
            'voisphon' => intval($record['20_voisphon']),
            'puorth' => intval($record['21_puorth']),
            'puphon' => intval($record['22_puphon']),
            'syll' => $record['23_syll'],
            'nbsyll' => intval($record['24_nbsyll']),
            'cv_cv' => $record['25_cv-cv'],
            'orthrenv' => $record['26_orthrenv'],
            'phonrenv' => $record['27_phonrenv'],
            'orthosyll' => $record['28_orthosyll'],
            'cgramortho' => $record['29_cgramortho'],
            'deflem' => floatval($record['30_deflem']),
            'defobs' => floatval($record['31_defobs']),
            'old20' => floatval($record['32_old20']),
            'pld20' => floatval($record['33_pld20']),
            'morphoder' => $record['34_morphoder'],
            'nbmorph' => floatval($record['35_nbmorph'])
        ]
    );
    echo '#' . str_pad($i, 5, '0', STR_PAD_LEFT) . '/' . $total . '. ' . $record['1_ortho'] . ' (' . $record['4_cgram'] . ') : ok.<br />';
    $i++;
}

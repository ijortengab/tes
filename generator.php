<?php

use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;
use PedagangAmanah\StorageByNick;
use PedagangAmanah\StorageByBank;
use PedagangAmanah\FileJavascript;
    
require __DIR__ . '/vendor/autoload.php';

$finder = new Finder();
$finder->files()->in(__DIR__ . '/db')->name('*.yml');

// Populate Arrays.
foreach ($finder as $file) {
    try {
        $array = Yaml::parse(file_get_contents($file->getRealPath()));
        if (null === $array) {
            continue;
        }
        StorageByNick::save($array);
        StorageByBank::save($array);        
    } catch (ParseException $e) {
        continue;
    }
}

// Save File of Table Nick.
$file = new FileJavascript('docs/nick-data-set.js', 'nickDataSet', StorageByNick::$storage);
$file->save();
$columns = StorageByNick::getColumns();
$data = [];
foreach ($columns as $column) {
    $_data = ['title' => $column];
    $data[] = $_data;
}
$file = new FileJavascript('docs/nick-info-columns.js', 'nickInfoColumns', $data);
$file->save();


// Save File of Table Bank.
$file = new FileJavascript('docs/bank-data-set.js', 'bankDataSet', StorageByBank::$storage);
$file->save();
$columns = StorageByBank::getColumns();
$data = [];
foreach ($columns as $column) {
    $_data = ['title' => $column];
    $data[] = $_data;
}
$file = new FileJavascript('docs/bank-info-columns.js', 'bankInfoColumns', $data);
$file->save();



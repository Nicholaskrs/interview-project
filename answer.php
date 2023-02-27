<?php

require_once __DIR__ . '/vendor/autoload.php';

use Nicholas\InterviewProject\Helper\FileHelper;

function arguments($argv)
{
    $_ARG = array();
    foreach ($argv as $arg) {
        if (preg_match('#^-{1,2}([^=]+)=?(.*)$#', $arg, $matches)) {
            $key = $matches[1];
            switch ($matches[2]) {
                case '':
                case 'true':
                    $arg = true;
                    break;
                case 'false':
                    $arg = false;
                    break;
                default:
                    $arg = $matches[2];
            }
            $_ARG[$key] = $arg;
        } else {
            $_ARG['input'][] = $arg;
        }
    }
    return $_ARG;
}


$args = arguments($argv);

if (!isset($args['source'])) {
    echo "args source are required!";
    return;
}
if (!isset($args['result'])) {
    echo "args result are required!";
    return;
}
$sourceFileName = $args['source'];
$sourceFilePath = __DIR__ . "\\" . $sourceFileName;
$fileParts = pathinfo($sourceFilePath);
$isFileExists = file_exists($sourceFilePath);

$helper = new FileHelper();

if (!$isFileExists) {
    echo "File Not Exists";
    return;
}

switch ($fileParts['extension']) {
    case 'csv':
        $data = $helper->getDataFromCSV($sourceFileName, ",");
        break;
    case 'json':
        $data = $helper->getDataFromJSON($sourceFileName);
        break;
    case 'tsv':
        $data = $helper->getDataFromCSV($sourceFileName, "\t");
        break;
    case 'xml':
        $data = $helper->getDataFromXML($sourceFileName);
        break;
    default:
        echo "File extension not supported";
        return;
}

$fileParts = pathinfo($args['result']);
$result = $helper->writeResultToFile($args['result'], $fileParts['extension'], $data);

if ($result)
    echo "Finish!";
else
    echo "Save Failed!";
return;
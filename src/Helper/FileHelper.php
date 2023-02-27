<?php


namespace Nicholas\InterviewProject\Helper;


class FileHelper
{


    public function getDataFromCSV($filename, $delimiter = ",")
    {
        $result = [];
        if (($handle = fopen(__DIR__ . "\\..\\..\\" . $filename, "r")) !== FALSE) {
            $header = fgetcsv($handle, 1, $delimiter);
            while (($data = fgetcsv($handle, 10000, $delimiter)) !== FALSE) {
                $result = $this->getResult($data, $result, $header);
            }
            fclose($handle);
        }
        return array_values($result);
    }

    public function getResult($data, array $result, $header = null): array
    {
        $index = implode(".", $data);
        if (!isset($result[$index])) {

            if ($header !== null) {
                foreach ($header as $num => $h) {

                    $result[$index]['data'][$h] = $data[$num];
                }
            } else {
                $result[$index]['data'] = $data;
            }
            $result[$index]['data']['counter'] = 1;
        } else {
            $result[$index]['data']['counter']++;
        }
        return $result;
    }

    public function getDataFromJSON($filename)
    {
        $result = [];
        $json = file_get_contents($filename);
        $jsonData = json_decode($json, true);
        foreach ($jsonData as $data) {
            $result = $this->getResult($data, $result);
        }
        return array_values($result);
    }

    public function getDataFromXML($filename)
    {
        $result = [];
        $xml = file_get_contents($filename);
        $xmlData = simplexml_load_string($xml);

        $jsonData = json_encode($xmlData);
        $jsonData = json_decode($jsonData, true);

        foreach ($jsonData['product'] as $data) {
            $result = $this->getResult($data, $result);
        }
        return array_values($result);
    }

    public function saveToCSV($fp, $data)
    {
        foreach ($data as $fields) {
            fputcsv($fp, $fields['data']);
        }
        return true;
    }

    public function saveToTSV($fp, $data)
    {
        foreach ($data as $fields) {
            fputcsv($fp, $fields['data'], "\t");
        }
        return true;
    }

    public function saveToJSON($fp, $data)
    {
        $data = json_encode($data);
        fwrite($fp, $data);
        return true;
    }

    public function writeResultToFile($filename, $fileExtension, $data)
    {

        $result = true;
        $fp = fopen($filename, 'w');
        switch ($fileExtension) {
            case 'csv':
                $result = $this->saveToCSV($fp, $data);
                break;
            case 'json':
                $result = $this->saveToJson($fp, $data);
                break;
            case 'tsv':
                $result = $this->saveToTSV($fp, $data);
                break;
            default:
                return false;
        }
        fclose($fp);
        return $result;
    }
}
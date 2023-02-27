<?php


use Nicholas\InterviewProject\Helper\FileHelper;
use PHPUnit\Framework\TestCase;

class FileHelperTest extends TestCase
{
    private $fileHelper;


    public function testGetDataFromCSV()
    {

        $fileHelper = new FileHelper();
        $result = $fileHelper->getDataFromCSV("tests/test.csv", ",");
        $this->assertEquals('[{"data":{"brand_name":"AASTRA","model_name":"6865I","condition_name":"Working","grade_name":"Grade B - Good Condition","gb_spec_name":"Not Applicable","colour_name":"Black","network_name":"Not Applicable","counter":3}},{"data":{"brand_name":"AASTRA","model_name":"6865I","condition_name":"Working","grade_name":"Grade A - Very Good Condition","gb_spec_name":"Not Applicable","colour_name":"Black","network_name":"Not Applicable","counter":1}},{"data":{"brand_name":"ABOOK","model_name":"1720W","condition_name":"Working","grade_name":"Grade B - Good Condition","gb_spec_name":"4GB","colour_name":"Black","network_name":"Not Applicable","counter":1}},{"data":{"brand_name":"ACCESSORIZE","model_name":"UNIVERSAL 10 INCH TABLET FOLIO CASE - BIRDS BLACK","condition_name":"Brand New","grade_name":"Brand New","gb_spec_name":"Not Applicable","colour_name":"Multicolour","network_name":"Not Applicable","counter":9}}]', json_encode($result));
        $result = $fileHelper->writeResultToFile("tests/result.csv","csv",$result);
        $this->assertTrue($result);
        $this->assertFileEquals("tests/ExpectedResult.csv","tests/result.csv");

    }

    public function testGetDataFromTSV()
    {
        $fileHelper = new FileHelper();
        $result = $fileHelper->getDataFromCSV("tests/test.tsv", "\t");
        $this->assertEquals('[{"data":{"brand_name":"AASTRA","model_name":"6865I","condition_name":"Working","grade_name":"Grade B - Good Condition","gb_spec_name":"Not Applicable","colour_name":"Black","network_name":"Not Applicable","counter":3}},{"data":{"brand_name":"AASTRA","model_name":"6865I","condition_name":"Working","grade_name":"Grade A - Very Good Condition","gb_spec_name":"Not Applicable","colour_name":"Black","network_name":"Not Applicable","counter":1}},{"data":{"brand_name":"ABOOK","model_name":"1720W","condition_name":"Working","grade_name":"Grade B - Good Condition","gb_spec_name":"4GB","colour_name":"Black","network_name":"Not Applicable","counter":1}},{"data":{"brand_name":"ACCESSORIZE","model_name":"UNIVERSAL 10 INCH TABLET FOLIO CASE - BIRDS BLACK","condition_name":"Brand New","grade_name":"Brand New","gb_spec_name":"Not Applicable","colour_name":"Multicolour","network_name":"Not Applicable","counter":10}}]', json_encode($result));
        $result = $fileHelper->writeResultToFile("tests/result.tsv","tsv",$result);
        $this->assertTrue($result);
        $this->assertFileEquals("tests/ExpectedResult.tsv","tests/result.tsv");
    }

    public function testGetDataFromJSON()
    {
        $fileHelper = new FileHelper();
        $result = $fileHelper->getDataFromJSON("tests/test.json");
        $this->assertEquals('[{"data":{"brand_name":"AASTRA","model_name":"6865I","condition_name":"Working","grade_name":"Grade B - Good Condition","gb_spec_name":"Not Applicable","colour_name":"Black","network_name":"Not Applicable","counter":3}},{"data":{"brand_name":"AASTRA","model_name":"6865I","condition_name":"Working","grade_name":"Grade A - Very Good Condition","gb_spec_name":"Not Applicable","colour_name":"Black","network_name":"Not Applicable","counter":1}},{"data":{"brand_name":"ACCESSORIZE","model_name":"UNIVERSAL 10 INCH TABLET FOLIO CASE - BIRDS BLACK","condition_name":"Brand New","grade_name":"Brand New","gb_spec_name":"Not Applicable","colour_name":"Multicolour","network_name":"Not Applicable","counter":6}},{"data":{"brand_name":"Acer","model_name":"4551-P322G25MNSK","condition_name":"Power On Tested-Good LCD","grade_name":"Unknown","gb_spec_name":"2GB","colour_name":"Silver","network_name":"Not Applicable","counter":3}},{"data":{"brand_name":"Acer","model_name":"4551-P322G25MNSK","condition_name":"Non-working","grade_name":"Unknown","gb_spec_name":"2GB","colour_name":"Silver","network_name":"Not Applicable","counter":1}}]', json_encode($result));
        $result = $fileHelper->writeResultToFile("tests/result.json","json",$result);
        $this->assertTrue($result);
        $this->assertFileEquals("tests/ExpectedResult.json","tests/result.json");
    }

    public function testGetDataFromXML()
    {
        $fileHelper = new FileHelper();
        $result = $fileHelper->getDataFromXML("tests/test.xml");
        $this->assertEquals('[{"data":{"brand_name":"AASTRA","model_name":"6865I","condition_name":"Working","grade_name":"Grade B - Good Condition","gb_spec_name":"Not Applicable","colour_name":"Black","network_name":"Not Applicable","counter":4}},{"data":{"brand_name":"AASTRA","model_name":"6865I","condition_name":"Working","grade_name":"Grade A - Very Good Condition","gb_spec_name":"Not Applicable","colour_name":"Black","network_name":"Not Applicable","counter":1}},{"data":{"brand_name":"ACCESSORIZE","model_name":"UNIVERSAL 10 INCH TABLET FOLIO CASE - BIRDS BLACK","condition_name":"Brand New","grade_name":"Brand New","gb_spec_name":"Not Applicable","colour_name":"Multicolour","network_name":"Not Applicable","counter":13}}]', json_encode($result));
        $result = $fileHelper->writeResultToFile("tests/result.xml","xml",$result);
        $this->assertTrue(!$result);
    }



}
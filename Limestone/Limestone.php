<?php


class Limestone
{
    public function getFolderFiles($path)
    {
        $arrayRes = [];
        $scanned_directory = array_diff(scandir($path), array('..', '.'));
        foreach ($scanned_directory as $filename) {
            $arrayRes[] = $filename;
            var_dump($filename);
            if ( is_array(scandir($filename))) {
                $test = scandir($filename);
                var_dump($test);die;
                foreach ($test as $filename) {
                        $arrayRes[] = $filename;
                }
            }
        }

        foreach ($arrayRes as $key => $filename) {
            echo $key . "  :  ". $filename. " \n";
        }
    }

    public function parseFile($fileContent)
    {

    }

    public function htmlToXml($html)
    {

    }

    public function htmlToYaml($html)
    {

    }
}
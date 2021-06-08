<?php


class Limestone
{
    public function getFolderFiles($path)
    {
        $arrayRes = [];
        $scanned_directory = array_diff(scandir($path), array('..', '.'));
        foreach ($scanned_directory as $filename) {
            $arrayRes[] = $path . "/" . $filename;
            if (is_dir($path. "/". $filename)) {
                $test = array_diff(scandir($path. "/". $filename), array('..', '.'));
                foreach ($test as $filename) {
                        $arrayRes[] = $path . "/" . $filename;
                }
            }
        }

        foreach ($arrayRes as $key => $filename) {
            echo $key . "  :  ". $filename. " \n";
        }

        return $arrayRes;
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
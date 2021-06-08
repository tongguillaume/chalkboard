<?php


class Limestone
{
    private function getFolderFiles($path)
    {
        $scanned_directory = array_diff(scandir($path), array('..', '.'));
    }

    private function parseFile($fileContent)
    {

    }

    private function htmlToXml()
    {

    }

    private function htmlToYaml()
    {
        
    }
}
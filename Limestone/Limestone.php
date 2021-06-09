<?php

namespace Limestone;
require_once __DIR__ . '/../vendor/autoload.php';
use Html2Text\Html2Text;


class Limestone
{
    public function getFolderFiles($path)
    {
        $arrayRes = [];
        $scanned_directory = array_diff(scandir($path), array('..', '.'));
        foreach ($scanned_directory as $filename) {
            if(is_dir($path . "/" .$filename)) {
                $testRecursion = $this->getFolderFiles($path . "/" .$filename);
                $arrayRes = array_merge($arrayRes, $testRecursion);
            } else {
                $arrayRes[] = $path . "/" . $filename;
            }
        }


        return $arrayRes;
    }

    public function parseFile($path) //
    {
        $fileContent = file_get_contents($path);
        $content = new Html2Text($fileContent);
        $arrayContent = explode("\n", $content->getText());
        $arrayRes = [];
        $stringLine = "";

        foreach ($arrayContent as $line) {
            if ($line != "") {
                if ($stringLine != "") {
                    $arrayRes[] = $stringLine;
                    $stringLine = "";
                }
                $stringLine .= $line;
            } else {
                $arrayRes[] = $stringLine;
                $stringLine = "";
            }
        }
        $arrayRes[] = $stringLine;
        $arrayRes = self::parseLine($arrayRes);

        return $arrayRes;
    }

    public function deletePartOfLine($line, $elem, $lastOrFirst)
    {
        if (strstr($line, $elem) === false)
            return $line;
      return strstr($line, $elem, $lastOrFirst);
    }


    public function parseLine($arrayLine)
    {
        $arrayRes = [];
        foreach ($arrayLine as $line) {
            $line = trim($line);
            $line = preg_replace("/{{.*?}}/", "", $line);
            $line = preg_replace("/{%.*?%}/", "", $line);
            $line = preg_replace("/\[.*?\]/", "", $line);
            $line = preg_replace("/form_.*?\)/", "", $line);
            $line = str_replace(" __ ", "", $line);
            $line = str_replace("__", "", $line);
            $line = self::deletePartOfLine($line, "{{", true);
            $line = self::deletePartOfLine($line, "form_", true);
            $line = self::deletePartOfLine($line, "}}", false);
            $line = self::deletePartOfLine($line, "%}", false);
            $line = self::deletePartOfLine($line, "{%", true);
            $line = str_replace("%}", "", $line);
            $line = str_replace("}} ) }}", "", $line);
            $line = str_replace("}}) }}", "", $line);
            $line = str_replace('"', "", $line);
            $line = str_replace('"', "", $line);
            $line = trim($line);

            if ($line != "" && preg_match("/[a-zA-Z]/i", $line)) {
                $arrayRes [] = $line;
            }
        }

        return $arrayRes;
    }

    public function htmlToXml($array)
    {
        file_put_contents("messages.fr.xml",'<?xml version="1.0" encoding="UTF-8" ?>
<xliff version="1.2" xmlns="urn:oasis:names:tc:xliff:document:1.2">
    <file source-language="en" datatype="plaintext" original="file.ext">
        <body>
     ');
        foreach ($array as $key =>$arrayline ) {
            foreach ($arrayline as $line) {
                $keyWord = self::getKeyWord($line);
                file_put_contents("messages.fr.xml", '            <trans-unit id="'.strtolower($keyWord).'">'."\n",FILE_APPEND);
                file_put_contents("messages.fr.xml", '                <source>'.strtolower($keyWord).'</source>'."\n",FILE_APPEND);
                file_put_contents("messages.fr.xml", '                <target>'.$line.'</target>'."\n",FILE_APPEND);
                file_put_contents("messages.fr.xml", '             </trans-unit>'."\n",FILE_APPEND);
            }
        }

        file_put_contents("messages.fr.xml",'        </body>
   </file>
</xliff>', FILE_APPEND
        );
    }

    public function getKeyWord($line)
    {
        $strToWordTab = explode(' ',trim($line));
        if (count($strToWordTab) == 1) {
            $keyWord = $strToWordTab[0];
        } else if (count($strToWordTab) > 1) {
            $keyWord = $strToWordTab[0].'_'.$strToWordTab[1];
        } else {
            $keyWord = "fin frero, tu es cringe";
        }

        return $keyWord;
    }

    public function htmlToYaml($array)
    {
        foreach ($array as $key => $arrayLine) {
            foreach ($arrayLine as  $line) {
               $keyWord = self::getKeyWord($line);
                //recreate the file
                if ($key == 0) {
                    file_put_contents("messages.fr.yaml", strtolower($keyWord) . ': ' . $line . "\n");
                } else {
                    file_put_contents("messages.fr.yaml", strtolower($keyWord) . ': ' . $line . "\n", FILE_APPEND);
                }
            }
        }
    }
}
<?php

use PHPUnit\Framework\TestCase;

final class ChalkboardTest extends TestCase
{

    public function testGetFolderFiles(): void
    {
        $chalkboard = new Chalkboard\Chalkboard();

        $valid = $chalkboard->getFolderFiles("templates");
        $notValid = $chalkboard->getFolderFiles("jesaispas");

        $this->assertNotNull($valid);
        $this->assertEmpty($notValid, "Le dossier est introuvable");
    }

    public function testParseFile()
    {
        $chalkboard = new Chalkboard\Chalkboard();

        $valid = $chalkboard->parseFile("templates");
        $notValid = $chalkboard->parseFile("jesaispas");

        $this->assertNotNull($valid);
        $this->assertEmpty($notValid, "Le dossier est introuvable");

    }
    /*public function testDeletePartOfLine()
    {

    }
    public function testParseLine()
    {

    }
    public function testHtmlToXml()
    {

    }
    public function testRemove_accent()
    {

    }
    public function testGetKeyWord()
    {

    }

    public function testHtmlToYaml()
    {

    }

    public function testCreateXMLandYaml()
    {

    }*/
}
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

        $valid = $chalkboard->parseFile("templates/base.html.twig");
        $notValid = $chalkboard->parseFile("jesaispas");

        $this->assertNotNull($valid);
        $this->assertEmpty($notValid, "Le dossier est introuvable");

    }
    public function testDeletePartOfLine()
    {
        $chalkboard = new Chalkboard\Chalkboard();

        $line1 = $chalkboard->deletePartOfLine("jesaispas", "je", true);
        $this->assertEmpty($line1);
        $line2 = $chalkboard->deletePartOfLine("jesaispas", "je", false);
        $this->assertEquals("jesaispas", $line2);

    }
    public function testParseLine()
    {
        $chalkboard = new Chalkboard\Chalkboard();
        $arr = ["Les chicos", "form_widget('machin')", "[index.html]", "[https://www.google.fr]"];

        $valid = $chalkboard->parseLine($arr);

        $this->assertContains("Les chicos", $valid);
    }
    public function testHtmlToXml()
    {
        $content = file_get_contents("Chalkboard/translate/messages.fr.xml");
        $this->assertNotNull($content);
        $this->assertStringContainsString("<?xml version", $content);
    }
    public function testRemove_accent()
    {
        $chalkboard = new Chalkboard\Chalkboard();

        $resultat = $chalkboard->remove_accent("éndormi");
        $this->assertEquals($resultat, "endormi");
    }
    public function testGetKeyWord()
    {
        $chalkboard = new Chalkboard\Chalkboard();

        $resultat = $chalkboard->getKeyWord("Authentification normale ou spéciale");
        $this->assertEquals($resultat, "Authentification_normale");
    }

    public function testHtmlToYaml()
    {
        $content = file_get_contents("Chalkboard/translate/messages.fr.yaml");
        $this->assertNotNull($content);
    }

    
}
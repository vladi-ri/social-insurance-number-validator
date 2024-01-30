<?php

class SINValidator
{
    private int $_VALID_LENGTH  = 12;

    private string $_TEST_SIN   = "09 1231513613 29292";

    private array $AREA_NUMBERS = array(
        "Deutsche Rentenversicherung Nord" => array("02", "42", "89"),
        "Deutsche Rentenversicherung Mitteldeutschland" => array("09", "49", "80"),
        "Deutsche Rentenversicherung Braunschweig-Hannover" => array("10", "50", "80"),
        "Deutsche Rentenversicherung Westfalen" => array("11", "51", "80"),
        "Deutsche Rentenversicherung Hessen" => array("12", "52", "81"),
        "Deutsche Rentenversicherung Rheinland" => array("13", "53", "81"),
        "Deutsche Rentenversicherung Bayern Süd" => array("14", "54", "82"),
        "Deutsche Rentenversicherung Bayern Süd" => array("15", "55", "82"),
        "Deutsche Rentenversicherung Rheinland-Pfalz" => array("16", "56", "82"),
        "Deutsche Rentenversicherung für das Saarland" => array("17", "57", "82"),
        "Deutsche Rentenversicherung Oberfranken und Mittelfranken" => array("18", "58", "82"),
        "Deutsche Rentenversicherung Nord" => array("19", "59", "80"),
        "Deutsche Rentenversicherung Unterfranken" => array("20", "60", "82"),
        "Deutsche Rentenversicherung Schwaben" => array("21", "61", "82"),
        "Deutsche Rentenversicherung Baden-Württemberg" => array(array("23", "24"), array("63", "64"), "82"),
        "Deutsche Rentenversicherung Berlin-Brandenburg" => array("25", "65", "80"),
        "Deutsche Rentenversicherung Nord" => array("26", "66", "80"),
        "Deutsche Rentenversicherung Oldenburg-Bremen" => array("28", "68", "80"),
        "VSNR-Vergabe an Beschäftige bei Bahn- oder See-Betrieben" => array("38", "39")
    );

    public function setSIN(string $sin) : void {
        $this->_TEST_SIN = $sin;
    }

    public function getSIN() : string {
        return $this->_TEST_SIN;
    }

    public function validateLength($sin) : bool {
        $sin = trim($sin);

        return strlen($sin) !== $this->_VALID_LENGTH;
    }

    public function validateArea($sin) : string|false {
        $sinArea = substr($sin, 2, 7);
        $arrayNo = [];

        // TODO: if sinArea part of $AREA_NUMBERS
        foreach ($this->AREA_NUMBERS as $arrayNumbers) {
            foreach ($arrayNumbers as $an) {
                array_push($arrayNo, $an);
            }
        }

        return json_encode($arrayNo);
    }

    function validateSocialInsuranceNumber(string $sin) : bool {
        $this->validateLength($sin);
        $this->validateArea($sin);

        return false;
    }
};

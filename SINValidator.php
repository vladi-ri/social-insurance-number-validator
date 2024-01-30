<?php

/**
   * SINValidator
   * 
   * @package    SINValidator
   * @author     Vladislav Riemer <riemer-vladi@web.de>
   */
class SINValidator
{
    /**
     * Valid length of SIN
     * @var int $_VALID_LENGTH
     */
    private int $_VALID_LENGTH  = 12;

    /**
     * Object variable for testing SIN 
     * @var string $_TEST_SIN
     */
    private string $_TEST_SIN   = "09 1231513613 29292";

    /**
     * Defines valid area codes for social insurance number in Germany.
     * @var array $_AREA_NUMBERS
     */
    private array $_AREA_NUMBERS = array(
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

    /**
     * Setter for SIN
     * 
     * @param string $sin Social insurance number
     * 
     * @return void
     */
    public function setSIN(string $sin) : void {
        $this->_TEST_SIN = $sin;
    }

    /**
     * Getter for SIN
     * 
     * @return string
     */
    public function getSIN() : string {
        return $this->_TEST_SIN;
    }

    /**
     * Disassambles SIN into parts that need to be validated.
     * 
     * @param string $sin Social insurance number
     * 
     * @return string
     */
    public function disassambleSIN(string $sin) : array {
        $disassambledSIN = [];

        // first 2 digits
        $areaCode                  = str_split($sin, 2)[0];

        // start at third digit, length = 6
        $birthDay                  = substr($sin, 2, 6);

        // array at position 8 (starting at index 0)
        $startingLetterOfBirthname = $sin[8];

        // two digits for defining gender at position 9
        $genderSerialNumer         = substr($sin, 9, 2);

        // checksum at position 11
        $checksum                  = $sin[11];

        array_push($disassambledSIN, [
            $areaCode,
            $birthDay,
            $startingLetterOfBirthname,
            $genderSerialNumer,
            $checksum
        ]);

        return $disassambledSIN;
    }

    /**
     * Validator for length of social insurance number
     * 
     * @param string $sin Social insurance number
     * 
     * @return bool
     */
    public function validateLength($sin) : bool {
        $sin = trim($sin);

        return strlen($sin) !== $this->_VALID_LENGTH;
    }

    /**
     * Validator for area code of social insurance number
     * 
     * @param string $sin Social insurance number
     * 
     * @return string|false
     */
    public function validateArea($sin) : string|false {
        $sinArea = substr($sin, 2, 7);
        $arrayNo = [];

        // TODO: if sinArea part of $AREA_NUMBERS
        foreach ($this->_AREA_NUMBERS as $arrayNumbers) {
            // foreach ($arrayNumbers as $an) {
            //     // remove whitespaces
            //     // print_r($an);
            //     $an = trim($an);

            //     // add to array
            //     array_push($arrayNo, $an);
            // }
            // print("<pre>");
            // print_r($arrayNumbers);
            // print("</pre>");
            foreach ($arrayNumbers as $partialArrayNumbers) {
                if (is_array($partialArrayNumbers)) {
                    foreach ($partialArrayNumbers as $pan) {
                        echo in_array($sin, $arrayNo);
                    }
                }
            }
        }
        // print_r($arrayNo);

        // check if area code is exciting
        // print_r(in_array($sin, $arrayNo));

        // return json_encode($arrayNo);
        return "";
    }

    /**
     * Main function for testing all validation functions
     * 
     * @param string $sin Given social insurance number
     * 
     * @return bool
     */
    function validateSocialInsuranceNumber(string $sin) : bool {
        $this->validateLength($sin);
        $this->validateArea($sin);

        return false;
    }

    /**
     * Extract first letter of birthname from SIN.
     * 
     * @param array $sin
     * 
     * @return string
     */
    public function extractStartingLetterOfBirthname(array $sin) : string {
        return json_encode($sin[2]);
    }
};

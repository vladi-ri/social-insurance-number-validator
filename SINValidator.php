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
    private string $_TEST_SIN   = "03 160894 W 098";

    /**
     * Defines valid area codes for social insurance number in Germany.
     * @var array $_AREA_NUMBERS
     */
    private array $_AREA_NUMBERS = array(
        "Deutsche Rentenversicherung Nord (Mecklenburg-Vorpommern)" => "02",
        "Deutsche Rentenversicherung Mitteldeutschland (Thüringen)" => "03",
        "Deutsche Rentenversicherung Berlin-Brandenburg (Brandenburg)" => "04",
        "Deutsche Rentenversicherung Mitteldeutschland (Sachsen-Anhalt)" => "08",
        "Deutsche Rentenversicherung Mitteldeutschland (Sachsen)" => "09",
        "Deutsche Rentenversicherung Braunschweig-Hannover (Hannover)" => "10",
        "Deutsche Rentenversicherung Westfalen" => "11",
        "Deutsche Rentenversicherung Hessen" => "12",
        "Deutsche Rentenversicherung Rheinland (Rheinprovinz)" => "13",
        "Deutsche Rentenversicherung Bayern Süd (Oberbayern)" => "14",
        "Deutsche Rentenversicherung Bayern Süd (Niederbayern-Oberpfalz)" => "15",
        "Deutsche Rentenversicherung Rheinland-Pfalz" => "16",
        "Deutsche Rentenversicherung Saarland" => "17",
        "Deutsche Rentenversicherung Nordbayern (Ober- und Mittelfranken)" => "18",
        "Deutsche Rentenversicherung Nord (Hamburg)" => "19",
        "Deutsche Rentenversicherung Nordbayern (Unterfranken)" => "20",
        "Deutsche Rentenversicherung Schwaben" => "21",
        "Deutsche Rentenversicherung Baden-Württemberg (Württemberg)" => "23",
        "Deutsche Rentenversicherung Baden-Württemberg (Baden)" => "24",
        "Deutsche Rentenversicherung Berlin-Brandenburg (Berlin)" => "25",
        "Deutsche Rentenversicherung Nord (Schleswig-Holstein)" => "26",
        "Deutsche Rentenversicherung Oldenburg-Bremen" => "28",
        "Deutsche Rentenversicherung Braunschweig-Hannover (Braunschweig)" => "29",
        "Deutsche Rentenversicherung Knappschaft-Bahn-See (Wirtschaftsbereich Bahn)" => "38",
        "Deutsche Rentenversicherung Knappschaft-Bahn-See (Wirtschaftsbereich Seefahrt)" => "39",
        // 42 - 79 = (following area codes are equivalent to the area codes of the regional pension provider + 40
        "Deutsche Rentenversicherung Bund Nord (Mecklenburg-Vorpommern)" => "42",
        "Deutsche Rentenversicherung Bund Mitteldeutschland (Thüringen)" => "43",
        "Deutsche Rentenversicherung Bund Berlin-Brandenburg (Brandenburg)" => "44",
        "Deutsche Rentenversicherung Bund Mitteldeutschland (Sachsen-Anhalt)" => "48",
        "Deutsche Rentenversicherung Bund Mitteldeutschland (Sachsen)" => "49",
        "Deutsche Rentenversicherung Bund Braunschweig-Hannover (Hannover)" => "50",
        "Deutsche Rentenversicherung Bund Westfalen" => "51",
        "Deutsche Rentenversicherung Bund Hessen" => "52",
        "Deutsche Rentenversicherung Bund Rheinland (Rheinprovinz)" => "53",
        "Deutsche Rentenversicherung Bund Bayern Süd (Oberbayern)" => "54",
        "Deutsche Rentenversicherung Bund Bayern Süd (Niederbayern-Oberpfalz)" => "55",
        "Deutsche Rentenversicherung Bund Rheinland-Pfalz" => "56",
        "Deutsche Rentenversicherung Bund Saarland" => "57",
        "Deutsche Rentenversicherung Bund Nordbayern (Ober- und Mittelfranken)" => "58",
        "Deutsche Rentenversicherung Bund Nord (Hamburg)" => "59",
        "Deutsche Rentenversicherung Bund Nordbayern (Unterfranken)" => "60",
        "Deutsche Rentenversicherung Bund Schwaben" => "61",
        "Deutsche Rentenversicherung Bund Baden-Württemberg (Württemberg)" => "63",
        "Deutsche Rentenversicherung Bund Baden-Württemberg (Baden)" => "64",
        "Deutsche Rentenversicherung Bund Berlin-Brandenburg (Berlin)" => "65",
        "Deutsche Rentenversicherung Bund Nord (Schleswig-Holstein)" => "66",
        "Deutsche Rentenversicherung Bund Oldenburg-Bremen" => "68",
        "Deutsche Rentenversicherung Bund Braunschweig-Hannover (Braunschweig)" => "69",
        "Deutsche Rentenversicherung Bund Knappschaft-Bahn-See (Wirtschaftsbereich Bahn)" => "78",
        "Deutsche Rentenversicherung Bund Knappschaft-Bahn-See (Wirtschaftsbereich Seefahrt)" => "79",
        "Zentrale Zulagenstelle für Altersvermögen (Zulagenummer nach § 90 I 2 EStG)" => "40",
        "Knappschaft-Bahn-See (Berlin, Bremen, Hamburg, Niedersachsen, Westfalen und Schleswig-Holstein)" => "80",
        "Knappschaft-Bahn-See (Hessen und Rheinprovinz)" => "81",
        "Knappschaft-Bahn-See (Baden-Württemberg, Bayern, Rheinland-Pfalz und Saarland)" => "82",
        "Knappschaft-Bahn-See (Brandenburg, Mecklenburg-Vorpommern, Sachsen-Anhalt, Sachsen und Thüringen)" => "89"
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
     * Setter for AREA_NUMBERS
     * 
     * @param array $areaNumbers Array with area numbers of the insurances
     * 
     * @return void
     */
    public function setAreaNumbers(array $areaNumbers) : void {
        $this->_AREA_NUMBERS = $areaNumbers;
    }

    /**
     * Getter for AREA_NUMBERS
     * 
     * @return array
     */
    public function getAreaNumbers() : array {
        return $this->_AREA_NUMBERS;
    }

    /**
     * Disassambles SIN into parts that need to be validated.
     * 
     * @param string $sin Social insurance number
     * 
     * @return string
     */
    public function disassambleSIN(string $sin) : array {
        $disassambledSIN           = [];

        // normalize SIN - remove whitespaces
        $sin                       = preg_replace('/\s+/', '', $sin);

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
            "areaCode"                  => $areaCode,
            "birthday"                  => $birthDay,
            "startingLetterOfBirthname" => $startingLetterOfBirthname,
            "genderSerialNumer"         => $genderSerialNumer,
            "checksum"                  => $checksum
        ]);

        return $disassambledSIN[0];
    }

    /**
     * Validator for length of social insurance number
     * 
     * @param string $sin Social insurance number
     * 
     * @return bool
     */
    public function validateLength(string $sin) : bool {
        $sin = preg_replace('/\s+/', '', $sin);

        // remove array offset (-1)
        // 12 characters = array from 0 - 11
        $validLength = $this->_VALID_LENGTH - 1;

        return strlen($sin) !== $validLength;
    }

    /**
     * Helper for creating dynamic area codes for "Deutsche Rentenversicherung Bund"
     * 
     * @return array
     */
    public function getHelperArray() : array {
        // array keys
        $areaCodes = $this->getAreaNumbers();

        // array values
        $areaKeys  = array_keys($areaCodes);

        return [
            'areaKeys'  => $areaKeys,
            'areaCodes' => $areaCodes
        ];
    }

    /**
     * Validator for area code of social insurance number
     * Return false if sin area code not part of valid area codes, otherwise true
     * 
     * @param string $sin Social insurance number
     * 
     * @return bool
     */
    public function validateArea(string $sin) : bool {
        $sin       = $this->disassambleSIN($sin);
        $areaCodes = $this->getHelperArray()['areaCodes'];

        if (in_array($sin['areaCode'], $areaCodes)) {
            return true;
        }

        return false;
    }

    /**
     * Extract first letter of birthname from SIN.
     * 
     * @param array $sin
     * 
     * @return string
     */
    public function extractStartingLetterOfBirthname(string $sin) : string {
        return $this->disassambleSIN($sin)["startingLetterOfBirthname"];
    }

    /** 
     * Validation of birthday part of sin
     * 
     * @param string $sin Given social insurance number
     * 
     * @return string
     */
    public function validateBirthday($sin) : string {
        // filter birthday from SIN
        $sinBirthDay = $this->disassambleSIN($sin);
        $sinBirthDay = $sinBirthDay["birthday"];

        // generate array for comparison (DD/MM/YY)
        $sinBirthDay = str_split($sinBirthDay, 2);

        $dateValidator = new DateTime();
        $day           = $sinBirthDay[0];
        $month         = $sinBirthDay[1];
        $year          = $sinBirthDay[2];

        $dateValidator->setDate($year, $month, $day);
        $sinBirthDay   = $dateValidator->format('d-m-y');

        return $sinBirthDay;
    }

    /**
     * Validation of gender code of sin
     * 
     * @param string $sin
     * 
     * @return int
     */
    public function validateGenderCode(string $sin) : int {
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
};

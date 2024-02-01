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
     * BASE 10 for checksum validation
     * @var int $_BASE_10
     */
    private int $_BASE_10       = 10;

    /**
     * Object variable for testing SIN 
     * @var string $_TEST_SIN
     */
    private string $_TEST_SIN   = "03 160894 W 098";

    /**
     * Given weighting for checksum validation.
     * @var array $_WEIGHTING
     */
    private array $_WEIGHTING   = [2, 1, 2, 5, 7, 1, 2, 1, 2, 1, 2, 1];

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
     * Constructor
     */
    public function __construct(string $sin) {
        $this->_TEST_SIN = $sin;
    }

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
        $startingLetterOfBirthname = substr($sin, 8, 1);

        // two digits for defining gender at position 9
        $genderSerialNumber        = substr($sin, 9, 2);

        // checksum at position 11
        $checksum                  = substr($sin, 11, 1);

        array_push($disassambledSIN, [
            "areaCode"                  => $areaCode,
            "birthday"                  => $birthDay,
            "startingLetterOfBirthname" => $startingLetterOfBirthname,
            "genderSerialNumber"        => $genderSerialNumber,
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
     * Helper to extract first letter of birthname from SIN.
     * 
     * @param array $sin
     * 
     * @return string
     */
    public function extractStartingLetterOfBirthname(string $sin) : string {
        return $this->disassambleSIN($sin)["startingLetterOfBirthname"];
    }

    /**
     * Define and return all letters of German alphabet.
     * 
     * @return string
     */
    public function getGermanAlphabet() : string {
        return 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }

    /**
     * Checks if letter in sin is in German alphabet.
     * 
     * @param string $sin
     * 
     * @return bool
     */
    public function isLetterValid(string $sin) : bool {
        $alphabet                  = $this->getGermanAlphabet();
        $startingLetterOfBirthname = $this->extractStartingLetterOfBirthname($sin);

        return str_contains($alphabet, $startingLetterOfBirthname);
    }

    /** 
     * Validation of birthday part of sin
     * 
     * @param string $sin Given social insurance number
     * 
     * @return string
     */
    public function validateBirthday(string $sin) : string {
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
        $sinBirthDay   = date_format($dateValidator, 'm-d-y');

        return $sinBirthDay;
    }

    /**
     * Validation of gender code of sin
     * 
     * @param string $sin Given social insurance number
     * 
     * @return string|false
     */
    public function validateGenderCode(string $sin) : string|false {
        // filter gender serial number from SIN
        $sin       = $this->disassambleSIN($sin);
        $sinGender = $sin["genderSerialNumber"];
        $sinGender = intval($sinGender);

        if ($sinGender >= 0 && $sinGender <= 99) {
            return $sinGender < 10 ? '0' . $sinGender : $sinGender;
        }

        return false;
    }

    /**
     * Validate checksum of SIN
     * 
     * Steps:
     * 1. Get position of letter in German alphabet
     * 2. Weighting with 2, 1, 2, 5, 7, 1, 2, 1, 2, 1, 2 und 1
     * 3. Replace sin letter with corresponding letter position in German alphabet
     * 4. Get products of corresponding pairs
     * 5. Get sum of digits (Quersumme)
     * 6. Checksum = rest by using modulo 10
     * 
     * @param string $sin
     * 
     * @return array
     */
    public function checkSum(string $sin) : array {
        // 1. Get position of letter in German alphabet
        $sinLetter    = $this->disassambleSIN($sin)['startingLetterOfBirthname'];
        $alphabet     = $this->getGermanAlphabet();
        $letterPos    = strpos($alphabet, $sinLetter);

        // 2. Weighting with given weighting array
        // trim sin
        $sin          = preg_replace('/\s+/', '', $sin);

        // 3. Replace sin letter with corresponding letter position in German alphabet
        $convertedSin = str_replace($sinLetter, $letterPos, $sin);

        // put weighting on sin
        $weighting    = $this->_WEIGHTING;

        // convert convertedSin to array for comparison
        $convertedSin = str_split($convertedSin, 1);

        // first multiply each indexes of both arrays with each other
        // if the length of the two arrays are not the same
        // 1. unify length for comparison
        $length       = 0;

        if (count($convertedSin) <= count($weighting)) {
            $length = count($convertedSin);
        } else {
            $length = count($weighting);
        }

        $multipliedDigits = [];

        // 2. multiply the items together
        for ($i = 0; $i < $length; $i++) {
            array_push($multipliedDigits, $convertedSin[$i] * $weighting[$i]);
        }

        return $multipliedDigits;
    }

    /**
     * Helper for checksum generation
     * Build cross sum
     * 
     * @param array $numbersArray Digits that have to be cross summed
     * 
     * @return int
     */
    public function calculateCrossSum(array $numbersArray) : int {
        $crossSum     = 0;
        $digitsString = implode($numbersArray);

        for ($i = 0; $i < strlen($digitsString); $i++) {
            $digitsArray[] = substr($digitsString, $i, 1);
        }

        foreach ($digitsArray as $digit) {
            $crossSum += intval($digit);
        }

        return $crossSum;
    }

    /**
     * Function to get the rest of cross sum calculation.
     * 
     * @param int $number Given cross sum
     * @param int $base   Base for rest calculation
     * 
     * @return int
     */
    public function calculateChecksum(int $number, int $base) : int {
        return $number % $base;
    }

    /**
     * Main function for testing all validation functions
     * 
     * Returns:
     * 
     * - string - in case of SIN validation was successful
     * - array  - in case of SIN validation end with errors, return error array
     * 
     * @param string $sin Given social insurance number
     * 
     * @return string|array
     */
    function validateSocialInsuranceNumber(string $sin) : string|array {
        // ### TESTING EVERY STEP ###
        $length                    = $this->validateLength($sin);
        $area                      = $this->validateArea($sin);
        $birthDay                  = $this->validateBirthday($sin);
        $startingLetterOfBirthname = $this->extractStartingLetterOfBirthname($sin);
        $isLetterValid             = $this->isLetterValid($startingLetterOfBirthname);
        $genderSerialNumber        = $this->validateGenderCode($sin);
        $checksum                  = $this->calculateChecksum($this->calculateCrossSum($this->checkSum($sin)), $this->_BASE_10);
        $errors                    = [];

        if ($length !== true) {
            array_push($errors, "invalid length");
        } else if ($area !== true) {
            array_push($errors, "invalid area code");
        } else if ($birthDay == false) {
            array_push($errors, "invalid birth day");
        } else if ($isLetterValid !== true) {
            array_push($errors, "invalid first letter of surname");
        } else if ($genderSerialNumber == false) {
            array_push($errors, "invalid gender serial number");
        } else if (!$checksum) {
            array_push($errors, "invalid checksum");
        }

        if (!empty($errors)) {
            return $errors;
        }

        return $sin;
    }
};

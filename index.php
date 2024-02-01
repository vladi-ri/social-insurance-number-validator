<?php
    include("SINValidator.php");

    $validator = new SINValidator("04 260887 M 08 0");
    $sin       = $validator->getSIN();
    
    // ### TESTING EVERY STEP ###
    print_r("1. disassembled sin: " . json_encode($validator->disassambleSIN($sin)));
    echo "<br />";
    print_r("2. valid length: " . $validator->validateLength($sin));
    echo "<br />";
    print_r("3. valid area: " . json_encode($validator->validateArea($sin)));
    echo "<br />";
    print_r("4. birthday: " . $validator->validateBirthday($sin));
    echo "<br />";
    print_r("5. first letter of birthname: " . $validator->extractStartingLetterOfBirthname($sin));
    echo "<br />";
    print_r("6. is letter valid: " . $validator->isLetterValid($sin));
    echo "<br />";
    print_r("7. gender code: " . $validator->validateGenderCode($sin));
    echo "<br />";
    echo "8. Checksum validation: ";
    echo "<br />";
    print_r("8.1. converted SIN: " . json_encode($validator->checkSum($sin)));
    echo "<br />";
    print_r("8.2. cross sum of digits: " . $validator->calculateCrossSum($validator->checkSum($sin)));
    echo "<br />";
    print_r("8.3. calculate checksum: " . $validator->calculateChecksum($validator->calculateCrossSum($validator->checkSum($sin)), 10));

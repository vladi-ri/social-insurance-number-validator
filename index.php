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
    // TODO: 8. checksum
    print_r("8. checksum: " . "TODO!";
    echo "<br />";

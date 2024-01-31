<?php
    include("SINValidator.php");
    $validator = new SINValidator();
    $sin = $validator->getSIN();
    
    // echo $sin;
    // echo "<br />";
    // echo "valid length: " . $validator->validateLength($sin);
        // TODO:
        // echo "<br />";
        // echo "valid area: " . $validator->validateArea($sin);
    // echo "<br />";
    // print_r("disassembled sin: " . json_encode($validator->disassambleSIN($sin)));
    
    // print_r("first letter of surname: " . $validator->extractStartingLetterOfBirthname($validator->disassambleSIN($sin)[0]));
    
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

    // TODO:
    // 6. serial number (gender code)
    // 7. checksum

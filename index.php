<?php
    include("SINValidator.php");
    $validator = new SINValidator();
    $sin = $validator->getSIN();
    
    echo $sin;
    echo "<br />";
    echo "valid length: " . $validator->validateLength($sin);
    // TODO:
    // echo "<br />";
    // echo "valid area: " . $validator->validateArea($sin);
    echo "<br />";
    print_r("disassembled sin: " . json_encode($validator->disassambleSIN($sin)));
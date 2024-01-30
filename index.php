<?php
    include("SINValidator.php");
    $validator = new SINValidator();
    $sin = $validator->getSIN();
    
    echo $sin;
    echo "<br />";
    echo "valid length: " . $validator->validateLength($sin);
    echo "<br />";
    echo "valid area: " . $validator->validateArea($sin);
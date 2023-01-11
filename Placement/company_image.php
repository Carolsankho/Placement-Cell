<?php

if(isset($_GET['name'])&&isset($_GET['branch'])&&isset($_GET['salary'])&&isset($_GET['date'])) {
    //Set the Content Type
    header('Content-type: image/jpeg');

    // Create Image From Existing File
    $jpg_image = imagecreatefromjpeg("PA.jpg");

    // Allocate A Color For The Text
    $color = imagecolorallocate($jpg_image, 0, 0, 0);

    // Set Path to Font File
    $font_path = 'Adobe Caslon Pro Bold.ttf';

    // Set Text to Be Printed On Image
    $company = strtoupper($_GET['name']);
    $branch = strtoupper($_GET['branch']);
    $salary = strtoupper($_GET['salary']);
    $date = strtoupper($_GET['date']);

    // Print Text On Image
       $result_img = imagettftext($jpg_image, 25, 0, 11, 70, $color, $font_path, "COMPANY : $company");
       $result_img = imagettftext($jpg_image, 20, 0, 11, 150, $color, $font_path, "BRANCH : $branch");
       $result_img = imagettftext($jpg_image, 20, 0, 11, 200, $color, $font_path, "SALARY : $salary");
       $result_img = imagettftext($jpg_image, 20, 0, 11, 250, $color, $font_path, "DATE : $date");
    //    $result_img = imagettftext($jpg_image, 60, 0, 528 - (7*(strlen($text)/2)), 500, $color, $font_path, $text);

    // Send Image to Browser
    imagejpeg($jpg_image);
    // Clear Memory
    imagedestroy($jpg_image);
    return 0;

}

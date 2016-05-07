<?php

/*
 * Coded By Dilan
 * 
 * Modified by fmf kalana.
 * @ fixed some security issues.
 * 
 */

function cloneContentImages($html, $saveDir = NULL, $imageId = NULL) {

    $allow_types = array(
        "png", "jpg", "jpeg"
    );


    //$html = 'hii ist/images/main/genius_logo.PNG" />';



    $htmlEdited = trim($html);

    if (!empty($htmlEdited)) {

        $srcPull = array(); // store all the src values of pasted content
        $doc = new DOMDocument(); // create object to tmp
        $doc->loadHTML($html);


        //;
        $xml = simplexml_import_dom($doc); // just to make xpath more simple
        $images = $xml->xpath('//img');

        foreach ($images as $img) {
            $src = $img['src'];
            //echo $src . '<br>';

            array_push($srcPull, $src);
        }


        for ($i = 0; $i < sizeof($srcPull); $i++) {
            //echo $srcPull[$i] . "<br>";
            $imageContent = file_get_contents($srcPull[$i]);


            // check is reall image
            $imageInfo = getimagesizefromstring($imageContent);
            if ($imageInfo !== false) {

                // echo "this is image";
                
                $IMAGE_NAME = $imageId.$i . ".jpg"; 
                $SAVE_PATH = $saveDir.$IMAGE_NAME;
                
                $IMAGE_URL = "/product_image_lib/automated/".$IMAGE_NAME;

                file_put_contents($SAVE_PATH, $imageContent);
                $htmlEdited = str_replace($srcPull[$i], $IMAGE_URL , $htmlEdited);
                
            }
        }



        return $htmlEdited;
    } else {

        return $htmlEdited;
    }
}

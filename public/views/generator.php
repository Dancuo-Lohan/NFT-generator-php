<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<form method="POST" action="#">
    <label for="number"><?php t("How many NFT's would you create ?"); ?></label>
    <input name="number" type="number" min="1" max="66" value="1">
    <button><?php t("Generate"); ?></button>
</form>

<?php
function randRGB($rangeMin, $rangeMax, $limit) {
    $r = rand($rangeMin,$rangeMax);
    $g = rand($rangeMin,$rangeMax);
    $b = rand($rangeMin,$rangeMax);
    while(($r + $g + $b) > $limit){
        $r = rand($rangeMin,$rangeMax);
        $g = rand($rangeMin,$rangeMax);
        $b = rand($rangeMin,$rangeMax);
    }
    $idRGB="$r.$g.$b";
    return array($r,$g,$b, $idRGB);
}

//Create NFT's
if(isset($_POST['number']) && !empty($_POST['number'])) {
    for($i = $_POST['number']; $i>=1; $i--){ 
        $id = "";
        $x = 120;
        $y = 120;
        $final_img = imagecreatetruecolor($x, $y); // where x and y are the dimensions of the final image
        $imagePath = 'assets/images-cards';
        $sky = 1;
        $i4 = imagecreatefrompng("$imagePath/bg-sky/bw$sky.png"); //Sky
        $cloud = rand(0,1);
        if ($cloud == 1) {
            $i9 = imagecreatefrompng("$imagePath/cloud/1.png");
        }
        $id.=$cloud."_";

        $sol1 = 1; //ground 1
        $sol2 = 2; //ground 2
        $i1 = imagecreatefrompng("$imagePath/solbw$sol1.png"); //Ground 1
        $i2 = imagecreatefrompng("$imagePath/solbw$sol2.png"); //Ground 2
        $idBgGroud = rand(1,2);
        $shoes = rand(1,2);
        $legs = rand(1,2);
        $shirt = rand(1,2);
        $head = rand(1,2);
        $i3 = imagecreatefrompng("$imagePath/bg-ground/bw$idBgGroud.png"); //Background Ground
        $i5 = imagecreatefrompng("$imagePath/character/shoes/$shoes.png"); //Shoes
        $i6 = imagecreatefrompng("$imagePath/character/legs/$legs.png"); //legs
        $i7 = imagecreatefrompng("$imagePath/character/shirt/$shirt.png"); //shirt
        $i8 = imagecreatefrompng("$imagePath/character/head/$head.png"); //head
        if ($cloud == 1) { //Random colorize the clouds
            list($r,$g,$b, $idRGB) = randRGB(0, 30, 100);
            $id.="$idRGB-";
            imagefilter($i9, IMG_FILTER_COLORIZE, $r, $g, $b, 0);
        }

        list($r,$g,$b, $idRGB) = randRGB(50, 200, 380);
        $id.=$sky."_";
        $id.="$idRGB-";
        imagefilter($i4, IMG_FILTER_COLORIZE, $r, $g, $b, 10);

        list($r,$g,$b, $idRGB) = randRGB(30, 130, 400);
        $id.=$sol1."_";
        $id.="$idRGB-";
        imagefilter($i1, IMG_FILTER_COLORIZE, $r, $g, $b, 0);

        list($r,$g,$b, $idRGB) = randRGB(50, 200, 360);
        imagefilter($i2, IMG_FILTER_COLORIZE, $r, $g, $b, 20);
        imagefilter($i3, IMG_FILTER_COLORIZE, $r, $g, $b, 20);
        $id.=$sol2."+".$idBgGroud."_";
        $id.="$idRGB-";
        imagecopy($final_img, $i4, 0, 0, 0, 0, $x, $y);

        list($r,$g,$b, $idRGB) = randRGB(10, 150, 180);
        $id.=$shoes."_";
        $id.="$idRGB-";
        imagefilter($i5, IMG_FILTER_COLORIZE, $r, $g, $b, 10);

        list($r,$g,$b, $idRGB) = randRGB(10, 150, 180);
        $id.=$legs."_";
        $id.="$idRGB-";
        imagefilter($i6, IMG_FILTER_COLORIZE, $r, $g, $b, 10);

        list($r,$g,$b, $idRGB) = randRGB(10, 150, 180);
        $id.=$shirt."_";
        $id.="$idRGB-";
        imagefilter($i7, IMG_FILTER_COLORIZE, $r, $g, $b, 10);

        list($r,$g,$b, $idRGB) = randRGB(10, 150, 180);
        $id.=$head."_";
        $id.="$idRGB";
        imagefilter($i8, IMG_FILTER_COLORIZE, $r, $g, $b, 10);

        imagecopy($final_img, $i1, 0, 0, 0, 0, $x, $y);

        if ($cloud == 1) {
            imagecopy($final_img, $i9, 0, 0, 0, 0, $x, $y);
        }

        imagecopy($final_img, $i2, 0, 0, 0, 0, $x, $y);
        imagecopy($final_img, $i3, 0, 0, 0, 0, $x, $y);
        imagecopy($final_img, $i5, 0, 0, 0, 0, $x, $y);
        imagecopy($final_img, $i6, 0, 0, 0, 0, $x, $y);
        imagecopy($final_img, $i7, 0, 0, 0, 0, $x, $y);
        imagecopy($final_img, $i8, 0, 0, 0, 0, $x, $y);

        imagealphablending($final_img, false);
        imagesavealpha($final_img, true);
        imagepng($final_img, './temp/final_img'.$i.'.png');


        //print image
        echo "<img style='margin-right:10px' src='./temp/final_img$i.png'>";
        

        //destroy images after use
        imagedestroy($i1);
        imagedestroy($i2);
        imagedestroy($i3);
        imagedestroy($i4);
        imagedestroy($i5);
        imagedestroy($i6);
        imagedestroy($i7);
        imagedestroy($i8);
        imagedestroy($final_img);
    }
}
?>
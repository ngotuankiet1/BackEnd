<?php

#bài tập 1: tính tổng các số chẵn từ 1 đến n (n>=2)
//$n = 10;
//$t=0;
#c1
//if ($n >= 2) {
//    for ($i = 0; $i <= $n; $i++){
//        if($i%2==0){
//         $t += $i;   
//        }
//    }
//}
#c2
//$n = 10;
//$t = 0;
//for ($i = 2; $i <= $n; $i += 2) {
//    $t += $i;
//}
//echo "$t";
//============================
//============================
//Bài tập 2: tính tổng nghịch đảo sô chia hết cho 3 từ 3 đến n(n>=3)
//T2 = 1/3+1/6+...+1/n
#c1
//$T2 = 0;
//$n = 10;
//if ($n >= 3) {
//    for ($i = 3; $i <= $n; $i++) {
//        if ($i % 3 == 0) {
//            $T2 += 1/$i;  
//        }
//    }
//}
// echo "$T2";
# c2
//$T2 = 0;
//$n = 6;
//    for ($i = 3; $i <= $n; $i+=3) {
//            $T2 += 1/$i;  
//    }
// echo "$T2";
//============================
//============================
//Bài tập 3: Tính tổng chuỗi
//T3 = 1/2+2/3+3/4+...+n/n+1(n >= 1)
#c1
////$T3 = 0;
//$n = 3;
//if ($n >= 1) {
//    while ($n <= 3) {
//        $T3 += $n / ($n + 1);
//        $n++;
//    }
//}
//echo "$T3";
#c2
//if ($n >= 1) {
//    for ($i = 1; $i <= $n; $i++) {
//        $T3 += $i / ($i + 1);
//    }
//}
//echo "$T3";
//============================
//============================
#bài tập 4 : giải phương trình bậc 2
$a = 3;
$b = 1;
$c = -2;
if ($a != 0) {
    $delta = $b * $b - (4 * $a * $c);
    if ($delta < 0) {
        echo "phương trình vô nghiệm";
    } elseif ($delta == 0) {
        $x = (-$b) / (2 * $a);
        echo "phương trình có nghiệm kép x = {$x}";
    } else {
        $x1 = ((-$b) + sqrt($delta)) / 2 * $a;
        $x2 = ((-$b) - sqrt($delta)) / 2 * $a;
        echo "phương trình có 2 nghiệm x1= {$x1} , x2= {$x2} ";
    }
} else {
    echo "đây không phải là phương trình bậc 2";
}

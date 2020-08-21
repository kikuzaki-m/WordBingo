<?php
/** 初期化 **/
$S = 0; #カードサイズ(S*S)
$N = 0; #選ぶ単語数
$A = []; #カードの単語
$w = []; #選ばれた単語


/** 関数 **/
//ビンゴカードに選ばれた単語があるかチェック
function WordCheck(){
    global $S, $N, $A, $w;
    for($n=0; $n<$N; $n++){

        for($i=0; $i<$S; $i++){
            for($j = 0; $j<$S; $j++){ 

                //選ばれた単語がある場合印をつける(@代入)
                if($A[$i][$j] == $w[$n]){
                    $A[$i][$j] = "@";
                }
            }
        }
    }
}

//縦・横・ななめの一列に印がついているかチェック
function BingoCheck(){
    global $S, $N, $A, $w;
    //var_dump($A); #印がついているか確認
    //縦
    for($j=0; $j<$S; $j++){
        $a = [];
        $line = [];
        for($i = 0; $i<$S; $i++){ 
            $a[] = $A[$i][$j];
        }

        $line = array_count_values($a);
        if($line["@"] == $S){
            return 1;
        }
    }

    //横
    for($i=0; $i<$S; $i++){
        $a = [];
        $line = [];
        for($j = 0; $j<$S; $j++){ 
            $a[] = $A[$i][$j];
        }
        
        $line = array_count_values($a);
        if($line["@"] == $S){
            return 1;
        }
    }

    //ななめ(左上)
    $a = [];
    $line = [];
    for($i=0; $i<$S; $i++){
        $a[] = $A[$i][$i];
    }
    $line = array_count_values($a);

    if($line["@"] == $S){
        return 1;
    }

    //ななめ(右上)
    $a = [];
    $line = [];
    for($i=0; $i<$S; $i++){
        $max = $S-1;
        $a[] = $A[$i][$max-$i];
    }
    $line = array_count_values($a);

    if($line["@"] == $S){
        return 1;
    }
}


/** 処理 **/
//ビンゴカード情報取得
$S = trim(fgets(STDIN));  
for($i=0; $i<$S; $i++){
    $A[] = explode(" ",trim(fgets(STDIN)));
}

//選ばれた単語情報取得
$N = trim(fgets(STDIN));  
for($i=0; $i<$N; $i++){
    $w[] = trim(fgets(STDIN));
}

//単語チェック
WordCheck();

//ビンゴ判定
if(BingoCheck()){
    print("yes");
} else {
    print("no");
}

?>
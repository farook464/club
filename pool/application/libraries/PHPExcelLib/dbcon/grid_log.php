<?php 
function SaveGridLog($preArray,$postArray,$uid){
    try {
        $dbhSL = testdb_connect();
        
        $desc='';
        
        if(sizeof($preArray)==sizeof($postArray)){
            $cnt = sizeof($preArray);
            
            for($x=0;$x<$cnt;$x++){
                if($preArray[$x]!==$postArray[$x]){
                    $desc = $desc.'['.$preArray[$x].' => '.$postArray[$x].']';
                }
            }
        }
        
        if($desc===''){
            $desc = 'Nothing is updated!';
        }

        $sthSL = $dbhSL->prepare("CALL SaveGridLog(?,?,?)");
        $sthSL->bindValue(1, $_SESSION["name"]);
        $sthSL->bindValue(2, $desc);
        $sthSL->bindValue(3, $uid);

        if ($sthSL->execute()) {
            
        }
    }
    catch(Exception $eSL){

    }
}
?>

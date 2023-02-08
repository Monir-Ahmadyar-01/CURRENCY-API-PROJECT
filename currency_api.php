<?php
    require_once("database.php");
    header("Content-Type:application/json");
       $sql_query_01 = mysqli_query($connection,"select * from currency_tbl");
        $arr_1 = array();
        $count = 1;
        $length = mysqli_num_rows($sql_query_01);
       while($fetch_arr = mysqli_fetch_assoc($sql_query_01)){
            $tmp_arr = ['name' => $fetch_arr["name"],'cash_buy' => $fetch_arr["cash_buy"],'cash_sell' => $fetch_arr["cash_sell"],'transfer_buy' => $fetch_arr["transfer_buy"],'transfer_sell' => $fetch_arr["transfer_sell"]];
            $arr_1[0] = $length;
            $arr_1[$count] = $tmp_arr;
            $count++;
       }
    //    print_r($arr_1);
      
    //    $arr_1 = ['USD' =>['kharid'=>"1",'frosh'=>"20"],'AFN' =>['kharid'=>"65",'frosh'=>"75"],'EUR' => ['kharid'=>"78",'frosh'=>"95"]];
        // header("Content-type:application/json"); 
        echo json_encode($arr_1,JSON_FORCE_OBJECT);
    
?>
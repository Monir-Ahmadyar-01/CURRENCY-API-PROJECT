
<?php 
    require_once("database.php");
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sarafi Exchange</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    @media only screen and (max-width: 800px) {
    
    /* Force table to not be like tables anymore */
	#no-more-tables table, 
	#no-more-tables thead, 
	#no-more-tables tbody, 
	#no-more-tables th, 
	#no-more-tables td, 
	#no-more-tables tr { 
		display: block; 
	}
 
	/* Hide table headers (but not display: none;, for accessibility) */
	#no-more-tables thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
 
	#no-more-tables tr { border: 1px solid #ccc; }
 
	#no-more-tables td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
		white-space: normal;
		text-align:left;
	}
 
	#no-more-tables td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		text-align:left;
		font-weight: bold;
	}
 
	/*
	Label the data
	*/
	#no-more-tables td:before { content: attr(data-title); }
}
</style>
</head>
<?php
                            if(isset($_POST["btn_submit"])){
                                $name = $_POST["name"];
                                $cash_buy = $_POST["cash_buy"];
                                $cash_sell = $_POST["cash_sell"];
                                $transfer_buy = $_POST["transfer_buy"];
                                $transfer_sell = $_POST["transfer_sell"];

                                $sql_query_03 = mysqli_query($connection,"select id from currency_tbl where name='$name'");
                                if(mysqli_num_rows($sql_query_03) > 0){
                                    $sql_query_04 = mysqli_query($connection,"update currency_tbl set cash_buy ='$cash_buy',cash_sell = '$cash_sell',transfer_buy = '$transfer_buy',transfer_sell = '$transfer_sell' where name='$name'");
                                    if($sql_query_04){
                                        echo "<script>alert('اطلاعات موفقانه آپدیت شد');</script>";
                                    }
                                }
                                else{
                                    $sql_query_01 = mysqli_query($connection,"INSERT INTO `currency_tbl` (`id`, `name`, `cash_buy`, `cash_sell`, `transfer_buy`, `transfer_sell`)
                                     VALUES (NULL, '$name', '$cash_buy', '$cash_sell', '$transfer_buy', '$transfer_sell')");
    
                                     if($sql_query_01){
                                         echo "<script>alert('اطلاعات موفقانه ذخیره شد');</script>";
                                     }
                                }

                                
                            }
                        
                        ?>
<body>
    <div class="continar" style="direction:rtl; text-align:center;">
        <div class="row">
            <div class="col-md-10 mx-auto table-responsive">
                
            <br>
             <div class="col-md-10 mx-auto table-responsive">
                
                <table class="table table-bordered  table-striped mt-5" >
                    <thead>
                        <tr>
                            <th colspan="6" style="text-align:center;"> واحد های پولی</th>
                        </tr>
                        <tr class="bg bg-primary text text-white ">
                            <th>شماره</td>
                            <th>نام واحد پولی</th>
                            <th>خرید پول نقد</th>
                            <th>فروش پول نقد </th>
                            <th>انتقال (خرید)</th>
                            <th>انتقال (فروش)</th>
                        </tr>
                    </thead>

                    <tbody>
                       <!-- currency api -->

        <?php 
            // Fetching JSON
        $req_url = 'http://localhost/currency_api/currency_api.php';
        $response_json = file_get_contents($req_url);


        // Continuing if we got a result
        if(false !== $response_json) {
            
            // Try/catch for json_decode operation
            try {
                
                $response = json_decode($response_json,JSON_FORCE_OBJECT);
                // Decoding
                //  echo $response[1]['name'];
                $length = $response[0];

                // Check for success
                
            ?>
            
                       <?php 
                        //   $sql_query_05 = mysqli_query($connection,"select * from currency_tbl");
                          $count = 1;
                          while($count <= $length){
                       ?>
                            <tr>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $response[$count]['name']; ?></td>
                                <td><?php echo $response[$count]['cash_buy']; ?></td>
                                <td><?php echo $response[$count]['cash_sell']; ?></td>
                                <td><?php echo $response[$count]['transfer_buy']; ?></td>
                                <td><?php echo $response[$count]['transfer_sell']; ?></td>
                                
                            
                            </tr>
                       <?php
                       $count++;
                       }
                    
                       }
            catch(Exception $e) {
                // Handle JSON parse error...
            }

        }

        ?>

                             

                        
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>
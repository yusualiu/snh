<?php
session_start();
    if (isset($_GET['txref'])) {
        $ref = $_GET['txref'];
        $amount = $_SESSION['amount']; //Correct Amount from Server
        $email  = $_SESSION['email']; //Correct Amount from Server
        $patientName = $_SESSION['name'];
        $currency = "NGN"; //Correct Currency from Server

        $query = array(
            "SECKEY" => "yourkey here",
            "txref" => $ref
        );

        $data_string = json_encode($query);
                
        $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

        $response = curl_exec($ch);

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($response, 0, $header_size);
        $body = substr($response, $header_size);

        curl_close($ch);

        $resp = json_decode($response, true);

        $paymentStatus = $resp['data']['status'];
        $chargeResponsecode = $resp['data']['chargecode'];
        $chargeAmount = $resp['data']['amount'];
        $chargeCurrency = $resp['data']['currency'];
        $transactionDate = $resp['data']['createddayname'].' '.$resp['data']['createdmonthname'].', '.$resp['data']['createdyear'];

        if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency) && $resp['data']['custemail'] == $email && ($resp['data']['paymenttype']== 'card' || $resp['data']['paymenttype']== 'account') && $paymentStatus == 'successful' ) {
            // transaction was successful...
            $transaction =$resp['data']; 
           
          
          // filter through transaction folder
            $allTransactions = scandir("db/transactions/");
            $countTransactions = count($allTransactions);
            $transactionsno = $countTransactions-1;

            // saving the data into the database(folder)
            $transObject = [
                'transactionsno' => $transactionsno,
                'transactionid' => $transaction['txid'],                
                'transactionref' => $transaction['txref'],                
                'paymentstatus' =>$paymentStatus,
                'custname' => $patientName,
                'custemail' => $email,
                'chargeamount' => $chargeAmount,
                'chargecurrency' => $chargeCurrency,
                'transactiondate' => $transactionDate,
                'paymenttype' => $transaction['paymenttype'],   
                'paymentid' => $transaction['paymentid'],      

            ];     

             // ****Look into the folder and check if you already gave value for this ref
             // if the email matches the customer making transaction etc

                for ($counter=0; $counter < $countTransactions; $counter++) {
                    $currentTransaction = $allTransactions[$counter];              
                    if($currentTransaction == $email.".json"){
                    
                            //open or read json data
                        $transactions = file_get_contents('db/transactions/'.$email.'.json');
                        $data = json_decode($transactions, true);
                        unset($transactions);//prevent memory leaks for large json.
                        $data[] = $transObject;
                        //convert file to json and save the file         
                        file_put_contents('db/transactions/'.$email.'.json',json_encode($data));
                        unset($data);//release memory
                        $_SESSION['message'] = 'Transaction Successfull, Thank you for your patronage';   
                        header('Location:success.php?txid='.$transaction['txid'].'&amount='.$chargeAmount);
                        exit();

                    
                    }
                }
             
          // saving the data into the database(folder)
          
            $data[] = $transObject;
            file_put_contents('db/transactions/'.$email.'.json',json_encode($data));
            //Give Value and return to Success page
            $_SESSION['message'] = 'Transaction Successfull, Thank you for your patronage';   
                
            header('Location:success.php?txid='.$transaction['txid'].'&amount='.$chargeAmount);        
          
        } else {
            //Dont Give Value and return to Failure page
            $_SESSION['error'] = 'Transaction Not Successfull,Something Went Wrong Please try again';
            header('Location:patient.php');
        }
    }
        else {
      die('No reference supplied');
    }
?>

<?php
    include 'includes/session.php';
    include 'services/insert_expense.php';
    
    if(isset($_POST['add'])){
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $account_id = $_POST['account_id'];

        // Get the last transaction made with the same account_id
        $lastTransactionSql = "SELECT * FROM transactions WHERE account_id = '$account_id' ORDER BY id DESC LIMIT 1";
        $lastTransactionResult = $conn->query($lastTransactionSql);

        if ($lastTransactionResult->num_rows > 0) {
            $lastTransaction = $lastTransactionResult->fetch_assoc();
            $current_balance = $lastTransaction['balance'];
            $new_balance = $current_balance + $amount;
            // Insert the transaction
        $sql = "INSERT INTO transactions (details, account_id, amount, transaction_type, balance, foreign_id) 
        VALUES ('$description','$account_id', '$amount', 'manually_added', '$new_balance', 0)";
        // Execute the query
        if ($conn->query($sql)) {
            $_SESSION['error'] = 'تم اضافة الرصيد';
        } else {
            $_SESSION['error'] = $conn->insert_id;
            return array("success" => false, "error" => $conn->error);
        }
        } else {
            $_SESSION['error'] = 'Cant find last transcation hence cant find balance.';
            
        }
        
    }
    else{
        $_SESSION['error'] = 'يرجى تعبئة الخانات المطلوبة';
    }
    header('location: account.php');
?>

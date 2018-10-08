<?php
include 'header.php';
$flightid = $_GET['flightid'];
$quantity = $_GET['quantity'];
$class = $_GET['class'];
$amount = $_GET['fare'] * $quantity;

echo $user['id'] . $flightid . $amount . $class . $quantity;

$prep_stmt = "INSERT INTO bookings (id, userid, flightid, amount, class, quantity) VALUES (NULL, ?, ?, ?, ?, ?)";
        if ($insert_stmt = $mysqli->prepare($prep_stmt)) {
            $insert_stmt->bind_param('iiisi', $user['id'], $flightid, $amount, $class, $quantity);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                //header('Location: ../error.php?err=Registration failure: INSERT');
                echo 'SQL Error, could not book ticket';
            }
            else {	
                //header('Location: book.php');
            }
}
        

$balance = $user['balance'] - $amount;

$mysqli->query(sprintf('UPDATE users SET balance = %d where id = %d', $balance, $user['id']));

//header('Location: history.php');    

?>

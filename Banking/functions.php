<?php
$conn = mysqli_connect("localhost","root","Poorva@123", "banking");
function get_customer(){
    global $conn;
$get_customer="SELECT * FROM customer";
$run_customer=mysqli_query($conn, $get_customer);
While($row_customer=mysqli_fetch_array($run_customer)){
            $customer_id=$row_customer['id'];
            $customer_name = $row_customer['name'];
            $customer_email = $row_customer['email'];
            $customer_Balance = $row_customer['CurrentBalance'];
            echo
      "<tr>
            <td>$customer_id</td>
            <td><a href='details.php?customer_id=$customer_id'>$customer_name</a></td>
            <td>$customer_email </td>
            <td>$customer_Balance </td>
            </tr>
    ";
        }
    }
    ?>
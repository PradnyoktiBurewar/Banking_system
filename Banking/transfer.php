<!doctype html>
<html lang="en">

<?php
    include("functions.php");
?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Ubuntu:wght@400;500;700&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
   
  <title>PUNB - Transfer Money</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <a class="navbar-brand" href="punb.php">PUN<i class="fa fa-university" aria-hidden="true"></i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item ">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About </a>
        </li>
        <li class="nav-item active">
                    <a class="nav-link" href="customers.php"> View Customers </a>
                </li>
    
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>


<div class="container">
          <?php
               if(isset($_GET['customer_id'])) {
                  $c_id = $_GET['customer_id'];
                  $get_customer = "select * from customer where id='$c_id'";
                  $run_customer = mysqli_query($conn, $get_customer);
                  $row_customer = mysqli_fetch_array($run_customer);
                  $customer_id = $row_customer['id'];
                  $customer_name = $row_customer['name'];
                  $current_balance = $row_customer['CurrentBalance'];
                
                  echo"
                      <form action='transfer.php?customer_id=$c_id' method='post' enctype='multipart/form-data'>
                      <label for='from' style='font-size: 20px;'>Transferring from</label>
                          <div class='form-row'>
                              <div class='col-lg-4 col-md-8 col-sm-12 mb-3 mx-auto'>
                                  <label for='from_acc'>customer iD</label>
                                  <input type='number' class='form-control' name='from_acc' value='$customer_id' readonly>
                              </div>
                              <div class='col-lg-4 col-md-8 col-sm-12 mb-3 mx-auto'>
                                  <label for='from_acc_name'>customer name</label>
                                  <input type='text' class='form-control' name='from_acc_name' value='$customer_name' readonly>
                              </div>
                              <div class='col-lg-4 col-md-8 col-sm-12 mb-3 mx-auto'>
                                  <label for='curr_bal'>Current Balance</label>
                                  <input type='number' class='form-control' name='curr_bal' value='$current_balance' readonly>
                              </div>
                          </div>
                          <br>
                          <label for='to' style='font-size: 20px;'>Transfer to</label>
                          <div class='form-row'>
                              <div class='col-lg-4 col-md-8 col-sm-12 mb-3 mx-auto'>
                                  <label for='to_acc'>Customer ID</label>
                                  <select class='form-control' name='to_acc' required>
                                      <option value='0'>Select Name on Account</option>
                                ";
                                      $get_customer = "select * from customer";
                                      $run_customer = mysqli_query($conn, $get_customer);
                                      while($row_customer= mysqli_fetch_array($run_customer)) {
                                          $customer_id = $row_customer['id'];
                                          $customer_name = $row_customer['name'];
                                          echo "<option value='$customer_id'>$customer_name</option>";
                                      }
                                      echo"
                                      </select>
                              </div>
                              <div class='col-lg-4 col-md-8 col-sm-12 mb-3 mx-auto'>
                                  <label for='transfer_amt'>Transfer Amount</label>
                                  <input type='number' class='form-control' name='transfer_amt' placeholder='Amount' required>
                              </div>
                          </div>
                          <div class='form-row'>
                              <div class='col-lg-4 col-md-8 col-sm-12 mb-3 mx-auto'>
                                  <label for='transfer_msg'>Message for the reciever</label>
                                  <input type='text' class='form-control' name='transfer_msg' placeholder='Message'>
                              </div>
                          </div>
                          <center>
                              <button type='submit' class='btn btn-primary' name='transfer'>Transfer Now</button>
                          </center>
                      </form>
                      <div class='row'>
                          <div class='col'>
                              <center>
                                  <button class='btn btn-light my-2'>
                                      <a href='customers.php' style='text-decoration: none; color: #000;'>Cancel Transfer</a>
                                  </button>
                              </center>
                          </div>
                      </div>
                  ";
              }
          ?>
      </div>
      </body>

</html>

<?php
    if (isset($_POST['transfer'])) {
        $curr_bal = $_POST['curr_bal'];
        $transfer_date = date('d-m-Y H:i:s a');
        $from_acc = $_POST['from_acc'];
        $from_acc_name = $_POST['from_acc_name'];
        $to_acc = $_POST['to_acc'];
        $transfer_amt = $_POST['transfer_amt'];
        $transfer_msg = $_POST['transfer_msg'];
        
        if($to_acc!= 0){
            $get_customer= "select CurrentBalance from customer where id=$from_acc";
            $run_customer= mysqli_query($conn, $get_customer);
          
            $row_customer=  mysqli_fetch_array($run_customer);
            echo 
            mysqli_error($conn);
            
            if($transfer_amt <= $row_customer ['CurrentBalance']){
                $f_customer = "update customer set CurrentBalance=CurrentBalance-$transfer_amt where id=$from_acc";
                $run_f_customer = mysqli_query($conn, $f_customer);
              

                $t_customer = "select CurrentBalance from customer where id=$to_acc";
                $run_t_customer = mysqli_query($conn, $t_customer);
                $row_t_customer = mysqli_fetch_array($run_t_customer);
                $to_CurrentBalance = $row_t_customer['CurrentBalance'];
                 $t_customer_1 = "update customer set CurrentBalance=$to_CurrentBalance+$transfer_amt where id=$to_acc";
                 $run_t_customer_1=mysqli_query($conn,$t_customer_1);
                 
                 $insert_transfer = "insert into transfers(transfer_date,from_acc, from_acc_name,to_acc,transfer_amt,transfer_msg) values ('$transfer_date', $from_acc, '$from_acc_name', $to_acc, $transfer_amt, '$transfer_msg')";
          
                
                $run_transfer = mysqli_query($conn , $insert_transfer);


           if($run_f_customer && $run_t_customer && $run_t_customer_1 && $run_transfer){ 
                    echo '<script>alert("Transfer complete")</script>';
                  
                
                
                
              
                    echo '<script>window.open("customers.php", "_self")</script>';
                      } else {
                    echo '<script>alert("Unable to transfer")</script>';
                }
            } else {
                echo '<script>alert("Insufficient Balance!!!")</script>';
            }
        } else {
            echo '<script>alert("Please select an account!!!")</script>';
        }
    }
?>

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
   
  <title>PUNB - Customer Details</title>
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
                    <a class="nav-link" href="customers.php">View Customers </a>
                </li>
    
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>

      <div class="container my-4">
        <?php
            if(isset($_GET['customer_id'])) {
                $c_id = $_GET['customer_id'];
                $get_customer = "select * from customer where id='$c_id'";
                $run_customer = mysqli_query($conn, $get_customer);
                while($row_customer = mysqli_fetch_array($run_customer)) {
                    $c_id = $row_customer['id'];
                    $customer_name = $row_customer['name'];
                    $customer_email = $row_customer['email'];
                    $Current_Balance = $row_customer['CurrentBalance'];
                    echo"
   
                        <table class='table table-bordered' style='text-align: center; font-size: 18px;'>
                            <tr>
                                <th scope='col'>c_id</th>
                                <td>$c_id</td>
                            </tr>
                            <tr>
                                <th scope='col'>Customer Name</th>
                                <td>$customer_name</td>
                            </tr>
                            <tr>
                                <th scope='col'>Customer Email</th>
                                <td>$customer_email</td>
                            </tr>
                            <tr>
                                <th scope='col'> Balance</th>
                                <td>$Current_Balance</td>
                            </tr>
                        </table>
                        </div>
                          
                        <div class='row'>
                            <div class='col-12'>
                                <center>
                                    <button class='btn'>
                                        <a href='customers.php' style='text-decoration: none;'>Back to all customers</a>
                                    </button>
                                </center>
                  
                            <div class='col-12 '>
                                <center>
                                    <button class='btn'>
                                        <a href='transfer.php?customer_id=$c_id' style='text-decoration: none;'>Transfer Money</a>
                                    </button>
                                </center>
                            </div>
                        </div>
                    ";
                }
            }
        ?>
    </div>
     <section class="socialmedia my-4 mt-3">
    <h4>  Feel free to contact us. </h4>
    <div id="social" class="social-icons">
      <ul class="h-list social-icons-contact">
        <li>
          <a href="https://www.linkedin.com/in/pradnyokti-burewar-3579a3202/" target="_blank">
            <img src=https://img.icons8.com/color/48/000000/linkedin.png alt="LinkedIn Logo">
          </a>
             </li>
        
       
        <li>
          <a href="mailto:pradnyoktiburewar23@gmail.com" target="_blank">
            <img src="https://img.icons8.com/fluent/48/000000/gmail.png" alt="Gmail Logo">
          </a>
          <li>
          
        </li>
      </ul>
    </div>
  </section>








</body>

</html>
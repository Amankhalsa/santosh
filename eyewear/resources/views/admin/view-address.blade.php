<!DOCTYPE html>
<html lang="en">
<head>
  <title>Address</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h4>Billing Address</h4>
  <table class="table table-striped">
    <tbody>
      <tr>
        <th>Billing Name</th>
        <td>{{$address->bill_name}}</td>
      </tr>

       <tr>
        <th>Billing Email</th>
        <td>{{$address->bill_email}}</td>
      </tr>

       <tr>
        <th>Billing Mobile</th>
        <td>{{$address->bill_mobile}}</td>
      </tr>
      <tr>
        <th>Billing Address</th>
        <td>{{$address->bill_address}}</td>
      </tr>
      <tr>
        <th>Billing City</th>
        <td>{{$address->bill_city}}</td>
      </tr>
      <tr>
        <th>Billing State</th>
        <td>{{$address->bill_state}}</td>
      </tr>
      <tr>
        <th>Billing Pincode</th>
        <td>{{$address->bill_pincode}}</td>
      </tr>
      <tr>
        <th>Billing Country</th>
        <td>{{$address->bill_country}}</td>
      </tr>
     
     
    </tbody>
  </table>
</div>

<hr>

<div class="container">
  <h4>Shipping Address</h4>
  <table class="table table-striped">
    <tbody>
      <tr>
        <th>Shipping Name</th>
        <td>{{$address->ship_name}}</td>
      </tr>

       <tr>
        <th>Shipping Email</th>
        <td>{{$address->ship_email}}</td>
      </tr>

       <tr>
        <th>Shipping Mobile</th>
        <td>{{$address->ship_mobile}}</td>
      </tr>
      <tr>
        <th>Shipping Address</th>
        <td>{{$address->ship_address}}</td>
      </tr>
      <tr>
        <th>Shipping City</th>
        <td>{{$address->ship_city}}</td>
      </tr>
      <tr>
        <th>Shipping State</th>
        <td>{{$address->ship_state}}</td>
      </tr>
      <tr>
        <th>Shipping Pincode</th>
        <td>{{$address->ship_pincode}}</td>
      </tr>
      <tr>
        <th>Shipping Country</th>
        <td>{{$address->ship_country}}</td>
      </tr>
     
     
    </tbody>
  </table>
</div>


</body>
</html>

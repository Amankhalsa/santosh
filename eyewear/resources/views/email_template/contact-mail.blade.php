<!DOCTYPE html>
<html>
<head>
 <title>Enquiry From {{$admin_data->admin_company_name}}</title>    
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>    
<body>
    
<table class="table table-bordered">
<thead>
  <tr>
    <th>Name</th>
    <td>{{$name}}</td>
  </tr>

  <tr>
    <th>Email</th>
    <td>{{$email}}</td>
  </tr>
  
   <tr>
    <th>Mobile No</th>
    <td>{{$phone}}</td>
  </tr>
  
   <tr>
    <th>Message</th>
    <td>{{$msg}}</td>
  </tr> 
  
  
  
</thead>

</table>    
    
</body>
</html>
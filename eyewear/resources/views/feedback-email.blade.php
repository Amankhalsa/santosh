<!DOCTYPE html>
<html>
<head>
	<title>Feedback enquiry recieved</title>

 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

</head>
<body>

<table class="table table-bordered">
    
 <tbody>
  <tr> 
  	<td> Name </td>
  	<td> {{$name}} </td> 
  </tr>     

    <tr> 
  	<td> Email </td>
  	<td> {{$email}} </td> 
  </tr>     

    <tr> 
  	<td> Phone </td>
  	<td> {{$phone}} </td> 
  </tr>     

    <tr> 
  	<td> Message </td>
  	<td> {{$msg}} </td> 
  </tr>     

       
 </tbody>
  
 </table>

</body>
</html>
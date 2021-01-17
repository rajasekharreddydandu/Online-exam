<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>How to Send Bulk Email in PHP using PHPMailer with Ajax JQuery</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="js/jquery-3.1.1.js"></script>
  <script src="lib/jquery/jquery.min.js"></script>
           <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css" />  
           <script src="lib/bootstrap/js/bootstrap.min.js"></script>  
  <link rel="stylesheet" href="css/font-awesome/font-awesome.min.css">
  
  <link rel="stylesheet" href="vendor/animate/animate.min.css">
</head>
<body>
<style type="text/css">
  .div_con{
	  display:inline-block;
    margin-bottom:15px;
    float: right;
	 margin-right:10px;
  }
  .input_check{
	  position:relative;
	  aligne-item:center;
	  margin-right:10px;
	  padding:10px;
  }
  
  
</style>
<div class="container" style="margin-top:50px">
  <h1 style="text-align:center">Send Bulk Email in PHP using PHPMailer with Ajax JQuery</h1><br>
    <div class="row">
      <div class="col-md-12">
        <div id="emailMsg"></div>
		<div class="div_con">
			<input type="checkbox" class="input_check" onchange="checkAll(this)" name="chk[]" >
			<button type="button" class="btn btn-success email_button" id="bulk_email" data-action="bulk" >Send Bulk Email</button>
		
		</div>
		
		
        <table class="table table-striped table-hover table-responsive table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>S.no.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Select</th>
			  <th>Handle</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              
$servername = "localhost";
		 $username = "root";
		 $password = "";
		 $dbname = "php_project";
		 //create connection
		 $conn = mysqli_connect($servername ,$username ,$password,$dbname );
		 
		 if(!$conn){
				 
		   die("Connection failed:".mysqli_connect_error());
		 
		  }
              $query  = "SELECT * FROM tbl_info";
              $result = mysqli_query($conn, $query);
			  $count = 0;
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $count= $count+1;
            ?> 
            <tr>
              <td class="text-center"><?php echo $count ?></td>
              <td><?php echo $row['name'] ?></td>
              <td><a href="#" class="hover" id="<?php echo $row["id"]; ?>"><?php echo $row["email"]; ?></a></td>
              <td><input type="checkbox" class="single_select" name="single_select" data-email=<?php echo $row['email'] ?> data-name=<?php echo $row['name'] ?> ></td>
			  <td><button type="button" id=<?php echo $count?> class="btn btn-info btn-xs text-white  email_button" name="email_button" data-email=<?php echo $row['email'] ?> data-name=<?php echo $row['name'] ?>  data-action="single">Send Single</button></td>
            </tr>
            <?php } }else { echo "No record found"; } ?> 
          </tbody>
        </table>           
      </div>
    </div>
  </div>
  
	<script type="text/javascript" src="js/validation.min.js"></script>
	
  <script type="text/javascript">
  function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
             }
         }
     } else {
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
             }
         }
     }
 }
  $(document).ready(function(){
	  
	  $('.hover').popover({  
                title:fetchData,  
               html:true,  
                placement:'right',

           });  
           function fetchData(){  
                var fetch_data = '';  
                var element = $(this);  
                var id = element.attr("id");  
                $.ajax({  
                     url:"fetchdata.php",  
                     method:"POST",  
                     async:false,  
                     data:{id:id},  
                     success:function(data){  
                          fetch_data = data;  
                     }  
                });  
                return fetch_data;  
           }  
	  
	  $('.email_button').click(function(){
		$(this).attr('disabled', 'disabled');
		var id  = $(this).attr("id");
		var action = $(this).data("action");
		var email_data = [];
		if(action == 'single')
		{
			email_data.push({
				email: $(this).data("email"),
				name: $(this).data("name")
			});
		}
		else
		{  
			$('.single_select').each(function(){
				
				if($(this).prop("checked") == true)
				{
					email_data.push({
						email: $(this).data("email"),
						name: $(this).data('name')
					});
				}
				
			});
		}
		console.log(email_data.length);
        if (email_data.length > 0) {
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{email_data:email_data},
				beforeSend:function(){
					$('#'+id).html('Sending...');
					$('#'+id).addClass('btn-danger');
				},
				success:function(data){
					if(data == 'ok')
					{
						$('#'+id).text('Success');
						$('#'+id).removeClass('btn-danger');
						$('#'+id).removeClass('btn-info');
						$('#'+id).addClass('btn-success');
						var selected = [];
						$('input:checked').each(function() {
							selected.push($(this).attr('name'));
						});
						$("#emailMsg").html('<div class="alert alert-success alert-dismissible"> Mail send successfully !</div>');
						$(".alert-success").fadeOut(5000);
					}
					else
					{
						$('#'+id).text(data);
					}
					$('#'+id).attr('disabled', false);
				}
			})
		}
		else
		{
			
			$("#emailMsg").html('<div class="alert alert-danger alert-dismissible"> Plase Select at least one checkbox </div>');
			
			$('#'+id).attr('disabled', false);
			$(".alert-danger").fadeOut(5000);
		}

	});
	  
});
  

</script>
</body>
</html>
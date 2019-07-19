
<?php 
 if(isset($_POST["export"]))  
 {  
      $connect = mysqli_connect("localhost", "graduationday", "graduationday", "graduationday");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Registration ID', 'Name', 'USN', 'Dept', 'Mobile', 'Email', 'Private Email', 'Attending', 'People', 'Answer1', 'Answer2', 'Answer3', 'Answer4', 'Answer5', 'Answer6', 'Answer7', 'Answer8', 'Answer9', 'Answer10', 'Answer11', 'Answer12', 'Feedback'));  
      $query = "SELECT stud_id, name, usn, dept, mobile, email, pvt_email, attending, people, a1, a2, a3, a4, a5, a6, a7, a8, a9, a10, a11, a12,feedback from attendance";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);
 }  
 ?>

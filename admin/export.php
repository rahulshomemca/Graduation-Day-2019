<?php 
 if(isset($_POST["export"]))  
 {  
      $connect = mysqli_connect("localhost", "graduationday", "graduationday", "graduationday");  
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('Id', 'Stud_ID', 'Name', 'USN', 'Dept', 'Mobile', 'Email', 'Attending', 'People', 'Question1', 'Answer1', 'Question2', 'Answer2', 'Question3', 'Answer3', 'Question4', 'Answer4', 'Question5', 'Answer5', 'Feedback'));  
      $query = "SELECT * from attendance";  
      $result = mysqli_query($connect, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);
 }  
 ?>

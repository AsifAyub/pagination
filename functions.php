<?php 

$connection=mysqli_connect("localhost","root","","pagination"); 
    
function InsertQuery(){
             Global $connection;
             $title=$_POST['title'];
             $author=$_POST['author'];
             $content=$_POST['content'];
             if($title!== '' && $author!== '' && $content!== '' ){
             
             
             $insert_query="INSERT INTO posts(post_title,post_author, post_date, post_content)";
             $insert_query.="VALUES('$title','$author',now(),'$content')";
             $insert_query_result=mysqli_query($connection,$insert_query);
             if(!$insert_query_result){
                 die("INSERT QUERY FAILED".mysqli_error($connection));
             }
             header("Location: index.php");
             
             
             
             
             }
    
}
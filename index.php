<?php include('functions.php')  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script>
</head>
<body>
   
   <div class="row">
      <div class="col-md-6">
        
             
             
                <table class="table">
                <h2>All Posts</h2>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Content</th>
                </tr>
                
                
                
                
                
                 <?php
    
//////////////   Query for pagination 
    
                   $per_page=2;
                    if(isset($_GET['page'])){
                    $page= $_GET['page'];
                    }else{
                        $page='';
                    }
                    if($page=='' || $page==0){
                        $page_1=0;
                        
                    }else{
                    $page_1=($page*$per_page)-$per_page;
                    }
                    
$select_query_for_count="SELECT * FROM posts ";
$count_query_result=mysqli_query($connection, $select_query_for_count);   
$total_count=mysqli_num_rows($count_query_result); 
$count_div=ceil($total_count/$per_page); 
                    

$select_query="SELECT * FROM posts LIMIT $page_1, $per_page";
$select_query_result=mysqli_query($connection, $select_query);
if(!$select_query_result){
    die("Select query Failed".mysqli_error($connection));
}
while($row=mysqli_fetch_assoc($select_query_result)){
    $post_id=$row['post_id'];
    $post_title=$row['post_title'];
    $post_author=$row['post_author'];
    $post_date=$row['post_date'];
    $post_content=$row['post_content'];
   
    
     echo "<tr>";
     echo "<td><p>$post_title</p></td>";
     echo "<td><p>$post_author</p></td>";
     echo "<td><p>$post_date</p></td>";
     echo "<td><p>$post_content</p></td>";
     echo "</tr>";
    
      
}
    ?>
            </table>
            

     <ul class="pager">
<?php
for($i=1; $i<=$count_div; $i++){
if($i == $page){
    echo "<li><a class='active_list' href='index.php?page=$i'>$i</a></li>";
}else{
echo "<li><a href='index.php?page=$i'>$i</a></li>";
}
}

?>
     </ul>
    
      </div>
   
       <div class="col-md-6">
       
       
       
       
       

 <?php
//          Query for adding new post
           
           
 if(isset($_POST['submit_post'])){

     $title=$_POST['title'];
     $author=$_POST['author'];
     $content=$_POST['content'];

     // Insert Query function from functions.php
     InsertQuery();

 }
 ?>
         
         
         
         
         
<!--         form for adding new post-->
         
          <form action="index.php" method="post" class="form">
             <h2>Add Post</h2>
         <hr>
              <div class="form-group">
                  <input type="text" name="title" class="form-control" placeholder="Enter Title" id="">
              </div>
              <div class="form-group">
                  <input type="text" name="author" class="form-control" placeholder="Author Name" id="">
              </div>
              <div class="form-group">
                  <textarea id="txt_editor"  name="content" cols="52" rows="10" placeholder="Enter Description here"></textarea>
              </div>
              <div class="form-group">
                  <input type="submit" value="submit" class="btn btn-dark" name="submit_post">
              </div>
          </form>
           
      </div>
   </div>
    
    
<!--    javascript code for editor -->
     <script>
         ClassicEditor
        .create( document.querySelector( '#txt_editor' ) )
        .catch( error => {
            console.error( error );
        } );
    </script>
</body>
</html>
  




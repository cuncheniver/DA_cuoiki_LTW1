if($t==0)
  {
   if ($k == "like")
   {   
       
       $sql1 = "INSERT INTO `likes`(`postId`, `userId`, `createdAt`,`type`) VALUES ($pid,$user_id,now(),$type)";
       $sql2 = "UPDATE `post` SET `likes` = likes+1 WHERE id = $pid";
       $sql3 = "INSERT INTO `notifications`(`from`, `to`, `parent`, `child`, `type`, `read`, `time`) VALUES ($user_id,$x,$pid,0,1,0,now())";
       mysqli_query($connect, $sql1);
       mysqli_query($connect, $sql2);
       if($x !=$user_id)
       {
           mysqli_query($connect, $sql3);
       }
     
   }
   else
   {
       $sql1 = "DELETE FROM `likes` where postId =$pid  ";
       $sql2 = "UPDATE `post` SET `likes` = likes-1 WHERE id = $pid";
       mysqli_query($connect, $sql1);
       mysqli_query($connect, $sql2);
   }

  }
  else{
   if ($k == "like")
   {   
   $sql1 = "INSERT INTO `likes`(`postId`, `userId`, `createdAt`,`type`) VALUES ($pid,$user_id,now(),$type)";
   mysqli_query($connect, $sql1);
   if($sql1)
   {
    $sql2 = "UPDATE `comments` SET `likes` = likes+1 WHERE id = $pid";
   
    mysqli_query($connect, $sql2);
   }
   
   }
   else
   {
       $sql1 = "DELETE FROM `likes` where postId =$pid  ";
       $sql2 = "UPDATE `comments` SET `likes` = likes-1 WHERE id = $pid";
       mysqli_query($connect, $sql1);
       mysqli_query($connect, $sql2);
   }
  }
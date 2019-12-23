<?php

require_once 'dd.php';
require_once 'function.php';
session_start();
$userId =$_SESSION['userId'];
$currentUser= findUserById($userId); 
$user=findUserById($_POST['id']);
if(!$currentUser)
{
  header('location: login.php');
  exit(0);
}
$relationship= findRelationship($currentUser['id'],$user['id']);
$isFriend = count($relationship)===2;
$noRelationship = count($relationship)===0;
if(count($relationship)===1)
{
    $isRequesting= $relationship[0]['user1Id']===$currentUser['id'];
}
if($_POST['action']=== 'gui yeu cau ket ban')
{
    
    

    addRelationship($currentUser['id'],$user['id']);
     $secret = generateRandomString();
     $link = 'href="http://localhost:8080/DA_cuoiki_LTW1/friend.php?id='.$currentUser['id'].'"';
    sendEmail($user['email'], 'Friend Request', ' <a '.$link.'> click here </a>');
                  

   
}
if($_POST['action']=== 'huy yeu cau ket ban' || $_POST['action']=== 'Xoa ket ban' )
{
    
    removeRelationship($currentUser['id'],$user['id']);
    
   
}
if($_POST['action']=== 'chap nhan ket ban')
{
    $ok=$user['id'];
    $ok2=$currentUser['id'];
    addRelationship($ok2,$ok);
   
}
if($_POST['action']=== 'Theo dõi')
{
    $ok=$user['id'];
    $ok2=$currentUser['id'];
    addFollow($ok2,$ok);
   
}
if($_POST['action']=== 'Bõ theo dõi')
{
    $ok=$user['id'];
    $ok2=$currentUser['id'];
    removeFollow($ok2,$ok);
   
}
header('location: friend.php?id='.$user['id']);
?> 
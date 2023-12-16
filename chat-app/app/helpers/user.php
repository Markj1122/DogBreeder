<?php  

function getUser($username, $conn){
   $sql = "SELECT * FROM chat_users 
           WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$username]);

   if ($stmt->rowCount() === 1) {
   	 $user = $stmt->fetch();
   	 return $user;
   }else {
   	$user = [];
   	return $user;
   }
}
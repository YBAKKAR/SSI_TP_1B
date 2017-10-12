<?php

include('conf/db.inc');
$stmt = mysqli_stmt_init($mysqli);

$query = "select * from user";
if ($result = mysqli_query($mysqli,$query))
{
    while($row = mysqli_fetch_assoc($result))
    {
        $options = [
            'salt' => hash("sha256",$row['username']),
        ];
        $password = password_hash ($row['password'],PASSWORD_DEFAULT,$options);
        $updatePasswordQuery = "UPDATE `user` SET `password`='".$password."' WHERE `id` = ".$row["id"];
        mysqli_query($mysqli , $updatePasswordQuery);
        echo "execution is over.";
    }
}

?>
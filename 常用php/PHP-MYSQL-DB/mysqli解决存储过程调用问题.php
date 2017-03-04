<?php 


// $con = mysql_connect("localhost","root","");
// if (!$con)
// {
//     die('Could not connect: ' . mysql_error());
// }

// mysql_select_db("game", $con);


// $result = mysql_query("call slowWin('9999','1449211075','100','100','1')");

// while ($row = $result->fetch_row()) {
//     print_r($row);
// }
// $result->close();
//  mysql_close($con);
// exit;

/////////////////////////////////////MYSQLI 解决了

$mysqli = new mysqli("localhost", "root", "", "game");
$result = $mysqli->multi_query( "call slowWin('9999','1449211075','100','100','1');");
$i=0;
 do {
    if ($result = $mysqli->store_result()) {
        
        while ($row = $result->fetch_assoc()) {
            $list[$i][]=$row;

        }
        //$result->close();
    }
     $i++;
 } while ($mysqli->next_result());
    
    
print_R($list);

exit;


if ($result3 = $mysqli->query("call slowWin('9999','1449211075','100','100','1');"))
{
    while ($row = $result3->fetch_assoc()) {


        print_r($row);
    }
    $result3->close();
}




exit;


// $mysqli = new mysqli("localhost", "root", "sbqcel", "test");

// if (mysqli_connect_errno())
// {
//     printf("Connect failed: %s\n", mysqli_connect_error());
//     exit();
// }
// echo 'result1:<br />';
// $mysqli->autocommit(FALSE);
// if ($mysqli->multi_query("call test1();"))
// {
//     do {
//         if ($result = $mysqli->store_result()) {
//             while ($row = $result->fetch_row()) {
//                 printf("%s\n", $row[0]);
//             }
//             $result->close();
//         }
//     } while ($mysqli->next_result());
// }
// $mysqli->commit();
// echo "<br />";
// echo "result2:<br />";
// if ($result2 = $mysqli->query("select val from tb1;"))
// {
//     while ($row = $result2->fetch_row()) {
//         printf ("%s <br />", $row[0]);
//     }
//     $result2->close();
// }
// else
// {
//     echo $mysqli->error;
// }
// $mysqli->close();


// //mysql_close($con);

?>
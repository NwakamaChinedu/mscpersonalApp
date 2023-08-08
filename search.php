<?php

include_once 'assets/sql/connect.php';

/* $query = htmlspecialchars($_GET["query"]);
echo json_encode(['html' => $query]); */
//echo $_GET("query");

if(isset($_GET["query"]))
{ 
    

    $sql = 'SELECT * FROM allstories WHERE category LIKE :keyword OR location LIKE :keyword';
    $pdo_statement = $conn->prepare($sql);
    $pdo_statement->bindValue(':keyword', '%' . $_GET["query"] . '%', PDO::PARAM_STR);
    $pdo_statement->execute();
    $searchresult = $pdo_statement->fetchAll(); 
    $query = htmlspecialchars($_GET["query"]);
    //echo json_encode(['html' => $query]);
    echo json_encode($searchresult);
}
else{
    $query = "SELECT * FROM allstories";
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    echo json_encode($result);

}

?>
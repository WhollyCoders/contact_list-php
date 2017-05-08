<?php
class QueryDatabase{
  function __construct($query_data){
    mysqli_query($query_data['connection'], $query_data['query']);
  }
}
 ?>

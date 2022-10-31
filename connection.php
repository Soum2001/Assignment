<?
require 'vendor/autoload.php';

define('PROFILE_STORAGE_PATH','/var/www/html/profile_images/');
define('BANNER_STORAGE_PATH','/var/www/html/banner_images/');
define('CUSTOM_STORAGE_PATH','/var/www/html/custom_images/');


$connection = new PDO('mysql:host=localhost;dbname=user;charset=utf8', 'root', 'mindfire');

// create a new mysql query builder
$query_builder = new \ClanCats\Hydrahon\Builder('mysql', function($query, $queryString, $queryParameters) use($connection)
{
    $statement = $connection->prepare($queryString);
    $statement->execute($queryParameters);

    // when the query is fetchable return all results and let hydrahon do the rest
    // (there's no results to be fetched for an update-query for example)
    if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface)
    {
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
    // when the query is a instance of a insert return the last inserted id  
    elseif($query instanceof \ClanCats\Hydrahon\Query\Sql\Insert)
    {
        return $connection->lastInsertId();
    }
    // when the query is not a instance of insert or fetchable then
    // return the number os rows affected
    else 
    {
        return $statement->rowCount();
    }	
});
?>
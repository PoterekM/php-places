








function save()
{
    array_push($_SESSION['list_of_tasks'], $this);
}
 static function getAll()
 {
    return $_SESSION['list_of_tasks'];
 }

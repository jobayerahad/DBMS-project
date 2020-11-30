<?php
/**
 * Format Class
 */
class Redirects
{
  public static function checkCompleteProfile()
  {
    $db = new Database();
    $userId = Session::get("userId");
    $query = "SELECT * FROM author WHERE user_id = '$userId'";
    $result = $db->select($query);
    if ($result == false) {
      header("Location: profile.php");
    }
  }
}

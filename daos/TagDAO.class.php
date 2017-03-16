<?php
require_once __DIR__."/../models/Item.class.php";
require_once __DIR__."/../utils/ModelFactory.class.php";
require_once __DIR__."/../utils/PDOAccess.class.php";

class TagDAO {
    public static function getUserTags($user_id) {
        $tags = null;
        if (!is_null($user_id)) {
            $query = "SELECT tag.tag_id, tag_name FROM user_tag NATURAL JOIN tag WHERE user_tag.user_id =" .$user_id;
            $result = PDOAccess::insertSQLquery($query);
            if ($result) {
                $item = ModelFactory::buildModel("Item", $result[0]);
            }
        }
        return $item;
    }

}

?>

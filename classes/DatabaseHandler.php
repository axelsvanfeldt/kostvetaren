<?php
class DatabaseHandler {
    public static function query($config, $sql, $params) {
        try {
            $returnData = array(
                "complete" => FALSE,
                "result" => FALSE,
            );
            if ($config["database_connection"]) {
                $stmt = $config["database_connection"]->prepare($sql);
                $stmt->execute($params);
                $errorInfo = $stmt->errorInfo()[2];
                if (!is_null($errorInfo)) {
                    $returnData["result"] = $errorInfo;
                }
                else {
                    $returnData["complete"] = TRUE;
                    if (substr($sql, 0, 6) === "SELECT") {
                        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if (!$arr) {
                            $arr = [];
                        }
                        $returnData["result"] = $arr;      
                    }
                }
                $stmt = null;
            }
            else {
                $returnData["result"] = "Error while establishing database connection!";
            }
            return $returnData;
        }
        catch(PDOException $e) {
            return array(
                "complete" => FALSE,
                "result" => $e->getMessage()
            );
        }
    }
}
?>
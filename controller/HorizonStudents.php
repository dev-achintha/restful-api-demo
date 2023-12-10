<?php

require_once "Restful.php";
require_once PROJECT_ROOT_PATH . "/model/DatabaseOperation.php";

class HorizonStudents extends Restful
{
    public function performAction()
    {
        $strErrorDesc = '';
        $responseData = null;

        $requestMethod = $_SERVER["REQUEST_METHOD"];

        try {
            $databaseoperation = new DatabaseOperation();
            $query = "SELECT * FROM horizonstudents";

            switch (strtoupper($requestMethod)) {
                case 'GET':
                    $getParameters = $_GET;

                    if (!empty($getParameters)) {
                        $queryParams = [];
                        $whereClause = [];

                        foreach ($getParameters as $key => $value) {
                            $queryParams[$key] = $value;
                            $whereClause[] = "`$key` = :$key";
                        }

                        $whereString = implode(' AND ', $whereClause);
                        $query = "SELECT * FROM horizonstudents WHERE $whereString";

                        $arrUsers = $databaseoperation->select($query, $queryParams);
                    } else {
                        $query = "SELECT * FROM horizonstudents";
                        $arrUsers = $databaseoperation->select($query);
                    }

                    $responseData = json_encode($arrUsers);
                    break;

                case 'POST':
                    $postData = json_decode(file_get_contents("php://input"), true);
                    $responseData = json_encode($databaseoperation->insert('horizonstudents', $postData));
                    break;

                case 'PUT':
                    $putData = json_decode(file_get_contents("php://input"), true);
                    $responseData = json_encode($databaseoperation->update('horizonstudents', $putData, 'index_no = :index_no'));
                    break;

                case 'DELETE':
                    $deleteData = json_decode(file_get_contents("php://input"), true);
                    $responseData = json_encode($databaseoperation->delete('horizonstudents', 'index_no = :index_no', $deleteData));
                    break;

                default:
                    $strErrorDesc = 'Method not supported';
                    $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
                    break;
            }
        } catch (Error $e) {
            $strErrorDesc = $e->getMessage() . ' Something went wrong! Please contact support.';
            $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
        }

        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }
}

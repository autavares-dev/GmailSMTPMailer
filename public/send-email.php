<?php

require(dirname(__FILE__) . "/../example/send.php");

# Test API. Receives a POST request with parameter "to" containing the
# destination e-mail address.

if ($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    http_response_code(405);
} else if (!isset($_POST["to"]))
{
    http_response_code(422);
} else
{
    $error = send(htmlspecialchars($_POST["to"]));

    if ($error === '')
    {
        http_response_code(200);
    }
    else
    {
        $response = array();
        $response["error"] = $error;
        http_response_code(400);
        echo json_encode($response);
    }
}

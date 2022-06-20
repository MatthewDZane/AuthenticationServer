<?php
class AuthenticationController extends BaseController
{
    public function tryLogin() {
        $responseData = "";
        $strErrorDescription = "";
        $strErrorHeader = "";
        $requestMethod = strtoupper($_SERVER["REQUEST_METHOD"]);
        $arrQueryStringParams = $this->getQueryStringParams();

        if ($requestMethod == 'GET' || $requestMethod == 'POST') {
            if ($arrQueryStringParams && 
                array_key_exists("username", $arrQueryStringParams) &&
                array_key_exists("password", $arrQueryStringParams)) {
                $username = $arrQueryStringParams["username"];
                $password = $arrQueryStringParams["password"];
                try {
                    if ($username == "username" && $password == "password") {
                        
                        $postdata = http_build_query(
                            array(
                                'secret' => 'o1Baj2l6IzfF',
                                'sub' => 1,
                                'nickname' => "Hello",
                            )
                        );
                        $opts = array('http' =>
                            array(
                                'method' => 'POST',
                                'header' => 'Content-type: application/x-www-form-urlencoded',
                                'content' => $postdata
                            )
                        );
                        $context = stream_context_create($opts);
                        $responseData = file_get_contents('https://simple-first-party-auth.matthewdzane.workers.dev/issue', false, $context);
                    }
                    else {
                        $strErrorDescription = "Invalid Credentials";
                        $strErrorHeader = 'HTTP/1.1 400 Bad Request';
                    }
                } catch (Error $e) {
                    $strErrorDescription = $e->getMessage();
                    $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
                }
            }
            else {
                $strErrorDescription = "Missing 'username' or 'password' parameter.";
                $strErrorHeader = 'HTTP/1.1 400 Bad Request';
            }
        }
        else {
            $strErrorDescription = "Method not supported";
            $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
        }

        $this->outputData($responseData, $strErrorDescription, $strErrorHeader);
    }

    private function outputData($responseData, $strErrorDescription,
                                $strErrorHeader) {
        if (!$strErrorDescription) {
            $this->sendOutput($responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK'));
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDescription)), 
                array('Content-Type: application/json', $strErrorHeader));
        }
    }
}


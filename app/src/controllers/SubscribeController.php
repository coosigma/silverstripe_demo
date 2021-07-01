<?php
use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Dev\Debug;

class SubscribeController extends Controller
{

    private static $allowed_actions = [
        'index',
    ];

    public function index(HTTPRequest $request)
    {
        $params = json_decode($this->getRequest()->getBody());
        $data = $params;
        $this->getResponse()->setBody(json_encode(
            $data
        ));
        $this->getResponse()->addHeader("Content-type", "application/json");
        return $this->getResponse();
    }

}

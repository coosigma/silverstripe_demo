<?php
use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use SSDemo\Models\Subscriber;

class SubscribeController extends Controller
{

    private static $allowed_actions = [
        'index',
    ];

    public function index(HTTPRequest $request)
    {
        $params = json_decode($this->getRequest()->getBody());
        $subs = Subscriber::get()->filter([
            'Email' => $params->email,
        ]);
        $this->getResponse()->addHeader("Content-type", "application/json");
        if ($subs->exists()) {
            $this->getResponse()->setBody(json_encode(
                ['message' => 'This email has been submitted.']
            ));
            return $this->getResponse();
        }
        $sub = Subscriber::create();
        $sub->Name = $params->name;
        $sub->Company = $params->company;
        $sub->Email = $params->email;
        $sub->write();
        $this->getResponse()->setBody(json_encode(
            ['message' => 'Submission success!']
        ));
        return $this->getResponse();
    }

}

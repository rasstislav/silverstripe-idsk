<?php

namespace Rasstislav\IdSk\Controllers;

use Rasstislav\IdSk\Models\Feedback;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Controller;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;

class ApiFeedbackController extends Controller
{
    private static $allowed_actions = [
        'apiPageUsefulness',
        'apiPageIssue',
    ];

    private static $url_handlers = [
        'POST page-usefulness' => 'apiPageUsefulness',
        'POST page-issue' => 'apiPageIssue',
    ];

    public function index(HTTPRequest $request)
    {
        $action = __FUNCTION__;
        $classMessage = Director::isLive() ? 'on this handler' : 'on class ' . static::class;

        return $this->httpErrorResult();
    }

    public function apiPageUsefulness(HTTPRequest $request)
    {
        if (
            !$request->allParsed()
            || $request->param('Action') !== 'page-usefulness'
            || !$request->isAjax()
        ) {
            return $this->httpErrorResult();
        }

        Feedback::create([
            'Type' => 'PageUsefulness',
            'Output' => !is_scalar($output = $request->postVar('output')) ? json_encode($output) : $output,
            'Url' => ($referer = $this->getReturnReferer()) ?: null,
            'Page' => ($link = $this->removeGetVars($referer)) ? SiteTree::get_by_link($link) : null,
        ])->write();

        return (new HTTPResponse())->addHeader('Content-Type', 'application/json');
    }

    public function apiPageIssue(HTTPRequest $request)
    {
        if (
            !$request->allParsed()
            || $request->param('Action') !== 'page-issue'
            || !$request->isAjax()
        ) {
            return $this->httpErrorResult();
        }

        Feedback::create([
            'Type' => 'PageIssue',
            'Output' => !is_scalar($output = $request->postVar('output')) ? json_encode($output) : $output,
            'Url' => ($referer = $this->getReturnReferer()) ?: null,
            'Page' => ($link = $this->removeGetVars($referer)) ? SiteTree::get_by_link($link) : null,
        ])->write();

        return (new HTTPResponse())->addHeader('Content-Type', 'application/json');
    }

    private function removeGetVars($url)
    {
        if ($url && ($position = strpos($url, '?')) !== false) {
            $url = substr($url, 0, $position);
        }

        return $url;
    }

    private function httpErrorResult()
    {
        $action = __FUNCTION__;
        $classMessage = Director::isLive() ? 'on this handler' : 'on class ' . static::class;

        return $this->httpError(404, "Action '$action' isn't available $classMessage.");
    }
}

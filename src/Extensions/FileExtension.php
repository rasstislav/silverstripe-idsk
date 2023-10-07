<?php

namespace Rasstislav\IdSk\Extensions;

use League\MimeTypeDetection\GeneratedExtensionToMimeTypeMap;
use SilverStripe\Core\Extension;

class FileExtension extends Extension
{
    public function preview(string $title = '', bool $removeBottomMargin = true)
    {
        if (!$template = $this->owner->File->getFrontendTemplate()) {
            return '';
        }

        if ($this->owner->getMimeType() === GeneratedExtensionToMimeTypeMap::MIME_TYPES_FOR_EXTENSIONS['pdf']) {
            $template = 'DBFile_pdf';
        }

        $data = [
            'ShowTitle' => !!$title,
            'RemoveBottomMargin' => $removeBottomMargin,
        ];

        if ($title) {
            $data['Title'] = $title;
        }

        return $this->owner->renderWith("{$template}_preview", $data);
    }
}

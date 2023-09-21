<?php

namespace Rasstislav\IdSk\Extensions;

use League\MimeTypeDetection\GeneratedExtensionToMimeTypeMap;
use SilverStripe\Core\Extension;

class FileExtension extends Extension
{
    public function preview(bool $showTitle = false, bool $removeBottomMargin = true)
    {
        if (!$template = $this->owner->File->getFrontendTemplate()) {
            return '';
        }

        if ($this->owner->getMimeType() === GeneratedExtensionToMimeTypeMap::MIME_TYPES_FOR_EXTENSIONS['pdf']) {
            $template = 'DBFile_pdf';
        }

        return $this->owner->renderWith($template, [
            'ShowTitle' => $showTitle,
            'RemoveBottomMargin' => $removeBottomMargin,
        ]);
    }
}

<?php

namespace Rasstislav\IdSk;

use SilverStripe\Forms\FormField;
use SilverStripe\Forms\HTMLEditor\TinyMCEConfig as CoreTinyMCEConfig;

class TinyMCEConfig extends CoreTinyMCEConfig
{
    public const MODE_MINIMAL = 'minimal';
    public const MODE_BASIC = 'basic';

    protected $buttons = [
        1 => [
            'newdocument', '|',
            'undo', 'redo', '|',
            'alignleft', 'aligncenter', 'alignright', 'alignjustify', '|',
            'alignnone', '|',
            'removeformat', '|',
            'visualblocks', 'visualchars', '|',
            'searchreplace', '|',
            'preview', 'print', '|',
            'fullscreen',
        ],
        2 => [
            'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', '|',
            'bullist', 'numlist', '|',
            'outdent', 'indent', '|',
            'toc', '|',
            'hr', '|',
            'insertdatetime', '|',
            'charmap', 'emoticons'
        ],
        3 => [
            'formatselect', '|',
            'paste', 'pastetext', '|',
            'table', '|',
            'sslink', '|',
            'nonbreaking', 'codesample', '|',
            'code',
        ],
    ];

    public function removeRootBlock()
    {
        $this->setOption('forced_root_block', false);
        $this->addInvalidElements('p', 'div');

        return $this;
    }

    public function removeAligns()
    {
        $this->removeButtons('alignleft', 'aligncenter', 'alignright', 'alignjustify', 'alignnone');

        return $this;
    }

    public function removeLists()
    {
        $this->removeButtons('bullist', 'numlist', 'outdent', 'indent');
        $this->addInvalidElements('ol', 'ul', 'li', 'dd', 'dl', 'dt');

        return $this;
    }

    public function removeTableOfContents()
    {
        $this->removeButtons('toc');

        return $this;
    }

    public function removeHorizontalRule()
    {
        $this->removeButtons('hr');
        $this->addInvalidElements('hr');

        return $this;
    }

    public function removeDropdownSelectionLists()
    {
        $this->removeButtons('styleselect', 'formatselect', 'fontselect', 'fontsizeselect');
        $this->addInvalidElements('h2', 'h3', 'h4');

        return $this;
    }

    public function removeTables()
    {
        $this->removeButtons('table');
        $this->addInvalidElements('table', 'tr', 'tbody', 'thead', 'tfoot', 'td', 'th', 'caption');

        $contextmenu = explode(' ', $this->getOption('contextmenu'));
        $contextmenu = array_combine($contextmenu, $contextmenu);

        unset(
            $contextmenu['inserttable'],
            $contextmenu['|'],
            $contextmenu['cell'],
            $contextmenu['row'],
            $contextmenu['column'],
            $contextmenu['deletetable'],
        );

        $this->setOption('contextmenu', implode(' ', $contextmenu));

        return $this;
    }

    public function removeMedia()
    {
        $this->removeButtons('ssmedia', 'ssembed', 'emoticons');
        $this->addInvalidElements('img', 'iframe', 'object', 'param');

        $contextmenu = explode(' ', $this->getOption('contextmenu'));
        $contextmenu = array_combine($contextmenu, $contextmenu);

        unset(
            $contextmenu['ssmedia'],
            $contextmenu['ssembed'],
        );

        $this->setOption('contextmenu', implode(' ', $contextmenu));

        return $this;
    }

    public function setMode(FormField $field, string $mode)
    {
        $tinyMCEConfig = clone $this;

        switch ($mode) {
            case static::MODE_MINIMAL:
                $tinyMCEConfig
                    ->setOption('menubar', false)
                    ->removeAligns()
                    ->removeLists()
                    ->removeTableOfContents()
                    ->removeDropdownSelectionLists()
                    ->removeTables()
                    ->removeMedia()
                    ->removeHorizontalRule()
                ;

                $tinyMCEConfig->removeButtons('codesample');
                $tinyMCEConfig->removeButtons('fullscreen');
                break;

            case static::MODE_BASIC:
                $tinyMCEConfig
                    ->setOption('menubar', false)
                    ->removeTables()
                    ->removeMedia()
                ;

                $tinyMCEConfig->removeButtons('codesample');
                break;
        }

        $identifier = $tinyMCEConfig->getOption('editorIdentifier').'_'.$mode;

        if (!$config = self::$configs[$identifier] ?? null) {
            $tinyMCEConfig = self::set_config($identifier, $tinyMCEConfig);
        } else {
            $tinyMCEConfig = $config;
        }

        $field->setEditorConfig($tinyMCEConfig);

        return $tinyMCEConfig;
    }

    /**
     * @see https://www.tiny.cloud/docs-4x/configure/content-filtering/#invalid_elements
     */
    public function addInvalidElements($elements)
    {
        if (func_num_args() > 1) {
            $elements = func_get_args();
        }

        if (!is_array($elements)) {
            $elements = [$elements];
        }

        $newInvalidElements = implode(',', $elements);

        if ($invalidElements = $this->getOption('invalid_elements')) {
            $invalidElements .= ','.$newInvalidElements;
        } else {
            $invalidElements = $newInvalidElements;
        }

        $this->setOption('invalid_elements', $invalidElements);

        return $this;
    }
}

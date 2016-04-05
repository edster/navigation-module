<?php namespace Anomaly\NavigationModule\Link\Tree;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Illuminate\Translation\Translator;

/**
 * Class LinkTreeSegments
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\NavigationModule\Link\Tree
 */
class LinkTreeSegments
{

    /**
     * Handle the segments.
     *
     * @param LinkTreeBuilder $builder
     */
    public function handle(LinkTreeBuilder $builder)
    {
        $builder->setSegments(
            [
                'entry.edit_link',
                [
                    'class' => 'text-faded',
                    'value' => function (LinkInterface $entry, Translator $translator) {

                        $type = $entry->getType();

                        return '<span class="small" style="padding-right:10px;">' . $translator->trans(
                            $type->getTitle()
                        ) . '</span>';
                    },
                ],
                [
                    'data-toggle' => 'tooltip',
                    'class'       => 'text-danger',
                    'value'       => '<i class="fa fa-chain-broken"></i>',
                    'attributes'  => [
                        'title' => 'module::message.broken'
                    ],
                    'enabled'     => function (LinkInterface $entry) {

                        $type = $entry->getType();

                        return !$type->exists($entry);
                    }
                ]
            ]
        );
    }
}

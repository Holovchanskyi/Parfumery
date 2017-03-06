<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * This is a file to add template specific chrome to pagination rendering.
 *
 * pagination_list_footer
 * 	Input variable $list is an array with offsets:
 * 		$list[limit]		: int
 * 		$list[limitstart]	: int
 * 		$list[total]		: int
 * 		$list[limitfield]	: string
 * 		$list[pagescounter]	: string
 * 		$list[pageslinks]	: string
 *
 * pagination_list_render
 * 	Input variable $list is an array with offsets:
 * 		$list[all]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[start]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[previous]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[next]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[end]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[pages]
 * 			[{PAGE}][data]		: string
 * 			[{PAGE}][active]	: boolean
 *
 * pagination_item_active
 * 	Input variable $item is an object with fields:
 * 		$item->base	: integer
 * 		$item->link	: string
 * 		$item->text	: string
 *
 * pagination_item_inactive
 * 	Input variable $item is an object with fields:
 * 		$item->base	: integer
 * 		$item->link	: string
 * 		$item->text	: string
 *
 * This gives template designers ultimate control over how pagination is rendered.
 *
 * NOTE: If you override pagination_item_active OR pagination_item_inactive you MUST override them both
 */

/**
 * Renders the pagination footer
 *
 * @param   array  $list  Array containing pagination footer
 *
 * @return  string  HTML markup for the full pagination footer
 *
 * @since   3.0
 */
function pagination_list_footer($list)
{
    $html = "<div class=\"pagination\">\n";
    $html .= $list['pageslinks'];
    $html .= "\n<input type=\"hidden\" name=\"" . $list['prefix'] . "limitstart\" value=\"" . $list['limitstart'] . "\" />";
    $html .= "\n</div>";

    return $html;
}

/**
 * Renders the pagination list
 *
 * @param   array  $list  Array containing pagination information
 *
 * @return  string  HTML markup for the full pagination object
 *
 * @since   3.0
 */
function pagination_list_render($list)
{
    // Calculate to display range of pages
    $currentPage = 1;
    $range = 1;
    $step = 5;
    foreach ($list['pages'] as $k => $page)
    {
        if (!$page['active'])
        {
            $currentPage = $k;
        }
    }
    if ($currentPage >= $step)
    {
        if ($currentPage % $step == 0)
        {
            $range = ceil($currentPage / $step) + 1;
        }
        else
        {
            $range = ceil($currentPage / $step);
        }
    }

    if(preg_match('#(<a.*?>.*?</a>)(<li>)#', $list['start']['data'])){
        $list['start']['data'] = preg_replace('#(<a.*?>.*?</a>)(<li>)#', '$1</li>', $list['start']['data']);
    }

    if(preg_match('#(<a.*?>.*?</a>)(<li>)#', $list['previous']['data'])){
        $list['previous']['data'] = preg_replace('#(<a.*?>.*?</a>)(<li>)#', '$1</li>', $list['previous']['data']);
    }

    if(preg_match('#(<a.*?>.*?</a>)(<li>)#', $list['next']['data'])){
        $list['next']['data'] = preg_replace('#(<a.*?>.*?</a>)(<li>)#', '$1</li>', $list['next']['data']);
    }

    if(preg_match('#(<a.*?>.*?</a>)(<li>)#', $list['end']['data'])){
        $list['end']['data'] = preg_replace('#(<a.*?>.*?</a>)(<li>)#', '$1</li>', $list['end']['data']);
    }

    //-----Hikashop----//
    if (preg_match('#(<span.*?>.*?</span>)#', $list['start']['data'])) {
        $list['start']['data'] = preg_replace('#(<span.*?>)(.*?)(</span>)#', '<li class="disabled"><a><i class="fa fa-angle-double-left"></i></a></li>', $list['start']['data']);
    }

    if (preg_match('#(<span.*?>.*?</span>)#', $list['previous']['data'])) {
        $list['previous']['data'] = preg_replace('#(<span.*?>)(.*?)(</span>)#', '<li class="disabled"><a><i class="fa fa-angle-left"></i></a></li>', $list['previous']['data']);
    }

    if (preg_match('#(<span.*?>.*?</span>)#', $list['next']['data'])) {
        $list['next']['data'] = preg_replace('#(<span.*?>)(.*?)(</span>)#', '<li class="disabled"><a><i class="fa fa-angle-right"></i></a></li>', $list['next']['data']);
    }

    if (preg_match('#(<span.*?>.*?</span>)#', $list['end']['data'])) {

        $list['end']['data'] = preg_replace('#(<span.*?>)(.*?)(</span>)#', '<li class="disabled"><a><i class="fa fa-angle-double-right"></i></a></li>', $list['end']['data']);
    }

    if (preg_match('#(<a class="pagenav hikashop_start_link".*?>.*?</a>)#', $list['start']['data'])) {

        $list['start']['data'] = preg_replace('#(<a.*?>)(.*?)(</a>)#', '<li>$1<i class="fa fa-angle-double-left"></i>$3</li>', $list['start']['data']);
    }

    if (preg_match('#(<a class="pagenav hikashop_previous_link".*?>.*?</a>)#', $list['previous']['data'])) {

        $list['previous']['data'] = preg_replace('#(<a.*?>)(.*?)(</a>)#', '<li>$1<i class="fa fa-angle-left"></i>$3</li>', $list['previous']['data']);
    }

    if (preg_match('#(<a class="pagenav hikashop_end_link".*?>.*?</a>)#', $list['end']['data'])) {

        $list['end']['data'] = preg_replace('#(<a.*?>)(.*?)(</a>)#', '<li>$1<i class="fa fa-angle-double-right"></i>$3</li>', $list['end']['data']);
    }

    if (preg_match('#(<a class="pagenav hikashop_next_link".*?>.*?</a>)#', $list['next']['data'])) {
        $list['next']['data'] = preg_replace('#(<a.*?>)(.*?)(</a>)#', '<li>$1<i class="fa fa-angle-right"></i>$3</li>', $list['next']['data']);
    }

    //-----Hikashop----//

    $html = '<ul>';
    $html .= $list['start']['data'];
    $html .= $list['previous']['data'];

    foreach($list['pages'] as $k => $page)
    {
        if(!$page['active']){
            if(version_compare(JVERSION,'3.0','ge')){
                if(preg_match('#<li.*?class=".*?disable.*?".*?>#', $page['data'],$match)){
                    $page['data']   = preg_replace('#(<li.*?class=".*?)(disable)(.*?".*?>.*?</li>)#','$1active$3',$page['data']);
                }
                else{
                    $page['data']   = preg_replace('#(<li)(.*?>.*?</li>)#','$1 class="active"$2',$page['data']);
                }
            }
            else{
                if(preg_match('#<li.*?class=".*?actived.*?".*?>#', $page['data'],$match)){
                    $page['data']   = preg_replace('#(<li.*?class=".*?)(actived)(.*?".*?>.*?</li>)#','$1active$3',$page['data']);
                }
                else{
                    $page['data']   = preg_replace('#(<li)(.*?>.*?</li>)#','$1 class="active"$2',$page['data']);
                }
            }
        }
        if(preg_match('#(<a.*?>.*?</a>)(<li>)#', $page['data'])){
            $page['data'] = preg_replace('#(<a.*?>.*?</a>)(<li>)#', '$1</li>', $page['data']);
        }

        //---- HikaShop----//

        if (preg_match('#(<a class=".*?)(" onclick=".*?>.*?</a>)#', $page['data'])) {
            $page['data'] = preg_replace('#(<a.*?>.*?</a>)#', '<li>$1</li>', $page['data']);
        }

        if (preg_match('#(<span.*?>)(.*?)(</span>)#', $page['data'])) {
            $page['data'] = preg_replace('#(<span.*?>)(.*?)(</span>)#', '<li class="active"><a>$2</a></li>', $page['data']);
        }
        //---- HikaShop----//

        if (in_array($k, range($range * $step - ($step + 1), $range * $step)))
        {
            if (($k % $step == 0 || $k == $range * $step - ($step + 1)) && $k != $currentPage && $k != $range * $step - $step)
            {
                $page['data'] = preg_replace('#(<a.*?>).*?(</a>)#', '$1...$2', $page['data']);
            }
        }


        $html .= $page['data'];
    }

    $html .= $list['next']['data'];
    $html .= $list['end']['data'];

    $html .= '</ul>';

    return $html;
}

/**
 * Renders an active item in the pagination block
 *
 * @param   JPaginationObject  $item  The current pagination object
 *
 * @return  string  HTML markup for active item
 *
 * @since   3.0
 */
function pagination_item_active(&$item)
{
    // Check for "Start" item
    if ($item->text == JText::_('JLIB_HTML_START'))
    {
        $display = '<i class="fa fa-angle-double-left"></i>';
    }

    // Check for "Prev" item
    if ($item->text == JText::_('JPREV'))
    {
        $display = '<i class="fa fa-angle-left"></i>';
    }

    // Check for "Next" item
    if ($item->text == JText::_('JNEXT'))
    {
        $display = '<i class="fa fa-angle-right"></i>';
    }

    // Check for "End" item
    if ($item->text == JText::_('JLIB_HTML_END'))
    {
        $display = '<i class="fa fa-angle-double-right"></i>';
    }

    // If the display object isn't set already, just render the item with its text
    if (!isset($display))
    {
        $display = $item->text;
    }

    return "<li><a title=\"" . $item->text . "\" href=\"" . $item->link . "\" class=\"pagenav skew25\">" . $display . "</a><li>";
}

/**
 * Renders an inactive item in the pagination block
 *
 * @param   JPaginationObject  $item  The current pagination object
 *
 * @return  string  HTML markup for inactive item
 *
 * @since   3.0
 */
function pagination_item_inactive(&$item)
{
    // Check for "Start" item
    if ($item->text == JText::_('JLIB_HTML_START'))
    {
        return '<li class="disabled"><a><i class="fa fa-angle-double-left"></i></a></li>';
    }

    // Check for "Prev" item
    if ($item->text == JText::_('JPREV'))
    {
        return '<li class="disabled"><a><i class="fa fa-angle-left"></i></a></li>';
    }

    // Check for "Next" item
    if ($item->text == JText::_('JNEXT'))
    {
        return '<li class="disabled"><a><i class="fa fa-angle-right"></i></a></li>';
    }

    // Check for "End" item
    if ($item->text == JText::_('JLIB_HTML_END'))
    {
        return '<li class="disabled"><a><i class="fa fa-angle-double-right"></i></a></li>';
    }

    // Check if the item is the active page
    if (isset($item->active) && ($item->active))
    {
        return '<li ><a>' . $item->text . '</a></li>';
    }

    // Doesn't match any other condition, render a normal item
    return '<li class="disabled"><a class="skew25">' . $item->text . '</a></li>';
}
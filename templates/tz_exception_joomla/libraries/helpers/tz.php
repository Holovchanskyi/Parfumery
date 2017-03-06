<?php
/**
 * Created by PhpStorm.
 * User: TuanMap
 * Date: 8/18/14
 * Time: 10:17 AM
 */

class JHtmlTz
{
    public static function getTag($id)
    {
        $db = JFactory::getDbo();
        $jquery_1 = $db->getQuery(true);
        $jquery_1->select('tag.name as tag_name, tag.id as tag_id,tagx.contentid as tagx_contentid');
        $jquery_1->from('#__tz_portfolio_tags_xref tagx');
        $jquery_1->join('left', '#__tz_portfolio_tags as tag on tagx.tagsid = tag.id');
        $jquery_1->join('left', '#__content as ct on tagx.contentid = ct.id');
        $jquery_1->where('tag.published = 1');
        $jquery_1->order('ct.id asc');
        $jquery_1->where("ct.catid IN($id)");
        $db->setQuery($jquery_1);
        $tags = $db->loadObjectList();
        $data = array();

        foreach ($tags as $i => $tag):
            $data[$tag->tagx_contentid][] = $tag;
        endforeach;
        return $data;
    }


    public static function getCate($id)
    {
        $db = JFactory::getDbo();
        $jquery_1 = $db->getQuery(true);
        $jquery_1->select('cats.title as cat_title, cats.id as cat_id, cats.description as cat_desc, cats.id as cat_id');
        $jquery_1->from('#__categories as cats');
        $jquery_1->where('cats.published = 1 ');
        $jquery_1->where("cats.id = $id");
        $db->setQuery($jquery_1);
        $cate = $db->loadObject();
        return $cate;
    }

    public static function getTagSingle($id)
    {
        $db = JFactory::getDbo();
        $jquery_1 = $db->getQuery(true);
        $jquery_1->select('tag.name as tag_name, tag.id as tag_id,tagx.contentid as tagx_contentid');
        $jquery_1->from('#__tz_portfolio_tags_xref tagx');
        $jquery_1->join('left', '#__tz_portfolio_tags as tag on tagx.tagsid = tag.id');
        $jquery_1->join('left', '#__content as ct on tagx.contentid = ct.id');
        $jquery_1->where('tag.published = 1');
        $jquery_1->order('ct.id asc');
        $jquery_1->where("ct.id=$id");
        $db->setQuery($jquery_1);
        $tags = $db->loadObjectList();

        return $tags;
    }

    public static function CountArticle($id)
    {
        $db = JFactory::getDbo();
        $jquery_1 = $db->getQuery(true);
        $jquery_1->select('count(id) as countID');
        $jquery_1->from('#__content as ct');
        $jquery_1->where('ct.state = 1');
        $jquery_1->where("ct.catid in($id)");
        $db->setQuery($jquery_1);
        $tags = $db->loadObjectList();

        return $tags;
    }

    public static function  getTypeArticle($id)
    {
        $db = JFactory::getDbo();
        $jquery_1 = $db->getQuery(true);
        $jquery_1->select('ctx.type as type');
        $jquery_1->from('#__tz_portfolio_xref_content as ctx');
        $jquery_1->where("ctx.contentid =$id");
        $db->setQuery($jquery_1);

        $tags = $db->loadObject();
        return $tags;
    }

    public static function getQuote($id)
    {
        $db = JFactory::getDbo();
        $jquery_1 = $db->getQuery(true);
        $jquery_1->select('ctx.quote_author as author, ctx.quote_text as text');
        $jquery_1->from('#__tz_portfolio_xref_content as ctx');
        $jquery_1->where('ctx.type = "quote"');
        $jquery_1->where("ctx.contentid =$id");
        $db->setQuery($jquery_1);

        $tags = $db->loadObject();
        return $tags;
    }

    public static function getBrand($id)
    {
        $db = JFactory::getDbo();
        $jquery_1 = $db->getQuery(true);
        $jquery_1->select('hct.category_name as name');
        $jquery_1->from('#__hikashop_category as hct');
        $jquery_1->where('hct.category_type = "manufacturer"');
        $jquery_1->where("hct.category_id =$id");
        $db->setQuery($jquery_1);

        $tags = $db->loadObject();
        return $tags;
    }

    public static function getJComment( &$params )
    {
        $db = JFactory::getDBO();
        $user = JFactory::getUser();

        $source = $params->get('source', 'com_content');
        if (!is_array($source)) {
            $source = explode(',', $source);
        }

        $date = JFactory::getDate();

        if (version_compare(JVERSION,'1.6.0','ge')) {
            $now = $date->toSql();
            $access = array_unique(JAccess::getAuthorisedViewLevels($user->get('id')));
            $access[] = 0; // for backward compability
        } else {
            $now = $date->toMySQL();
            $access = $user->get('aid', 0);
        }

        $where = array();

        $where[] = 'c.published = 1';
        $where[] = 'c.deleted = 0';
        $where[] = "o.link <> ''";
        $where[] = (is_array($access) ? "o.access IN (" . implode(',', $access) . ")" : " o.access <= " . (int) $access);

        if (JCommentsMultilingual::isEnabled()) {
            $where[] = 'o.lang = ' . $db->Quote(JCommentsMultilingual::getLanguage());
        }

        $joins = array();

        if (count($source) == 1 && $source[0] == 'com_content') {
            $joins[] = 'JOIN #__content AS cc ON cc.id = o.object_id';
            $joins[] = 'LEFT JOIN #__categories AS ct ON ct.id = cc.catid';

            $where[] = "c.object_group = " . $db->Quote($source[0]);
            $where[] = "(cc.publish_up = '0000-00-00 00:00:00' OR cc.publish_up <= '$now')";
            $where[] = "(cc.publish_down = '0000-00-00 00:00:00' OR cc.publish_down >= '$now')";

            $categories = $params->get('catid', array());
            if (!is_array($categories)) {
                $categories = explode(',', $categories);
            }

            JArrayHelper::toInteger($categories);

            $categories = implode(',', $categories);
            if (!empty($categories)) {
                $where[] = "cc.catid IN (" . $categories . ")";
            }
        } else if (count($source)) {
            $where[] = "c.object_group in ('" . implode("','", $source) . "')";
        }

        $query = "SELECT o.id, o.title, o.link, c.name, c.date"
            . ", COUNT(c.id) AS commentsCount, MAX(c.date) AS commentdate"
            . " FROM #__jcomments_objects AS o"
            . " JOIN #__jcomments AS c ON c.object_id = o.object_id AND c.object_group = o.object_group AND c.lang = o.lang"
            . (count($joins) ? ' ' . implode(' ', $joins) : '')
            . (count($where) ? ' WHERE  ' . implode(' AND ', $where) : '')
            . " GROUP BY o.id, o.title, o.link"
            . " ORDER BY commentdate DESC"
        ;

        $db->setQuery($query, 0, $params->get('count'));
        $list = $db->loadObjectList();
        return $list;
    }


}
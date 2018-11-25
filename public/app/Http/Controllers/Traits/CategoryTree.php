<?php

namespace App\Http\Controllers\Traits;

use App\Models\Category;

trait CategoryTree
{
    public static function getCategories()
    {
        $categories = Category::all();
        $newarray = $categories->toArray();
        $tree = self::buildTree($newarray);

        return $tree;
    }

    public static function buildTree(array $elements, $parentId = 0, $level = 0)
    {
        $branch = array();
        $level_ini = $level;

        foreach ($elements as $element) {
            $level = $level_ini;
            if ($element['parent'] == $parentId) {
                $element ['level'] = $level;
                $children = self::buildTree($elements, $element['id'], ++$level);
                if ($children) {
                    $element['childs'] =  $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
}

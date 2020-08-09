<?php

$dbConn = mysqli_connect('localhost', 'root', 'root', 'roytuts') or die('MySQL connect failed. ' . mysqli_connect_error());

//select all rows from the category table
$result = mysqli_query($dbConn,"SELECT
	category_id, category_name, category_link, parent_id, sort_order
	FROM category
	ORDER BY parent_id, sort_order, category_name");

//create a multidimensional array to hold a list of category and parent category
$category = array(
	'categories' => array(),
	'parent_cats' => array()
);

//build the array lists with data from the category table
while ($row = mysqli_fetch_assoc($result)) {
	//creates entry into categories array with current category id ie. $categories['categories'][1]
	$category['categories'][$row['category_id']] = $row;
	//creates entry into parent_cats array. parent_cats array contains a list of all categories with children
	$category['parent_cats'][$row['parent_id']][] = $row['category_id'];
}

function buildCategory($parent, $category) {
	$html = "";
	if (isset($category['parent_cats'][$parent])) {
		$html .= "<ul>\n";
		foreach ($category['parent_cats'][$parent] as $cat_id) {
			if (!isset($category['parent_cats'][$cat_id])) {
				$html .= "<li>\n  <a href='" . $category['categories'][$cat_id]['category_link'] . "'>" . $category['categories'][$cat_id]['category_name'] . "</a>\n</li> \n";
			}
			if (isset($category['parent_cats'][$cat_id])) {
				$html .= "<li>\n  <a href='" . $category['categories'][$cat_id]['category_link'] . "'>" . $category['categories'][$cat_id]['category_name'] . "</a> \n";
				$html .= buildCategory($cat_id, $category);
				$html .= "</li> \n";
			}
		}
		$html .= "</ul> \n";
	}
	return $html;
}


echo buildCategory(0, $category);
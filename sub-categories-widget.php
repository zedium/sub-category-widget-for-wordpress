<?php
/*
Plugin Name: Sub Categories Widget
Description: This Widget lists the sub-categories for a given category.
Author: BrokenCrust
Version: 0.1
Author URI: http://brokencrust.com/
Plugin URI: http://brokencrust.com/plugins/sub-categories-widget/
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

class SubCategoriesWidget extends WP_Widget {

	function SubCategoriesWidget() {
		$widget_ops = array('classname' => 'widget_sub_categories', 'description' => __('Lists the sub-categories for a given category.', 'sub_categories') );
		$this->WP_Widget('sub_categories_widget', __('Sub Categories', 'sub_categories'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		$category_id = empty($instance['category_id']) ? 1 : $instance['category_id'];
		$use_cat_title = empty($instance['use_cat_title']) ? 0 : $instance['use_cat_title'];
		$hide_empty_cats = empty($instance['hide_empty_cats']) ? 0 : $instance['hide_empty_cats'];
		$show_post_count = empty($instance['show_post_count']) ? 0 : $instance['show_post_count'];
		$title_link = empty($instance['title_link']) ? 0 : $instance['title_link'];

		if ($use_cat_title) {
			$title = apply_filters('widget_title', get_cat_name($category_id), $instance, $this->id_base);	
		} else {
			$title = apply_filters('widget_title', empty($instance['title'] ) ? __('Sub Categories', 'sub_categories') : $instance['title'], $instance, $this->id_base);
		}

		$subs = get_categories(array('parent' => $category_id, 'hide_empty' => $hide_empty_cats, 'show_count' => $show_post_count));

		if (!empty($subs)) {

			echo $before_widget;
			
			if ($title_link) {
				echo $before_title.'<a href="'.get_category_link($category_id).'">'.$title.'</a>'.$after_title;
			} else {
				echo $before_title.$title.$after_title;
			}
			
			echo '<ul>';
			
			foreach ($subs as $s => $values) {
				echo '<li><a href="'.get_category_link($subs[$s]->cat_ID).'">'.$subs[$s]->name.'</a>';
				if ($show_post_count) { echo ' ('.$subs[$s]->count.')'; }
				echo '</li>';
			}
			echo '</ul>';
			echo $after_widget;
		}
	}

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = trim(strip_tags($new_instance['title']));
		$instance['category_id'] = (int) $new_instance['category_id'];
		$instance['use_cat_title'] = (int) $new_instance['use_cat_title'];
		$instance['hide_empty_cats'] = (int) $new_instance['hide_empty_cats'];
		$instance['show_post_count'] = (int) $new_instance['show_post_count'];
		$instance['title_link'] = (int) $new_instance['title_link'];

		return $instance;
	}

	function form($instance) {

		$instance = wp_parse_args((array) $instance, array('title' => __('Sub Categories', 'sub_categories'), 'category_id' => 1, 'use_cat_title' => 0, 'hide_empty_cats' => 0, 'show_post_count' => 1, 'title_link' => 0));

		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'sub_categories'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($instance['title']) ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('category_id'); ?>"><?php _e('Parent Category:', 'sub_categories'); ?></label>
				<select id="<?php echo $this->get_field_id('category_id'); ?>" name="<?php echo $this->get_field_name('category_id'); ?>">
					<?php
						$categories = get_categories(array('hide_empty' => 0));
						foreach ($categories as $cat) {
							if ($cat->cat_ID == $instance['category_id']) {
								$option = '<option selected="selected" value="'.$cat->cat_ID.'">';
							} else {
								$option = '<option value="'.$cat->cat_ID.'">';
							}
							$option .= $cat->cat_name.'</option>';
							echo $option;
						}
					?>
				</select>
			</p>
			<p>
				<input id="<?php echo $this->get_field_id('use_cat_title'); ?>" name="<?php echo $this->get_field_name('use_cat_title'); ?>" type="checkbox" value="1" <?php if ($instance['use_cat_title']) echo 'checked="checked"'; ?>/>
				<label for="<?php echo $this->get_field_id('use_cat_title'); ?>"><?php _e('Use Parent Cat as Title?', 'sub_categories'); ?></label>
			</p>
			<p>
				<input id="<?php echo $this->get_field_id('show_post_count'); ?>" name="<?php echo $this->get_field_name('show_post_count'); ?>" type="checkbox" value="1" <?php if ($instance['show_post_count']) echo 'checked="checked"'; ?>/>
				<label for="<?php echo $this->get_field_id('show_post_count'); ?>"><?php _e('Show Post Count?', 'sub_categories'); ?></label>
			</p>
			<p>
				<input id="<?php echo $this->get_field_id('hide_empty_cats'); ?>" name="<?php echo $this->get_field_name('hide_empty_cats'); ?>" type="checkbox" value="1" <?php if ($instance['hide_empty_cats']) echo 'checked="checked"'; ?>/>
				<label for="<?php echo $this->get_field_id('hide_empty_cats'); ?>"><?php _e('Hide Empty Sub-Categories?', 'sub_categories'); ?></label>
			</p>
			<p>
				<input id="<?php echo $this->get_field_id('title_link'); ?>" name="<?php echo $this->get_field_name('title_link'); ?>" type="checkbox" value="1" <?php if ($instance['title_link']) echo 'checked="checked"'; ?>/>
				<label for="<?php echo $this->get_field_id('title_link'); ?>"><?php _e('Add Parent Cat Link to Title?', 'sub_categories'); ?></label>
			</p>
			<p>
		<?php
	}
}

add_action('widgets_init', create_function('', 'return register_widget("SubCategoriesWidget");'));

?>

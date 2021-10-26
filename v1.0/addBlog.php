<?php
	
	if(isset($_POST['btn'])){

		require_once 'Blog.php';
		$blog = new Blog();
		$insert = $blog->saveBlog($_POST);

		echo '<h1>'.$insert.'</h1>';
	}
?>

<hr/>
<a href="addBlog.php">Add Blog</a>
<a href="viewBlog.php">View Blog</a>
<hr/>

<form action="" method="post">
	<table>
		<tr>
			<td>Blog Title</td>
			<td><input type="text" name="blog_title"></td>
		</tr>

		<tr>
			<td>Author Name</td>
			<td><input type="text" name="author_name"></td>
		</tr>

		<tr>
			<td>Blog Description</td>
			<td><textarea name="description" rows="5" cols="30"></textarea></td>
		</tr>

		<tr>
			<td>Publication status</td>
			<td>
				<select name="publication_status">
					<option value="1">Published</option>
					<option value="0">UnPublished</option>
				</select>
			</td>
		</tr>

		<tr>
			<td></td>
			<td><input type="submit" name="btn" value="Save"></td>
		</tr>
	</table>
</form>
<?php 
	$id =  $_GET['id'];

	require_once 'Blog.php';
	$blog = new Blog();

	$result = $blog->selectBlogByID($id);

	$blogInfo = mysqli_fetch_assoc($result);

	// echo '<pre>';
	// print_r($blogInfo);

	if(isset($_POST['btn'])){

		$update = $blog->updateBlog($_POST,$id);

		echo '<h1>'.$update.'</h1>';
	}

?>



<hr/> 
<a href="addBlog.php">Add Blog</a>
<a href="viewBlog.php">View Blog</a>
<hr/>

<form action="" method="post" name="editBlogForm">
	<table>
		<tr>
			<td>Blog Title</td>
			<td><input type="text" name="blog_title" value="<?php echo $blogInfo['blog_title'] ?>" ></td>
		</tr>

		<tr>
			<td>Author Name</td>
			<td><input type="text" name="author_name" value="<?php echo $blogInfo['author_name'] ?>" ></td>
		</tr>

		<tr>
			<td>Blog Description</td>
			<td><textarea name="description" rows="5" cols="30"><?php echo $blogInfo['description'] ?></textarea></td>
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
			<td><input type="submit" name="btn" value="Update"></td>
		</tr>
	</table>
</form>

<script>
	document.forms['editBlogForm'].elements['publication_status'].value="<?php echo $blogInfo['publication_status']; ?>"
</script>

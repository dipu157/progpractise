<?php
	
	require_once 'Blog.php';
	$blog = new Blog();
	$get = $blog->getBlog();

	if(isset($_GET['btn'])){

		$id = $_GET['id'];

		$delete = $blog->deleteBlogByID($id);
	}

?>

<hr/>
<a href="addBlog.php">Add Blog</a>
<a href="viewBlog.php">View Blog</a>
<hr/>

<table border="1">
	<tr>
		<th>Blog ID</th>
		<th>Blog Title</th>
		<th>Author Name</th>
		<th>Description</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	<?php while ($blog = mysqli_fetch_assoc($get)) { ?>
	<tr>
		<td><?php echo $blog['id'] ?></td>
		<td><?php echo $blog['blog_title'] ?></td>
		<td><?php echo $blog['author_name'] ?></td>
		<td><?php echo $blog['description'] ?></td>
		<td><?php echo $blog['publication_status'] == 1 ? "Pblished" : "UnPublished" ?></td>
		<td>
			<a href="editBlog.php?id=<?php echo $blog['id'] ?>">Edit</a>
			<a href="?btn=delete&id=<?php echo $blog['id']?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
		</td>
	</tr>
<?php } ?>
</table>
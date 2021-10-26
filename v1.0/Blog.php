<?php
 /**
  * 
  */
 class Blog
 {
 	
 	private $link;

 	function __construct()
 	{
 		$this->link = mysqli_connect('localhost','root','','rawPHP');
 	}

 	public function queryExecute($sql,$status=null){

 		if(mysqli_query($this->link,$sql)){
 			if($status){
 				$result = mysqli_query($this->link,$sql);
 			 	return $result;
 			}else{
 				$msg = "Operation Successfull";
 			return $msg;
 			}
 			
 		}else{
 			die("Query Problem".mysqli_error($this->link));
 		}

 	}

 	function saveBlog($data){


 		$SQL = "insert into blog(blog_title,author_name,description,publication_status) values ('$data[blog_title]', '$data[author_name]', '$data[description]', '$data[publication_status]')";

 		$result = $this->queryExecute($SQL);
 		return $result;
 		

 		
 	}

 	function getBlog(){

 		
 		$SQL = "select * from blog";
 		$status = "Get Value";

 		$msg = $this->queryExecute($SQL,$status);
 		return $msg;
 		// if(mysqli_query($this->link,$SQL)){
 		// 	$result = mysqli_query($this->link,$SQL);
 		// 	return $result;
 		// }else{
 		// 	die("Query Problem".mysqli_error($this->link));
 		// }
 	}

 	function selectBlogByID($id){


 		$SQL = "select * from blog where id='$id'";

 		$status = "Get Value";

 		$msg = $this->queryExecute($SQL,$status);
 		return $msg;
 	}

 	function updateBlog($data,$id){


 		$SQL = "update blog set blog_title = '$data[blog_title]',author_name = '$data[author_name]',description = '$data[description]',publication_status = '$data[publication_status]' where id='$id'";

 		$this->queryExecute($SQL);
 		header('Location:viewBlog.php');
 	}


 	function deleteBlogByID($id){


 		$SQL = "delete from blog where id='$id'";

 		//$status = "Get Value";

 		$msg = $this->queryExecute($SQL);
 		header('Location:viewBlog.php');
 	}
 }
?>
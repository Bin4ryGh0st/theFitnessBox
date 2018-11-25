function writeBlog()
{
	document.getElementById('blogsDisplay').style='display: none;';
	document.getElementById('writeBlog').style='display: block;';
	document.getElementById('guide').innerHTML='&#10010; Discover new blogs.';
	//alert(document.getElementById('newBlog').onclick);
	document.getElementById('newBlog').onclick=function onclick(event) {discoverBlogs();};
	//alert(document.getElementById('newBlog').onclick);
}

function discoverBlogs()
{
	document.getElementById('blogsDisplay').style='display: block;';
	document.getElementById('writeBlog').style='display: none;';
	document.getElementById('guide').innerHTML='&#9997; Write Your blog.';
	document.getElementById('newBlog').onclick=function onclick(event) {writeBlog();};
}

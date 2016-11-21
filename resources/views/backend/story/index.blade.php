<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		.pagination li, .pagination li a {
			display: inline-block;
			padding: 5px;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<th>id</th>
			<th>Chapter</th>
			<th>Number</th>
			<th>Title</th>
			<th>Slug</th>
			<th>Category</th>
			<th>Tag</th>
			<th></th>
		</tr>

		@foreach($stories as $story)
			<tr>
             <td>{{ $story->id }}</td>
             <td>{{ $story->chapter }}</td>
             <td>{{ $story->number }}</td>
             <td>{{ $story->title }}</td>
             <td>{{ $story->slug }}</td>
             <td>{{ $story->categories->name }}</td>
             <td>{{ $story->tags->name }}</td>
             <td>
             	<a href="{{url('story',$story->id)}}" class="btn btn-primary">Read</a>
             	<a href="{{route('story.edit',$story->id)}}" class="btn btn-warning">Update</a>
         	</td>
         </tr>
		@endforeach
		<tr>
			<td colspan="7">{{ $stories->links() }}</td>
		</tr>
	</table>
</body>
</html>
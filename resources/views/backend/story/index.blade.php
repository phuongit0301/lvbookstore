@extends('backend.layouts.index')

@section('content')

    <h1>List Story</h1>

    {!! link_to_route('admin.management.story.create', 'Add a new one', [], ['class' => 'btn btn-primary']) !!}

	<table class="table">
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
             	{!! link_to_route('admin.management.story.show', 'View', [$story->id], ['class' => 'btn btn-info']) !!}
                {!! link_to_route('admin.management.story.edit', 'Edit', [$story->id], ['class' => 'btn btn-primary']) !!}
                {!! Form::open(['method' => 'DELETE', 'route' => ['admin.management.story.destroy', $story->id]]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
         	</td>
         </tr>
		@endforeach
		<tr>
			<td colspan="7">{{ $stories->links() }}</td>
		</tr>
	</table>

@endsection
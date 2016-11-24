<div class="form-group">
    {!! Form::label('Categories', 'Categories:') !!}
    {!! Form::select('parent_id', $listCategories, !empty($category->parent_id) ? $category->parent_id : null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('Name', 'Name:') !!}
    {!! Form::text('name', !empty($category->name) ? $category->name : null,['class'=>'form-control', 'id' => 'name']) !!}
</div>
<div class="form-group">
    {!! Form::label('Slug', 'Slug:') !!}
    {!! Form::text('slug', !empty($category->slug) ? $category->slug : null,['class'=>'form-control', 'id' => 'slug']) !!}
</div>
<div class="form-group">
    {!! Form::label('Description', 'Description:') !!}
    {!! Form::text('description', !empty($category->description) ? $category->description : null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('Order', 'Order:') !!}
    {!! Form::text('sort', !empty($category->sort) ? $category->sort : null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {!! link_to_route('admin.management.category.index', 'Go Back', [], ['class' => 'btn btn-info']) !!}
    {!! Form::submit($label, ['class' => 'btn btn-primary']) !!}
</div>
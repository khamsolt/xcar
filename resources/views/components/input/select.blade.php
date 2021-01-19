<select name="{{ !empty($name) ? $name : 'name' }}" class="form-control">
    <option @if(empty($id)) selected @endif>@lang('None')</option>
    @foreach($collection as $item)
        <option value="{{ $item->id }}" @if(!empty($id) && $item->id === $id) selected @endif>{{ $item->name }}</option>
    @endforeach
</select>

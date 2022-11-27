<div>
    <h5 class="mb-4 text-sm 2xl:text-md font-bold">{{ $filter->title() }}</h5>

    @foreach($filter->values() as $id => $title)
        <div class="form-checkbox">
            <input name="{{ $filter->name($id) }}"
                   type="checkbox"
                   value="{{ $id }}"
                   @checked($filter->requestValue($id))
                   id="{{ $filter->id($id) }}"
            >

            <label for="{{ $filter->id($id) }}" class="form-checkbox-label">
                {{ $title }}
            </label>
        </div>
    @endforeach
</div>
@forelse($data as $item)
    <div class="application-item">
        <div class="title">
            {{__('Application ' . $item->id)}}
        </div>
        <div class="status">
            {{\App\Enums\StatusesEnum::all()[$item->status]}}
        </div>
        <div class="actions">
            <a class="edit-item" href="{{route('applications.edit', $item->id)}}">
                <i class="bi bi-pencil-square"></i>
            </a>
{{--            <a class="delete-item" href="{{route('applications.destroy', $item->id)}}">--}}
{{--                <i class="bi bi-trash"></i>--}}
{{--            </a>--}}
        </div>
    </div>
@empty
@endforelse
@if($showBtn)
    @include('website.partials.load-more', [
      'url' => route('load_more'),
      'content' => 'application-items',
      'item' => 'application-item',
      'model' => 'Application',
      'id' => null,
      'method' => 'list',
      'limit' => 10
    ])
@endif

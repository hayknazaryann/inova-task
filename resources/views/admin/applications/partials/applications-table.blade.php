<table class="table">
    <thead>
    <tr>
        <th scope="col" width="10%">ID</th>
        <th scope="col" width="20%">User</th>
        <th scope="col" width="50%">Text</th>
        <th scope="col" width="20%">Status</th>
    </tr>
    </thead>
    <tbody>
    @forelse($applications as $application)

        <tr>
            <th scope="row">{{ $application->id }}</th>
            <td>
                {{$application->user ? $application->user->name : ''}}
            </td>
            <td>
                {{$application->text}}
            </td>
            <td>
                <select class="form-select status-select" data-url="{{route('admin.applications.status', $application->id)}}">
                    <option value="">---</option>
                    @forelse(\App\Enums\StatusesEnum::all() as $key => $text)
                        <option value="{{$key}}" {{$application->status == $key ? 'selected' : ''}}>
                            {{$text}}
                        </option>
                    @empty
                    @endforelse
                </select>
            </td>
        </tr>
    @empty
        <tr>
            <td class="text-center" colspan="4">
                Empty data
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
<div class="categories_pagination justify-content-center">
    {!! $applications->links('admin.partials.pagination') !!}
</div>

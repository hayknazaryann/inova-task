@component('website.layouts.app')
    @section('css')
        <link rel="stylesheet" href="{{asset('website/css/applications.css')}}?ver={{ filemtime(public_path('website/css/applications.css')) }}">
    @endsection
    @section('content')
        <div class="page-content container">
            <div class="page-row">
                <div class="form-content">
                    <form action="{{route('applications.store')}}" id="applications-form">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="textarea-content">
                            <textarea
                                name="text" id="text"
                                placeholder="{{__('Write your note here')}}"
                            ></textarea>
                        </div>
                        <div class="form-row">
                            <button type="button" class="apply-btn" id="send">
                                {{__('Send')}}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="applications-list">
                    <div class="application-search">
                        <div class="input-content">
                            <input type="text" name="keyword" id="keyword" placeholder="Search by text and status">
                        </div>
                        <div class="status-content">
                            <select class="form-select status-select" id="status">
                                <option value="">Status</option>
                                @forelse(\App\Enums\StatusesEnum::all() as $key => $text)
                                    <option value="{{$key}}">
                                        {{$text}}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>

                    </div>
                    <div class="application-items" data-url="{{route('applications.load')}}">

                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script src="{{asset('website/js/applications.js')}}?ver={{ filemtime(public_path('website/js/applications.js')) }}" defer></script>
    @endsection
@endcomponent

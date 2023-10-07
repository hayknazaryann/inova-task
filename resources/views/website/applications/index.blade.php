@component('website.layouts.app')
    @section('css')
        <link rel="stylesheet" href="{{asset('website/css/applications.css')}}?ver={{ filemtime(public_path('website/css/applications.css')) }}">
    @endsection
    @section('content')
        <div class="page-content container">
            <div class="page-row">
                <div class="form-content">
                    <form action="{{route('applications.store')}}" id="applications-form">
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
                    <div class="application-items">
                        @for($i=1; $i<=10; $i++)
                            <div class="application-item">
                                {{__('Application ' . $i)}}
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        <script src="{{asset('website/js/applications.js')}}?ver={{ filemtime(public_path('website/js/applications.js')) }}" defer></script>
    @endsection
@endcomponent

<x-app-layout title="{{ $page->title }}">
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                @if (auth()->user()->is_admin == 1)
                                    <strong class="text-primary">
                                        Hello
                                    </strong>
                                    {{ __(user()->name . '  ' . 'Admin') }}
                                @elseif (auth()->user()->is_admin == 0)
                                    <strong class="text-primary">
                                        Hello
                                    </strong>
                                    {{ user()->name }}
                                @else
                                    {{ __('Bienvenue sur la boite à outils') }}
                                @endif
                            </h5>
                            <p class="mb-4">
                                <span class="fw-bold">
                                    {!! $page->content !!}
                                </span>
                                <span class="fw-bold">
                                    {{ __('Outils Assistant RH') }}
                                </span>
                                {{ __(' est une application qui vous sert d\'une boîte outils RH, permettant d\'organiser vos tâches, et de planifier selon la disponiblité de vos créneaux , ') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

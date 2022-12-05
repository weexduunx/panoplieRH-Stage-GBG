<x-app-layout title="Tableau de bord Administrateur">
	@if (session('message'))
	<div class="alert alert-success alert-dismissible" role="alert">
		{{ session('message') }}
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
		</button>
	  </div>
	@endif
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                {{ __('Bienvenue ' . 'Admin' . ' ' . user()->name . ' ') }}
                            </h5>
                            <p class="mb-4">
                                <span class="fw-bold">
                                    {{ __('Outils Assistant RH') }}
                                </span>
                                {{ __(' est une application qui vous sert d\'une boîte outils RH, permettant d\'organiser vos tâches,vle CVthéque et planifier selon vos créneau , ') }}
                            </p>

                            <a href="javascript:;" class="btn btn-sm btn-outline-primary">
                                {{ __('Voir le profil') }}
                            </a>
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

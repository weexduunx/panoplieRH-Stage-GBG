<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{ asset('assets/img/Logo_gbg.png') }}" alt="" height="35">
            </span> |
            <span class=" demo menu-text fw-bolder ms-2" style="line-height: 18px; font-size:17px">
                {{-- {{ config('app.name') }} --}}
                Panoplie <br> Com & RH
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        @if (auth()->user()->is_admin == true)
            <li class="menu-item {{ menuIsActive('welcome') }}">
                <a href="{{ route('welcome') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>
                        {{ __('Espace Administrateur') }}
                    </div>
                </a>
            </li>
        @elseif(auth()->user()->is_admin == false)
            <li class="menu-item {{ menuIsActive('welcome') }}">
                <a href="{{ route('welcome') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-home-circle"></i>
                    <div>
                        {{ __('Espace Utilisateur') }}
                    </div>
                </a>
            </li>
        @endif

        @if (auth()->user()->is_admin)

            <li class="menu-item {{ menuIsActive('admin.agenda') }}">
                <a href="{{ route('admin.agenda') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-calendar"></i>
                    <div>
                        {{ __('Agenda') }}
                    </div>
                </a>
            </li>
            <li class="menu-header small text-uppercase ">
                <span class="menu-header-text">
                    {{ __('Gestion des Pages') }}
                </span>
            </li>
            @foreach (\App\Models\Page::all() as $page)
                <li class="menu-item ">
                    <a href="{{ route('admin.pageEdit', $page) }}" class="menu-link">
                        <i class='menu-icon tf-icons bx bx-spreadsheet'></i>
                        <div>
                            {{ $page->title }}
                        </div>
                    </a>
                </li>
            @endforeach

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">
                    {{ __('Gestion des tâches') }}
                </span>
            </li>
            @foreach ($admin_menu as $group)
                <li class="menu-item {{ menuIsActive('users.checklist_groups.index') }}">
                    <a href="{{ route('admin.checklist_groups.edit', $group->id) }}" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-folder-open"></i>
                        <div>{{ $group->nom }}</div>
                    </a>
                    <ul class="menu-sub">
                        @foreach ($group->checklists as $key)
                            <li class="menu-item">
                                <a href="{{ route('admin.checklist_groups.checklists.edit', [$group, $key]) }}"
                                    class="menu-link">
                                    <i class="menu-icon tf-icons bx bx-list-plus bx-tada"></i>
                                    <div>{{ $key->nom }}</div>
                                </a>
                            </li>
                        @endforeach
                        <li class="menu-item  {{ menuIsActive('users.checklist_groups.create') }}">
                            <a href="{{ route('admin.checklist_groups.checklists.create', $group) }}"
                                class="menu-link">
                                <i class="menu-icon tf-icons bx bx-list-check"></i>
                                <div>{{ __('Nouveau Checklist') }}</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endforeach
            <li class="menu-item  {{ menuIsActive('admin.checklist_groups.create') }}">
                <a href="{{ route('admin.checklist_groups.create') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-list-ul"></i>
                    <div>{{ __('Ajouter un groupe de checklist') }}</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">
                    {{ __('Gestion des Utilisateurs') }}
                </span>
            </li>

            <li class="menu-item {{ menuIsActive('admin.users.*') }}">
                <a href="{{ route('admin.users.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="User management">
                        {{ __('Gestion des utilisateurs') }}
                    </div>
                </a>
            </li>
            @permission('viewsidebar')
                <li class="menu-item" style="">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-check-shield"></i>
                        <div data-i18n="Roles &amp; Permissions">Rôles &amp; Permissions</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="{{ route('laravelroles::roles.index') }}" class="menu-link">
                                <div data-i18n="Roles">Rôles</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('laravelroles::permissions.index') }}" class="menu-link">
                                <div data-i18n="Permission">Permission</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endpermission
        @else
            @foreach ($user_taches_menu as $key => $user_taches_menu )
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon tf-icons {{ $user_taches_menu['icon'] }}"></i>
                        {{ $user_taches_menu['name'] }}
                        @livewire('user-tasks-counter', [
                            'task_type' => $key,
                            'tasks_count' => $user_taches_menu['tasks_count'],
                        ])
                    </a>
                </li>
            @endforeach
            @foreach ($user_menu as $group)
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">
                        {{ $group['nom'] }}
                    </span>
                    @if ($group['is_new'])
                        <span class=" badge rounded-pill bg-info ">
                            {{ __('New') }}
                        </span>
                    @elseif($group['is_updated'])
                        <span class=" badge rounded-pill bg-success  ">
                            {{ __('Màj') }}
                        </span>
                    @endif
                </li>
                @foreach ($group['checklists'] as $checklist)
                    <li class="menu-item">
                        <a href="{{ route('users.checklists.show', [$checklist['id']]) }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-list-plus bx-tada"></i>
                            <div>
                                {{ $checklist['nom'] }}

                                @livewire('completed-tasks-counter', [
                                    'completed_tasks' => count($checklist['user_taches']),
                                    'tasks_count' => count($checklist['taches']),
                                    'checklist_id' => $checklist['id']
                                ])
                                @if ($checklist['is_new'])
                                    <span class=" badge rounded-pill bg-info ">
                                        {{ __('New') }}
                                    </span>
                                @elseif($checklist['is_updated'])
                                    <span class=" badge rounded-pill bg-primary  ">
                                        {{ __('Màj') }}
                                    </span>
                                @endif

                            </div>
                        </a>
                    </li>
                @endforeach
            @endforeach
        @endif
    </ul>
</aside>

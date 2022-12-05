<x-app-layout title="Todo List">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Les tâches à faire - TAF') }}
            </h5>

            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header sama-bg d-flex align-items-center justify-content-between">
                        </div>
                        <div>
                            @livewire('create-task')

                        </div>
                        <div class="card-body">
                            @livewire('edit-task')
                        </div>
                    </div>
                </div>

                <!-- Basic with Icons -->
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header bg-label-success d-flex align-items-center justify-content-between">
                        </div>
                        <div>
                            @livewire('index-tasks')
                        </div>
                    </div>
                </div>
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header bg-success d-flex align-items-center justify-content-between">
                        </div>
                        <div>
                            @livewire('completed-tasks')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

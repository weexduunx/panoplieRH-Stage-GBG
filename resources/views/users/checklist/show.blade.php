<x-app-layout title="Liste des tâches">
	@livewire('header-total-count', ['checklist_group_id' => $checklist->checklist_group_id])
	@livewire('checklist-show', ['checklist' => $checklist])
</x-app-layout>

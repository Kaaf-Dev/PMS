const contract_new_element = document.getElementById('modal_contract_new');
const contract_new_modal = new bootstrap.Modal(contract_new_element);

Livewire.on('show-contract-new-modal', params => {
    contract_new_modal.show();
})

Livewire.on('hide-contract-new-modal', () => {
    contract_new_modal.hide();
})


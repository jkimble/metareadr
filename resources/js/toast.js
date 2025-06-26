document.addEventListener('DOMContentLoaded', () => {
    Livewire.on('notify', (data) => {
        window.dispatchEvent(new CustomEvent('notify', {
            detail: {
                message: data.message,
                type: data.type || 'success'
            }
        }));
    });
});


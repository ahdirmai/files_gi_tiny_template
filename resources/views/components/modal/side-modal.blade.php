<div class="modal fade modal-notif modal-slide" id="modal-side" tabindex="-1" role="dialog"
    aria-labelledby="defaultModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-sm modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{ $header }}
            </div>
            <div class="modal-body">

                {{ $body }}
            </div>
            <div class="modal-footer">
                {{ $footer }}
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {
            $("#modal-side").on("hide.bs.modal", (event) => {
                // console.log('hidden');
                window.livewire.emit('resetModal');
            });
        });
</script>

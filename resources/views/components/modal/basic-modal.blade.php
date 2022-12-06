<div class="modal fade" id="basic-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{ $header }}
            </div>
            <div class="modal-body">
                {{ $content }}
            </div>
            <div class="modal-footer">
                {{ $footer }}
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function($) {
            $("#basic-modal").on("hide.bs.modal", (event) => {
                // console.log('hidden');
                window.livewire.emit('resetModal');
            });
        });
</script>
